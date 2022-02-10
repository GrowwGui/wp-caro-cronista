<?php
/**
 * The Header for our theme.
 *
 * @package slt
 * @since slt 1.0
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open() ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php endif;?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php 
	// For WordPress 5.2+
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	} else {
		do_action( 'wp_body_open' );
	}
?>
	<?php get_template_part( 'header/page', 'loader' ); ?>
	<div id="main-container-secondline" <?php secondline_themes_page_title(); ?>>
		
		<div id="secondline-themes-header-position">		
			<header id="masthead-slt" class="secondline-themes-site-header <?php echo esc_attr( get_theme_mod('secondline_themes_nav_align', 'secondline-themes-nav-right') ); ?>">
					
					<div id="logo-nav-slt">
						
						<div class="width-container-slt secondline-themes-logo-container">
							<h1 id="logo-slt" class="logo-inside-nav-slt noselect">
								<?php if(has_custom_logo()) : ?>
									<?php the_custom_logo();?>
								<?php endif;?>														
							</h1>
						</div><!-- close .width-container-slt -->
						
						<?php secondline_themes_navigation(); ?>
						
					</div><!-- close #logo-nav-slt -->
					<?php get_template_part( 'header/mobile', 'navigation' ); ?>
				
			</header>

		</div><!-- close #secondline-themes-header-position -->
