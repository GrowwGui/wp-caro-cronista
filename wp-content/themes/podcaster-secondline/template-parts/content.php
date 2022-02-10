<?php
/**
 * @package slt
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="secondline-themes-default-blog-index">

		<?php if(has_post_thumbnail()): ?>
			<div class="secondline-themes-feaured-image">
				<?php secondline_themes_blog_post_title(); ?>
					<?php the_post_thumbnail('secondline-themes-blog-index'); ?>

				</a>
			</div><!-- close .secondline-themes-feaured-image -->
		<?php endif; ?><!-- close gallery -->


		<div class="secondline-blog-content">

			<h2 class="secondline-blog-title"><?php secondline_themes_blog_post_title(); ?><?php the_title(); ?></a></h2>

			<?php if ( 'post' == get_post_type() ) : ?>
				<div class="secondline-post-meta">

                    <span class="blog-meta-date-display"><a href="<?php the_permalink(); ?>"><?php the_time(get_option('date_format')); ?></a></span>

					<?php global $post; $author_id_slt = $post->post_author;?>
					<span class="blog-meta-author-display"><a href="<?php echo esc_url(get_author_posts_url( $author_id_slt, get_the_author_meta( 'user_nicename' ) )); ?>"><?php echo esc_html(get_the_author_meta('user_nicename', $author_id_slt)); ?></a></span>

					<span class="blog-meta-category-list"><?php the_category(', '); ?></span>

					<?php
						if( function_exists('powerpress_get_enclosure_data') ) {
							$slt_episode_data = powerpress_get_enclosure_data( $post->ID );
							if( !empty($slt_episode_data['duration']) ) {
							  echo '<span class="blog-meta-time-slt">'.esc_html($slt_episode_data['duration']).'</span>';
							}
						}
					;?>

                    <span class="blog-meta-comments"><?php comments_popup_link( '' . wp_kses( __( '0 Comments', 'podcaster-secondline' ), true ) . '', wp_kses( __( '1 Comment', 'podcaster-secondline' ), true), wp_kses( __( '% Comments', 'podcaster-secondline' ), true ) ); ?></span>

				</div>
			<?php endif; ?>

			<div class="secondline-themes-blog-excerpt">
				<?php if(has_excerpt() ): ?><?php the_excerpt(); ?><?php else: ?>
					<?php if ( 'post' == get_post_type() ) : ?>
				<?php the_content( sprintf( wp_kses( __( 'Read More', 'podcaster-secondline' ), array(  'i' => array( 'id' => array(),  'class' => array(),  'style' => array(),  ), 'span' => array( 'class' => array() ) ) ), the_title( '<span class="screen-reader-text">"', '"</span>', false ) ) ); ?>
				<?php endif; ?>
				<?php endif; ?>


			<?php wp_link_pages( array(
				'before' => '<div class="secondline-page-nav">' . esc_html__( 'Pages:', 'podcaster-secondline' ),
				'after'  => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				) );
			?>
			</div>



		</div><!-- close .secondline-blog-content -->

		<?php if ( is_sticky() && is_home() && ! is_paged() ) { printf( '<div class="secondline-themes-sticky-post">%s</div>', esc_html__( 'FEATURED', 'podcaster-secondline' ) ); } ?>

	<div class="clearfix-slt"></div>
	</div><!-- close .secondline-themes-default-blog-index -->
</div><!-- #post-## -->
