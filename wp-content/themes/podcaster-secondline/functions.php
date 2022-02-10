<?php
/**
 * SecondLine functions and definitions
 *
 * @package secondline
 * @since secondline 1.0
 */



if ( ! function_exists( 'secondline_themes_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since secondline 1.0
 */

function secondline_themes_setup() {

	// Post Thumbnails
	add_theme_support( 'post-thumbnails' );

	add_image_size('secondline-themes-blog-index', 800, 500, true);
    add_image_size('secondline-themes-single-post-addon', 400, 250, true);
	add_image_size('secondline-themes-blog-post', 1400, 700, true);

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on this one, use a find and replace
	 * to change 'podcaster-secondline' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'podcaster-secondline', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio', 'quote', 'link', 'image' ) );


	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );


	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'secondline-themes-primary' => esc_html__( 'Primary Menu', 'podcaster-secondline' ),
		'secondline-themes-mobile-menu' => esc_html__( 'Mobile Menu', 'podcaster-secondline' ),
		'secondline-themes-footer-menu' => esc_html__( 'Footer Menu', 'podcaster-secondline' ),
	) );



	add_theme_support( 'custom-logo', array(
	   'height'      => 36,
	   'width'       => 203,
	   'flex-width' => true,
	) );


}
endif; // secondline_themes_setup
add_action( 'after_setup_theme', 'secondline_themes_setup' );


/**
* Add support for Gutenberg.
*
* @link https://wordpress.org/gutenberg/handbook/reference/theme-support/
*/

function secondline_themes_supported_features() {
    add_theme_support( 'editor-color-palette', array(
        array(
            'name' => esc_html__( 'White', 'podcaster-secondline' ),
            'slug' => 'white',
            'color' => '#ffffff',
        ),
        array(
            'name' => esc_html__( 'Black', 'podcaster-secondline' ),
            'slug' => 'black',
            'color' => '#000000',
        ),
        array(
            'name' => esc_html__( 'Dark Gray', 'podcaster-secondline' ),
            'slug' => 'dark-gray',
            'color' => '#2d2d2d',
        ),
        array(
            'name' => esc_html__( 'podcaster Red', 'podcaster-secondline' ),
            'slug' => 'podcaster-red',
            'color' => '#ff4102',
        ),
        array(
            'name' => esc_html__( 'Gray', 'podcaster-secondline' ),
            'slug' => 'gray',
            'color' => '#555555',
        ),
        array(
            'name' => esc_html__( 'Light Gray', 'podcaster-secondline' ),
            'slug' => 'light-gray',
            'color' => '#e8e8e8',
        ),
        array(
            'name' => esc_html__( 'Main Button Background', 'podcaster-secondline' ),
            'slug' => 'button-background',
            'color' => get_theme_mod('secondline_themes_button_background', '#2d2d2d', true),
        ),
        array(
            'name' => esc_html__( 'Main Button Background Hover', 'podcaster-secondline' ),
            'slug' => 'button-background-hover',
            'color' => get_theme_mod('secondline_themes_button_background_hover', '#4c4b46', true),
        ),
	));

	add_theme_support( 'align-wide' );

}

add_action( 'after_setup_theme', 'secondline_themes_supported_features' );


/**
* Enqueue editor styles for Gutenberg
*/

function secondline_themes_editor_styles() {
    wp_enqueue_style( 'secondline-themes-editor-style', get_template_directory_uri() . '/css/slt-editor-style.css' );
    wp_enqueue_style( 'secondline-google-fonts-editor', secondline_themes_fonts_url(), array( 'secondline-themes-editor-style' ), '1.0.0' );
}
add_action( 'enqueue_block_editor_assets', 'secondline_themes_editor_styles' );


/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since slt 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = esc_attr( get_theme_mod('secondline_themes_site_width', '1200') ); /* pixels */


/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since slt 1.0
 */
function secondline_themes_widgets_init() {
	register_sidebar( array(
		'name' => esc_html__( 'Sidebar', 'podcaster-secondline' ),
		'description'   => esc_html__('Default sidebar', 'podcaster-secondline'),
		'id' => 'secondline-themes-sidebar',
		'before_widget' => '<div id="%1$s" class="sidebar-item widget %2$s">',
		'after_widget' => '<div class="sidebar-divider-slt"></div></div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );

	register_sidebar( array(
		'name' => esc_html__( 'Mobile/Tablet Sidebar', 'podcaster-secondline' ),
		'description'   => esc_html__('Mobile/Tablet sidebar', 'podcaster-secondline'),
		'id' => 'secondline-themes-mobile-sidebar',
		'before_widget' => '<div id="%1$s" class="sidebar-item widget %2$s">',
		'after_widget' => '<div class="sidebar-divider-slt"></div></div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );

	register_sidebar( array(
		'name' => esc_html__( 'Footer Widgets', 'podcaster-secondline' ),
		'description' => esc_html__( 'Footer Widgets', 'podcaster-secondline' ),
		'id' => 'secondline-themes-footer-widgets',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );


}
add_action( 'widgets_init', 'secondline_themes_widgets_init' );




/**
 * Enqueue scripts and styles
 */
function secondline_themes_scripts() {

	wp_enqueue_style( 'wp-mediaelement' );
	wp_enqueue_script( 'wp-mediaelement' );
	wp_enqueue_script( 'masonry' );
	wp_enqueue_script( 'imagesLoaded' );

	wp_enqueue_style( 'secondline-style', get_stylesheet_uri());	
	wp_enqueue_style( 'secondline-google-fonts', secondline_themes_fonts_url(), array( 'secondline-style' ), '1.0.0' );	
	wp_enqueue_script( 'secondline-plugins', get_template_directory_uri() . '/js/plugins.js', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'secondline-scripts', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), '20120206', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}
add_action( 'wp_enqueue_scripts', 'secondline_themes_scripts' );



/**
 * Enqueue google fonts
 */
function secondline_themes_fonts_url() {
    $secondline_themes_font_url = '';

    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'podcaster-secondline' ) ) {
        $secondline_themes_font_url = add_query_arg( 'family', urlencode( 'Montserrat:400,700|Roboto:400,700|&subset=latin' ), "//fonts.googleapis.com/css" );
    }

    return $secondline_themes_font_url;
}


// Calling Dismiss Notices 
require get_template_directory() . '/inc/dismiss-notices/dismiss-notices.php';


function secondline_themes_podcaster_notice() {
	if ( ! PAnD::is_admin_notice_active( 'disable-podcaster-notice-forever' ) ) {
		return;
	}
	?>
	<div data-dismissible="disable-podcaster-notice-forever" class="notice notice-info is-dismissible">
		<p><?php esc_html_e( 'Boost your Podcast website with a professional', 'podcaster-secondline' ); ?> <strong><a href="https://secondlinethemes.com/?utm_source=podcaster-theme-notice" target="_blank"><?php esc_html_e( 'Podcast WordPress Theme.', 'podcaster-secondline' );?></a></strong> <?php esc_html_e( 'Brought to you by the creators of the Podcaster Theme!', 'podcaster-secondline' ); ?></p>
	</div>
	<?php
}
add_action( 'admin_notices', 'secondline_themes_podcaster_notice' );
add_action( 'admin_init', array( 'PAnD', 'init' ) );



/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom Metabox Fields
 */
require get_template_directory() . '/inc/custom-meta.php';

/**
 * Theme Customizer
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * JS Customizer Out
 */
require get_template_directory() . '/inc/js-customizer.php';

/**
 * Load Plugin TGMPA
 */
require get_template_directory() . '/inc/tgm-plugin-activation/plugin-activation.php';
