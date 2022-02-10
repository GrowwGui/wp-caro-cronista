<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package slt
 */

get_header(); ?>

	<div id="page-title-slt">
		<div class="width-container-slt">
			<div id="secondline-themes-page-title-container">
				<h1 class="page-title"><?php esc_html_e( '404 Error', 'podcaster-secondline' ); ?></h1>
			</div>
			<div class="clearfix-slt"></div>
		</div>
	</div><!-- #page-title-slt -->

	
	<div id="content-slt">
		<div id="error-page-index">

		<div class="width-container-slt">
			
				<br>				
				<h2><?php esc_html_e( "Oops! This page can&rsquo;t be found.", 'podcaster-secondline' ); ?></h2>
				<p><?php esc_html_e( "Sorry, the page you&rsquo;re looking for is not available.", 'podcaster-secondline' ); ?></p>
				<?php get_search_form(); ?>
				
				<br>
				
		
			
		<div class="clearfix-slt"></div>
		</div><!-- close .width-container-slt -->
		</div><!-- close #error-page-index -->
	</div><!-- #content-slt -->
	
<?php get_footer(); ?>