<?php
/**
 * @package slt
 */
?>


	<div id="page-title-slt-post-page">
		<div id="blog-post-title-meta-container" <?php if(get_post_meta($post->ID, 'secondline_themes_external_embed', true)) : ?>class="slt-no-embed-player"<?php endif;?>>
			<div class="width-container-slt">

			<h1 class="blog-page-title"><?php the_title(); ?></h1>

			<div class="single-secondline-post-meta">

				<span class="blog-meta-date-display"><?php the_time(get_option('date_format')); ?></span>

				<?php global $post; $author_id_slt = $post->post_author;?>
				<span class="blog-meta-author-display"><a href="<?php echo esc_url(get_author_posts_url( $author_id_slt, get_the_author_meta( 'user_nicename' ) )); ?>"><?php echo esc_html(get_the_author_meta('user_nicename', $author_id_slt)); ?></a></span>

				<span class="single-blog-meta-category-list"><?php the_category(', '); ?></span>

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


			<div class="clearfix-slt"></div>
			</div><!-- close .width-container-slt -->
		</div><!-- close #blog-post-title-meta-container -->
	</div><!-- #page-title-slt -->
