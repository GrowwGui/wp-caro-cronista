<?php

namespace PodcastImporterSecondLine\RestAPI;

use WP_Error;
use PodcastImporterSecondLine\Settings as PIS_Settings;
use PodcastImporterSecondLine\Helper\FeedForm as PIS_Helper_FeedForm;
use PodcastImporterSecondLine\Helper\Importer as PIS_Helper_Importer;

class Response {

  public static function admin_dismiss_notice( $request_data ) {
    $current_notice_dismiss_map = PIS_Settings::instance()->get( '_admin_notice_dismissed_map' );

    $current_notice_dismiss_map[ get_current_user_id() ] = time();

    PIS_Settings::instance()->update( '_admin_notice_dismissed_map', $current_notice_dismiss_map );

    return rest_ensure_response( true );
  }

  public static function import_feed( $request ) {
    $request_data = $request->get_params();
    $messages = [];

    $meta_map = PIS_Helper_FeedForm::request_data_to_meta_map( $request_data );

    $importer = PIS_Helper_Importer::from_meta_map( $meta_map );

    $import_current_feed = $importer->import_current_feed();

    if( $import_current_feed[ 'current_import' ] == 0 && $import_current_feed[ 'episode_count' ] != 0) {
      if( $import_current_feed[ 'synced_count' ] !== 0 ) {
        $messages[] = [
          'type'    => 'success',
          'message' => __('Success! Re-synced ', 'podcast-importer-secondline' ) . $import_current_feed[ 'synced_count' ] . __( " previously imported episodes.", 'podcast-importer-secondline' )
        ];
      } else {
        $messages[] = [
          'type'    => 'danger',
          'message' => __( 'No new episodes imported - all episodes already existing in WordPress!', 'podcast-importer-secondline' ) . '<br/>' .
            __('If you have existing draft, private or trashed posts with the same title as your episodes, delete those and run the importer again.', 'podcast-importer-secondline')
        ];
      }
    } elseif ( $import_current_feed[ 'episode_count' ] == 0) { // No episodes existing within feed.
      $messages[] = [
        'type'    => 'danger',
        'message' => __( 'Error! Your feed does not contain any episodes.', 'podcast-importer-secondline' )
      ];
    } else {
      $messages[] = [
        'type'    => 'success',
        'message' => __('Success! Imported ', 'podcast-importer-secondline') . $import_current_feed[ 'current_import' ] .
                     __(' out of ', 'podcast-importer-secondline') . $import_current_feed[ 'episode_count' ] . __(' episodes', 'podcast-importer-secondline' ) . '.' .
                    ( $import_current_feed[ 'synced_count' ] !== 0 ? ' ' . $import_current_feed[ 'synced_count' ] . __( " previously imported episodes re-synced", 'podcast-importer-secondline' ) : '' )
      ];
    }

    if( isset( $import_current_feed[ 'additional_errors' ] ) && is_array( $import_current_feed[ 'additional_errors' ] ) )
      foreach( $import_current_feed[ 'additional_errors' ] as $additional_error )
        $messages[] = [
          'type'    => 'danger',
          'message' => $additional_error
        ];

    if( isset( $request_data[ 'post_id' ] ) ) {
      foreach( $meta_map as $k => $v )
        update_post_meta( intval( $request_data[ 'post_id' ] ), $k, $v );
    } else if( isset( $meta_map[ 'secondline_import_continuous' ] ) && $meta_map[ 'secondline_import_continuous' ] == 'on' ) {
      if( 0 === post_exists( podcast_importer_secondline_sanitize_feed_value($importer->feedXML->channel->title ), "", "", PODCAST_IMPORTER_SECONDLINE_POST_TYPE_IMPORT )) {
        $import_post = [
          'post_title'   => podcast_importer_secondline_sanitize_feed_value($importer->feedXML->channel->title ),
          'post_type'    => PODCAST_IMPORTER_SECONDLINE_POST_TYPE_IMPORT,
          'post_status'  => 'publish',
        ];
        $post_import_id = wp_insert_post( $import_post );

        foreach( $meta_map as $k => $v )
          update_post_meta( $post_import_id, $k, $v );

      } else {
        $messages[] = [
          'type'    => 'danger',
          'message' => __('This podcast is already being scheduled for import. Delete the previous schedule to create a new one.', 'podcast-importer-secondline' )
        ];
      }
    }

    return rest_ensure_response( [
      'messages'  => $messages
    ] );
  }

  public static function sync_feed( $request ) {
    $all_meta = get_post_meta( intval( $request[ 'id' ] ) );
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

    return true;
  }

}