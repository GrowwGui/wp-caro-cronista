<?php

namespace PodcastImporterSecondLine;

class AdminAssets {

  /**
   * @var AdminAssets;
   */
  protected static $_instance;

  /**
   * @return AdminAssets
   */
  public static function instance(): AdminAssets {
    if( self::$_instance === null )
      self::$_instance = new self();

    return self::$_instance;
  }

  public function setup( $hook ) {
    if( $hook === 'tools_page_' . PODCAST_IMPORTER_SECONDLINE_PREFIX ) {
      wp_enqueue_media();
      wp_enqueue_script( 'media-grid' );
      wp_enqueue_script( 'media' );
      wp_enqueue_style( 'media');
      wp_enqueue_script( 'media-upload' );
      wp_enqueue_script( 'thickbox' );
    }

    wp_register_style( 'secondline_admin_styles', plugins_url( '/assets/css/admin.css', PODCAST_IMPORTER_SECONDLINE_BASE_FILE_PATH ), false, PODCAST_IMPORTER_SECONDLINE_VERSION );
    wp_enqueue_style( 'secondline_admin_styles' );

    wp_register_script('secondline_admin_scripts', plugins_url('/assets/js/admin.js', PODCAST_IMPORTER_SECONDLINE_BASE_FILE_PATH), false, PODCAST_IMPORTER_SECONDLINE_VERSION, true);

    wp_localize_script( 'secondline_admin_scripts', 'podcast_import_settings', [
      'rest_url'    => esc_url_raw( rest_url() ),
      'rest_nonce'  => wp_create_nonce( 'wp_rest' ),
      'loader_icon' => plugins_url('/assets/loader-icon.png', PODCAST_IMPORTER_SECONDLINE_BASE_FILE_PATH )
    ] );

    wp_enqueue_script('secondline_admin_scripts');
  }

}