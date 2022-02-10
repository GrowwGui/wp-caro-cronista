<?php

namespace PodcastImporterSecondLine;

use PodcastImporterSecondLine\Helper\Importer as PIS_Helper_Importer;
use PodcastImporterSecondLine\Settings as PIS_Settings;

class ActionScheduler {

  /**
   * @var null|ActionScheduler;
   */
  protected static $_instance = null;

  /**
   * @return ActionScheduler
   */
  public static function instance(): ActionScheduler {
    if( self::$_instance === null )
      self::$_instance = new self();

    return self::$_instance;
  }

  public function setup() {
    add_action( 'init', [ $this, "_init" ] );

    add_action( PODCAST_IMPORTER_SECONDLINE_ALIAS . '_scheduler_feeds_sync', [ $this, '_feeds_sync' ] );

    // Async Scheduled
    add_action( PODCAST_IMPORTER_SECONDLINE_ALIAS . '_scheduler_feed_sync', [ $this, '_feed_sync' ], 10, 2 );
    add_action( PODCAST_IMPORTER_SECONDLINE_ALIAS . '_scheduler_image_sync', [ $this, '_image_sync' ], 10, 2 );
    add_action( PODCAST_IMPORTER_SECONDLINE_ALIAS . '_scheduler_images_md5_checksum', [ $this, '_images_md5_checksum' ], 10, 1 );
  }

  public function _init() {
    if( PIS_Settings::instance()->get( '_last_migration' ) !== '0.0.1' ) {
      $post_ids = get_posts( [
        'post_type'    	 => PODCAST_IMPORTER_SECONDLINE_POST_TYPE_IMPORT,
        'posts_per_page' => -1,
        'fields'         => 'ids'
      ] );

      // No Continuous imports exist, so.. we bail and assume we did it.
      if( empty( $post_ids ) ) {
        PIS_Settings::instance()->update( '_last_migration', '0.0.1' );
      } else {
        // Remove all scheduled events.
        $next_schedule = wp_next_scheduled( 'secondline_importer_cron' );

        if( false !== $next_schedule )
          wp_unschedule_event($next_schedule, PODCAST_IMPORTER_SECONDLINE_CRON_JOB_FREQUENCY, 'secondline_importer_cron');

        $next_schedule = wp_next_scheduled( 'secondline_import_cron_process_queue' );

        if( false !== $next_schedule )
          wp_unschedule_event($next_schedule, PODCAST_IMPORTER_SECONDLINE_CRON_JOB_PROCESS_FREQUENCY, 'secondline_import_cron_process_queue');

        // Bail and try only once, in case it fails, well, images will be imported again and then checksum will be set, to avoid constant timeout, or memory issues have just one.
        PIS_Settings::instance()->update( '_last_migration', '0.0.1' );

        @ini_set('memory_limit', '-1' );

        $attachment_ids = get_posts( [
          'post_type'       => 'attachment',
          'posts_per_page'  => -1,
          'fields'          => 'ids',
          'meta_query' => [
            [
              'key'     => 'secondline_attachment_md5',
              'compare' => 'NOT EXISTS'
            ],
          ]
        ] );

        while( !empty( $current_attachment_ids = array_splice( $attachment_ids, 0, 10 ) ) ) {
          as_enqueue_async_action( PODCAST_IMPORTER_SECONDLINE_ALIAS . '_scheduler_images_md5_checksum', [ $current_attachment_ids ], PODCAST_IMPORTER_SECONDLINE_ALIAS );
        }
      }
    }

    if ( false === as_has_scheduled_action( PODCAST_IMPORTER_SECONDLINE_ALIAS . '_scheduler_feeds_sync' ) )
      as_schedule_recurring_action( strtotime( 'now' ), ( 1 * HOUR_IN_SECONDS ), PODCAST_IMPORTER_SECONDLINE_ALIAS . '_scheduler_feeds_sync' );
  }

  public function _feeds_sync() {
    $post_ids = get_posts( [
      'post_type'    	 => PODCAST_IMPORTER_SECONDLINE_POST_TYPE_IMPORT,
      'posts_per_page' => -1,
      'fields'         => 'ids'
    ] );

    foreach( $post_ids as $post_id )
      as_enqueue_async_action( PODCAST_IMPORTER_SECONDLINE_ALIAS . '_scheduler_feed_sync', [ $post_id ], PODCAST_IMPORTER_SECONDLINE_ALIAS );
  }

  public function _feed_sync( $feed_post_id ) {
    $all_meta = get_post_meta( $feed_post_id );
    $meta_map = [];

    foreach( $all_meta as $k => $v ) {
      if( is_array( $v ) && count( $v ) === 1 )
        $v = maybe_unserialize( $v[ 0 ] );

      $meta_map[ $k ] = $v;
    }

    // Maybe deleted after queued, need to ensure it's fine.
    if( isset( $meta_map[ 'secondline_rss_feed' ] ) ) {
      $importer = PIS_Helper_Importer::from_meta_map( $meta_map );
      $response = $importer->import_current_feed();
    }
  }

  public function _image_sync( $post_id, $image_path ) {
    if( !function_exists( 'media_sideload_image' ) ) {
      require_once( ABSPATH . 'wp-admin/includes/media.php' );
      require_once( ABSPATH . 'wp-admin/includes/file.php' );
      require_once( ABSPATH . 'wp-admin/includes/image.php' );
    }

    $image_contents = wp_remote_get( $image_path );
    $image_contents = wp_remote_retrieve_body( $image_contents );

    global $wpdb;

    $post_id = intval( $post_id );

    $attachment_post_id = $wpdb->get_var(
      'SELECT post_id 
               FROM ' . $wpdb->postmeta . ' 
              WHERE meta_key = "secondline_attachment_md5"
                AND meta_value = ' . $wpdb->prepare( "%s", md5( $image_contents ) )
    );

    if( null === $attachment_post_id ) {
      $attachment_post_id = media_sideload_image($image_path, $post_id, get_the_title( $post_id ), 'id' );

      update_post_meta( $attachment_post_id, 'secondline_attachment_md5', md5( $image_contents ) );
    } else {
      $attachment_post_id = intval( $attachment_post_id );
    }

    set_post_thumbnail( $post_id, $attachment_post_id );
  }

  public function _images_md5_checksum( $attachment_ids ) {
    foreach( $attachment_ids as $attachment_id ) {
      $url = wp_get_attachment_url( $attachment_id );

      if( empty( $url ) || is_array( $url ) )
        continue;

      $image_contents = wp_remote_get( $url );
      $image_contents = wp_remote_retrieve_body( $image_contents );

      update_post_meta( $attachment_id, 'secondline_attachment_md5', md5( $image_contents ) );
    }
  }

}