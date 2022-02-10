<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package slt
 */


add_filter( 'secondline_themes_filter_embeds', 'wp_oembed_get' );


/* Header/Page Title Options */
function secondline_themes_page_title() {
	global $post;
?>
	class="

		<?php echo esc_attr( get_theme_mod( 'secondline_themes_header_width', 'secondline-themes-header-normal-width') ); ?> 
		<?php echo esc_attr( get_theme_mod( 'secondline_themes_logo_position', 'secondline-themes-logo-position-left') ); ?> 
		<?php if(is_page() && get_post_meta($post->ID, 'secondline_themes_header_disabled', true)): ?> secondline-disable-header-per-page<?php endif; ?>
		<?php if(is_page() && get_post_meta($post->ID, 'secondline_themes_disable_footer_per_page', true)): ?> secondline-disable-footer-per-page<?php endif; ?>		
		<?php if ( get_theme_mod( 'secondline_themes_one_page_nav') == 'on') : ?> secondline-themes-one-page-nav<?php else: ?>	secondline-themes-one-page-nav-off<?php endif; ?>
	"
<?php
}


function secondline_themes_navigation() {
?>
	

	
	<div class="width-container-slt optional-centered-area-on-mobile">
	
		<div class="mobile-menu-icon-slt noselect"><i class="fa fa-bars"></i><?php if (get_theme_mod( 'secondline_themes_mobile_menu_text') == 'on' ) : ?><span class="secondline-mobile-menu-text"><?php echo esc_html__( 'Menu', 'podcaster-secondline' )?></span><?php endif; ?></div>
		
	
				
		<div id="secondline-nav-container">
			<nav id="site-navigation" class="main-navigation">
				<?php wp_nav_menu( array('theme_location' => 'secondline-themes-primary', 'menu_class' => 'sf-menu', 'fallback_cb' => false ) ); ?><div class="clearfix-slt"></div>
			</nav>
			<div class="clearfix-slt"></div>
		</div><!-- close #secondline-nav-container -->
		

		
		<div class="clearfix-slt"></div>
	</div><!-- close .width-container-slt -->
	
															
	
<?php
}


function secondline_themes_blog_post_title() {
	global $post;
?>

				<a href="<?php the_permalink(); ?>">
					
	
<?php
}






/* Modify Default Category Widget */
add_filter('wp_list_categories', 'secondline_themes_add_span_cat_count');
function secondline_themes_add_span_cat_count($links) {
	$links = str_replace('</a> (', ' <span class="count">', $links);
	
	$links = str_replace('(', '', $links);
	
	$links = str_replace(')', '</span></a>', $links);
	return $links;
}

add_filter('get_archives_link', 'secondline_themes_archive_count_span');
function secondline_themes_archive_count_span($links) {
	$links = str_replace('</a>&nbsp;(', ' <span class="count">', $links);
	$links = str_replace(')', '</span></a>', $links);
return $links;
}




function secondline_themes_blog_index_gallery() {
?>								
								href="<?php the_permalink(); ?>"
	
<?php
}




/* remove more link jump */
function secondline_themes_remove_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );
	return $link;
}
add_filter( 'the_content_more_link', 'secondline_themes_remove_more_link_scroll' );






if ( ! function_exists( 'secondline_themes_infinite_content_nav_slt' ) ) :
/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since Twenty Twelve 1.0
 */
function secondline_themes_infinite_content_nav_slt( $html_id ) {
	global $wp_query;

	$html_id = esc_attr( $html_id );

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<div id="infinite-nav-slt-default" class="infinite-nav-slt">
			<div class="nav-previous"><?php next_posts_link( wp_kses( __('Load More', 'podcaster-secondline' ) , TRUE) ); ?></div>
		</div>
	<?php endif;
}
endif;





if ( ! function_exists( 'secondline_themes_content_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function secondline_themes_content_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="secondline-themes-post-navigation">
		<div class="secondline-themes-nav-links">
			<?php
				previous_post_link( '<div class="secondline-themes-nav-previous">%link</div>', '<i class="fa fa-long-arrow-left" aria-hidden="true"></i>' ); ?>
				
							<div class="secondline-themes-post-nav-back"><a href="<?php 
				if( get_option( 'page_for_posts' ) ) { 
				  echo esc_url(get_permalink( get_option( 'page_for_posts' ) )); 
				} else { 
				  echo esc_url( home_url() ); 
				} 
				?>"><i class="fa fa-th" aria-hidden="true"></i></a></div>
				
			<?php	next_post_link( '<div class="secondline-themes-nav-next">%link</div>', '<i class="fa fa-long-arrow-right" aria-hidden="true"></i>' );
			?>
		<div class="clearfix-slt"></div>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;



/* DISABLE DEFAULT POWERPRESS OPTIONS */
function secondline_powerpress_options () {
	if( function_exists('the_powerpress_content') ) {
		/* DISABLE DEFAULT PLAYER LOCATION */		
		$slt_options = get_option('powerpress_general');
	}
}
add_action('init', 'secondline_powerpress_options');



/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function secondline_themes_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'secondline_themes_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'secondline_themes_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so secondline_themes_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so secondline_themes_categorized_blog should return false.
		return false;
	}
}



/**
 * Flush out the transients used in secondline_themes_categorized_blog.
 */
function secondline_themes_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'secondline_themes_categories' );
}
add_action( 'edit_category', 'secondline_themes_category_transient_flusher' );
add_action( 'save_post',     'secondline_themes_category_transient_flusher' );