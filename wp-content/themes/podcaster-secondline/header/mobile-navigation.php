
		<div id="main-nav-mobile">
			
		
			<?php if ( has_nav_menu( 'secondline-themes-mobile-menu' ) ):  ?>
				<?php wp_nav_menu( array('theme_location' => 'secondline-themes-mobile-menu', 'menu_class' => 'mobile-menu-slt', 'fallback_cb' => false ) ); ?>
			<?php else: ?>
				<?php wp_nav_menu( array('theme_location' => 'secondline-themes-primary', 'menu_class' => 'mobile-menu-slt', 'fallback_cb' => false ) ); ?>
			<?php endif; ?>
			
			<div class="sidebar secondline-themes-mobile-sidebar"><?php dynamic_sidebar( 'secondline-themes-mobile-sidebar' ); ?></div>
			
			<div class="clearfix-slt"></div>
		</div><!-- close #mobile-menu-container -->