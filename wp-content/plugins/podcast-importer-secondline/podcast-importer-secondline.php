<?php
/**
 * Plugin Name:       Podcast Importer SecondLine
 * Description:       A simple podcast import plugin with ongoing podcast feed import features.
 * Version:           1.3.6
 * Author:            SecondLineThemes
 * Author URI:        https://secondlinethemes.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       podcast-importer-secondline
 * Domain Path:       /languages
 */

if ( ! defined( 'WPINC' ) )
	die;

define( 'PODCAST_IMPORTER_SECONDLINE_VERSION', '1.3.6' );
define( "PODCAST_IMPORTER_SECONDLINE_BASE_FILE_PATH", __FILE__ );
define( "PODCAST_IMPORTER_SECONDLINE_BASE_PATH", dirname( PODCAST_IMPORTER_SECONDLINE_BASE_FILE_PATH ) );
define( "PODCAST_IMPORTER_SECONDLINE_PLUGIN_IDENTIFIER", ltrim( str_ireplace( dirname( PODCAST_IMPORTER_SECONDLINE_BASE_PATH ), '', PODCAST_IMPORTER_SECONDLINE_BASE_FILE_PATH ), '/' ) );

require_once PODCAST_IMPORTER_SECONDLINE_BASE_PATH . "/autoload.php";
require_once PODCAST_IMPORTER_SECONDLINE_BASE_PATH . "/definitions.php";
require_once PODCAST_IMPORTER_SECONDLINE_BASE_PATH . "/functions.php";
require_once PODCAST_IMPORTER_SECONDLINE_BASE_PATH . '/lib/action-scheduler/action-scheduler.php';

PodcastImporterSecondLine\ActionScheduler::instance()->setup();

// Various Hooks & Additions.
PodcastImporterSecondLine\Hooks::instance()->setup();

// Post Types
add_action( 'init', [ PodcastImporterSecondLine\PostTypes::instance(), 'setup' ] );

// RestAPI
add_action( 'rest_api_init', [ PodcastImporterSecondLine\RestAPI::instance(), 'setup' ] );

// General Functionality
add_action( 'plugins_loaded', [ PodcastImporterSecondLine\Controller::instance(), 'setup' ] );

if ( is_admin() ) {
  add_action( 'admin_menu', [ PodcastImporterSecondLine\AdminMenu::instance(), 'setup' ] );
  add_action( 'admin_enqueue_scripts', [ PodcastImporterSecondLine\AdminAssets::instance(), 'setup' ] );
}

register_deactivation_hook( __FILE__, function() {
  $next_schedule = wp_next_scheduled( 'secondline_importer_cron' );

  if( false !== $next_schedule )
    wp_unschedule_event($next_schedule, PODCAST_IMPORTER_SECONDLINE_CRON_JOB_FREQUENCY, 'secondline_importer_cron');

  $next_schedule = wp_next_scheduled( 'secondline_import_cron_process_queue' );

  if( false !== $next_schedule )
    wp_unschedule_event($next_schedule, PODCAST_IMPORTER_SECONDLINE_CRON_JOB_PROCESS_FREQUENCY, 'secondline_import_cron_process_queue');

  as_unschedule_action( PODCAST_IMPORTER_SECONDLINE_ALIAS . '_scheduler_feeds_sync' );
} );