<?php

namespace PodcastImporterSecondLine;

class Controller {

  /**
   * @var Controller;
   */
  protected static $_instance;

  /**
   * @return Controller
   */
  public static function instance(): Controller {
    if( self::$_instance === null )
      self::$_instance = new self();

    return self::$_instance;
  }

  private $_action_map = [
    'force-cron-reset' => '_action_force_cron_reset'
  ];

  public function setup() {
    load_plugin_textdomain( 'secondline-podcast-importer', false, PODCAST_IMPORTER_SECONDLINE_LANGUAGE_DIRECTORY );

    if( is_admin()
      && isset( $_GET[ PODCAST_IMPORTER_SECONDLINE_PREFIX . '-action' ] )
      && isset( $this->_action_map[ $_GET[ PODCAST_IMPORTER_SECONDLINE_PREFIX . '-action' ] ] ) ) {
      add_action( 'init', [ $this, $this->_action_map[ $_GET[ PODCAST_IMPORTER_SECONDLINE_PREFIX . '-action' ] ] ] );
    }
  }

  public function _action_force_cron_reset() {
    if( !current_user_can( 'manage_options' ) )
      exit( __( 'Invalid Request', 'podcast-importer-secondline' ) );

    Cron::instance()->schedule_events();;

    podcast_importer_secondline_redirect( get_admin_url( null, 'site-health.php'), 302 );
  }

}