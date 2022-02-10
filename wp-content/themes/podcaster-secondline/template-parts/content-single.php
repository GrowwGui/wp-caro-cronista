<?php
/**
 * @package slt
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="secondline-single-container">

		<div class="secondline-blog-single-content">
			
			<?php if(!get_post_meta($post->ID, 'secondline_themes_disable_advertisement_post', true)): ?>
			<?php if ( is_active_sidebar( 'secondline-themes-post-widgets-top') ) { ?>
				<div class="widget-area-top-of-posts"><?php dynamic_sidebar( 'secondline-themes-post-widgets-top' ); ?></div>			
			<?php } ?>
			<?php endif; ?>
			
			<div class="secondline-themes-blog-single-excerpt">
				<?php the_content(); ?>
			
				<?php wp_link_pages( array(
					'before' => '<div class="secondline-page-nav">' . esc_html__( 'Pages:', 'podcaster-secondline' ),
					'after'  => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					) );
				?>
			</div>
			
			<?php if(!get_post_meta($post->ID, 'secondline_themes_disable_advertisement_post', true)): ?>
			<?php if ( is_active_sidebar( 'secondline-themes-post-widgets-bottom' ) ) { ?>
				<div class="widget-area-bottom-of-posts"><?php dynamic_sidebar( 'secondline-themes-post-widgets-bottom' ); ?></div>	
			<?php } ?>
			<?php endif; ?>
			
			<?php the_tags(  '<div class="tags-secondline"><i class="fa fa-tags"></i>', ' ', '</div><div class="clearfix-slt"></div>' ); ?> 

			
			
			<div class="clearfix-slt"></div>
			
			<?php if ( comments_open() || get_comments_number() ) : comments_template(); endif; ?>
			
		</div><!-- close .secondline-blog-content -->

	<div class="clearfix-slt"></div>
	
	
	</div><!-- close .secondline-single-container -->
</div><!-- #post-## -->