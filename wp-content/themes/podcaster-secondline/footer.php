<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package slt
 * @since slt 1.0
 */
?>
		<footer id="site-footer" class="secondline-themes-footer-normal-width footer-copyright-align-left">
			
			<div id="widget-area-secondline">
			<div class="width-container-slt <?php echo esc_attr(get_theme_mod('secondline_themes_footer_widget_count', 'footer-3-slt')); ?>">
				
				<div class="clearfix-slt"></div>
				
				<?php if ( is_active_sidebar( 'secondline-themes-footer-widgets' ) ) { ?>
					<?php dynamic_sidebar( 'secondline-themes-footer-widgets' ); ?>					
				<?php } ?>

				<div class="clearfix-slt"></div>
				
				
				</div><!-- close .width-container-slt -->
			</div><!-- close #widget-area-slt -->
			
			
			
			<div id="secondline-themes-copyright">
				<div class="width-container-slt">
					
					
				</div> <!-- close .width-container-slt -->	
				
				
					<div class="width-container-slt">
						
					<?php wp_nav_menu( array('theme_location' => 'secondline-themes-footer-menu', 'menu_class' => 'secondline-themes-footer-nav-container-class', 'fallback_cb' => false, 'depth' => '1' ) ); ?>
				
				
				<div id="copyright-text">
						<?php echo esc_html__('&copy; All Rights Reserved.', 'podcaster-secondline'); ?>
				</div>		
				
				</div> <!-- close .width-container-slt -->			
				<div class="clearfix-slt"></div>
					
				
			</div><!-- close #secondline-themes-copyright -->
			
		</footer>

	</div><!-- close #boxed-layout-slt -->
	
<?php wp_footer(); ?>
</body>
</html>