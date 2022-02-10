<?php
/**
 * SecondLine Theme Customizer
 *
 * @package slt
 */

get_template_part('inc/customizer/customizer', 'controls');


function secondline_themes_customizer( $wp_customize ) {


	/* Panel - General */
	$wp_customize->add_panel( 'secondline_themes_general_panel', array(
		'priority'    => 3,
		'title'       => esc_html__( 'General', 'podcaster-secondline' ),
		 )
 	);


	/* Section - General - General Layout */
	$wp_customize->add_section( 'secondline_themes_section_general_layout', array(
		'title'          => esc_html__( 'General Options', 'podcaster-secondline' ),
		'panel'          => 'secondline_themes_general_panel', // Not typically needed.
		'priority'       => 10,
		)
	);


	/* Panel - Header */
	$wp_customize->add_panel( 'secondline_themes_header_panel', array(
		'priority'    => 5,
		'title'       => esc_html__( 'Header', 'podcaster-secondline' ),
		)
	);



	/* Section - Header - Fixed Header */
	$wp_customize->add_section( 'secondline_themes_section_options_nav', array(
		'title'          => esc_html__( 'Navigation Options', 'podcaster-secondline' ),
		'panel'          => 'secondline_themes_header_panel', // Not typically needed.
		'priority'       => 25,
		)
	);

	/* Setting - Header - Navigation */
	$wp_customize->add_setting('secondline_themes_nav_font_size',array(
		'default' => '15',
		'sanitize_callback' => 'secondline_themes_sanitize_choices',
	) );
	$wp_customize->add_control( new secondline_themes_Controls_Slider_Control($wp_customize, 'secondline_themes_nav_font_size', array(
		'label'    => esc_html__( 'Navigation Font Size', 'podcaster-secondline' ),
		'section'  => 'secondline_themes_section_options_nav',
		'priority'   => 500,
		'choices'     => array(
			'min'  => 0,
			'max'  => 30,
			'step' => 1
		), ) )
	);


	/* Setting - Header - Navigation */
	$wp_customize->add_setting('secondline_themes_nav_padding',array(
		'default' => '35',
		'sanitize_callback' => 'secondline_themes_sanitize_choices',
	) );
	$wp_customize->add_control( new secondline_themes_Controls_Slider_Control($wp_customize, 'secondline_themes_nav_padding', array(
		'label'    => esc_html__( 'Navigation Padding Top/Bottom', 'podcaster-secondline' ),
		'section'  => 'secondline_themes_section_options_nav',
		'priority'   => 505,
		'choices'     => array(
			'min'  => 5,
			'max'  => 100,
			'step' => 1
		), ) )
	);

	/* Setting - Header - Navigation */
	$wp_customize->add_setting('secondline_themes_nav_left_right',array(
		'default' => '18',
		'sanitize_callback' => 'secondline_themes_sanitize_choices',
	) );
	$wp_customize->add_control( new secondline_themes_Controls_Slider_Control($wp_customize, 'secondline_themes_nav_left_right', array(
		'label'    => esc_html__( 'Navigation Padding Left/Right', 'podcaster-secondline' ),
		'section'  => 'secondline_themes_section_options_nav',
		'priority'   => 510,
		'choices'     => array(
			'min'  => 8,
			'max'  => 80,
			'step' => 1
		), ) )
	);



	/* Setting - Header - Navigation */
	$wp_customize->add_setting('secondline_themes_sub_nav_font_size',array(
		'default' => '13',
		'sanitize_callback' => 'secondline_themes_sanitize_choices',
	) );
	$wp_customize->add_control( new secondline_themes_Controls_Slider_Control($wp_customize, 'secondline_themes_sub_nav_font_size', array(
		'label'    => esc_html__( 'Sub-Navigation Font Size', 'podcaster-secondline' ),
		'section'  => 'secondline_themes_section_options_nav',
		'priority'   => 510,
		'choices'     => array(
			'min'  => 0,
			'max'  => 30,
			'step' => 1
		), ) )
	);



	/* Panel - Body */
	$wp_customize->add_panel( 'secondline_themes_body_panel', array(
		'priority'    => 8,
        'title'       => esc_html__( 'Body', 'podcaster-secondline' ),
    ) );


	/* Section - Header - Fixed Header */
	$wp_customize->add_section( 'secondline_themes_section_page_title', array(
		'title'          => esc_html__( 'Page Title Options', 'podcaster-secondline' ),
		'panel'          => 'secondline_themes_body_panel', // Not typically needed.
		'priority'       => 25,
		)
	);


	/* Setting - General - Page Title */
	$wp_customize->add_setting( 'secondline_themes_page_title_bg_image' ,array(
		'default' => get_template_directory_uri().'/images/page-title.jpg',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'secondline_themes_page_title_bg_image', array(
		'label'    => esc_html__( 'Page Title Background Image', 'podcaster-secondline' ),
		'section' => 'secondline_themes_section_page_title',
		'priority'   => 535,
		))
	);


	/* Setting - General - Page Title */
	$wp_customize->add_setting( 'secondline_themes_page_title_image_position' ,array(
		'default' => 'cover',
		'sanitize_callback' => 'secondline_themes_sanitize_choices',
	) );
	$wp_customize->add_control(new secondline_themes_Controls_Radio_Buttonset_Control($wp_customize, 'secondline_themes_page_title_image_position', array(
		'section' => 'secondline_themes_section_page_title',
		'priority'   => 536,
		'choices'     => array(
			'cover' => esc_html__( 'Image Cover', 'podcaster-secondline' ),
			'repeat-all' => esc_html__( 'Image Pattern', 'podcaster-secondline' ),
		),
		))
	);



		/* Panel - Body */
	$wp_customize->add_panel( 'secondline_themes_blog_panel', array(
		'priority'    => 8,
        'title'       => esc_html__( 'Blog', 'podcaster-secondline' ),
    ) );


	/* Section - Blog - Blog Index Post Options */
   $wp_customize->add_section( 'secondline_themes_section_blog_index', array(
   	'title'          => esc_html__( 'Post Archive Options', 'podcaster-secondline' ),
   	'panel'          => 'secondline_themes_blog_panel', // Not typically needed.
   	'priority'       => 20,
   )
	);


   /* Section - Blog - Blog Index Post Options */
	$wp_customize->add_setting( 'secondline_themes_blog_cat_sidebar' ,array(
		'default' => 'right-sidebar',
		'sanitize_callback' => 'secondline_themes_sanitize_choices',
	) );
	$wp_customize->add_control(new secondline_themes_Controls_Radio_Buttonset_Control($wp_customize, 'secondline_themes_blog_cat_sidebar', array(
		'label'    => esc_html__( 'Category Sidebar', 'podcaster-secondline' ),
		'section' => 'secondline_themes_section_blog_index',
		'priority'   => 70,
		'choices' => array(
			'left-sidebar' => esc_html__( 'Left', 'podcaster-secondline' ),
			'right-sidebar' => esc_html__( 'Right', 'podcaster-secondline' ),
			'no-sidebar' => esc_html__( 'Hidden', 'podcaster-secondline' ),

		 ),
		))
	);


   /* Section - Blog - Blog Index Post Options */
	$wp_customize->add_setting('secondline_themes_blog_columns',array(
		'default' => '2',
		'sanitize_callback' => 'secondline_themes_sanitize_choices',
	) );
	$wp_customize->add_control( new secondline_themes_Controls_Slider_Control($wp_customize, 'secondline_themes_blog_columns', array(
		'label'    => esc_html__( 'Post Columns', 'podcaster-secondline' ),
		'section' => 'secondline_themes_section_blog_index',
		'priority'   => 100,
		'choices'     => array(
			'min'  => 1,
			'max'  => 4,
			'step' => 1
		), ) )
	);


	/* Section - Blog - Blog Index Post Options */
   $wp_customize->add_section( 'secondline_themes_section_blog_options', array(
   	'title'          => esc_html__( 'Blog Post Options', 'podcaster-secondline' ),
   	'panel'          => 'secondline_themes_blog_panel', // Not typically needed.
   	'priority'       => 20,
   )
	);


	/* Setting - General - Page Title */
	$wp_customize->add_setting( 'secondline_themes_post_page_title_bg_image' ,array(
		'default' => get_template_directory_uri().'/images/page-title.jpg',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'secondline_themes_post_page_title_bg_image', array(
		'label'    => esc_html__( 'Post Title Background Image', 'podcaster-secondline' ),
		'section' => 'secondline_themes_section_blog_options',
		'priority'   => 170,
		))
	);


	/* Setting - General - Page Title */
	$wp_customize->add_setting( 'secondline_themes_page_post_title_image_position' ,array(
		'default' => 'cover',
		'sanitize_callback' => 'secondline_themes_sanitize_choices',
	) );
	$wp_customize->add_control(new secondline_themes_Controls_Radio_Buttonset_Control($wp_customize, 'secondline_themes_page_post_title_image_position', array(
		'section' => 'secondline_themes_section_blog_options',
		'priority'   => 180,
		'choices'     => array(
			'cover' => esc_html__( 'Image Cover', 'podcaster-secondline' ),
			'repeat-all' => esc_html__( 'Image Pattern', 'podcaster-secondline' ),
		),
		))
	);



	/* Setting - Body - Page Title */
	$wp_customize->add_setting( 'secondline_themes_post_title_bg_color', array(
		'default' => '#000000',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'secondline_themes_post_title_bg_color', array(
		'label'    => esc_html__( 'Page Title Background Color', 'podcaster-secondline' ),
		'section'  => 'secondline_themes_section_blog_options',
		'priority'   => 190,
		))
	);





   /* Section - Blog - Blog Post Options */
	$wp_customize->add_setting( 'secondline_themes_blog_post_sidebar' ,array(
		'default' => 'right',
		'sanitize_callback' => 'secondline_themes_sanitize_choices',
	) );
	$wp_customize->add_control(new secondline_themes_Controls_Radio_Buttonset_Control($wp_customize, 'secondline_themes_blog_post_sidebar', array(
		'label'    => esc_html__( 'Post Sidebar', 'podcaster-secondline' ),
		'section' => 'secondline_themes_section_blog_options',
		'priority'   => 330,
		'choices'     => array(
			'left' => esc_html__( 'Left', 'podcaster-secondline' ),
			'right' => esc_html__( 'Right', 'podcaster-secondline' ),
			'none' => esc_html__( 'No Sidebar', 'podcaster-secondline' ),
		),
		))
	);



	/* Setting - Body - Button Styles */
	$wp_customize->add_setting('secondline_themes_button_font_size',array(
		'default' => '18',
		'sanitize_callback' => 'secondline_themes_sanitize_choices',
	) );
	$wp_customize->add_control( new secondline_themes_Controls_Slider_Control($wp_customize, 'secondline_themes_button_font_size', array(
		'label'    => esc_html__( 'Button Font Size', 'podcaster-secondline' ),
		'section'  => 'secondline_themes_section_blog_options',
		'priority'   => 1600,
		'choices'     => array(
			'min'  => 0,
			'max'  => 30,
			'step' => 1
		), ) )
	);




	/* Panel - Footer */
	$wp_customize->add_panel( 'secondline_themes_footer_panel', array(
		'priority'    => 11,
        'title'       => esc_html__( 'Footer', 'podcaster-secondline' ),
    )
 	);




 	/* Setting - Footer - Footer Widgets */
	$wp_customize->add_setting('secondline_themes_widgets_margin_top',array(
		'default' => '65',
		'sanitize_callback' => 'secondline_themes_sanitize_choices',
	) );
	$wp_customize->add_control( new secondline_themes_Controls_Slider_Control($wp_customize, 'secondline_themes_widgets_margin_top', array(
		'label'    => esc_html__( 'Footer Widget Margin Top', 'podcaster-secondline' ),
 		'section' => 'secondline_themes_section_widget_layout',
		'priority'   => 20,
		'choices'     => array(
			'min'  => 0,
			'max'  => 150,
			'step' => 1
		), ) )
	);


 	/* Setting - Footer - Footer Widgets */
	$wp_customize->add_setting('secondline_themes_widgets_margin_bottom',array(
		'default' => '40',
		'sanitize_callback' => 'secondline_themes_sanitize_choices',
	) );
	$wp_customize->add_control( new secondline_themes_Controls_Slider_Control($wp_customize, 'secondline_themes_widgets_margin_bottom', array(
		'label'    => esc_html__( 'Footer Widget Margin Bottom', 'podcaster-secondline' ),
 		'section' => 'secondline_themes_section_widget_layout',
		'priority'   => 22,
		'choices'     => array(
			'min'  => 0,
			'max'  => 150,
			'step' => 1
		), ) )
	);





}
add_action( 'customize_register', 'secondline_themes_customizer' );

//HTML Text
function secondline_themes_sanitize_customizer( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

//no-HTML text
function secondline_themes_sanitize_choices( $input ) {
	return wp_filter_nohtml_kses( $input );
}

function secondline_themes_customizer_styles() {
	global $post;

	//https://codex.wordpress.org/Function_Reference/wp_add_inline_style
	wp_enqueue_style( 'secondline-themes-custom-style', get_template_directory_uri() . '/css/secondline_themes_custom_styles.css' );

   if ( get_theme_mod( 'secondline_themes_page_title_image_position', 'cover') == 'cover' ) {
      $secondline_themes_page_tite_bg_cover = "background-repeat: no-repeat; background-position:center center; background-size: cover;";
	}	else {
		$secondline_themes_page_tite_bg_cover = "background-repeat:repeat-all;";
	}

   if ( get_theme_mod( 'secondline_themes_page_post_title_image_position', 'cover') == 'cover' ) {
      $secondline_themes_post_tite_bg_cover = "background-repeat: no-repeat; background-position:center center; background-size: cover;";
	}	else {
		$secondline_themes_post_tite_bg_cover = "background-repeat:repeat-all;";
	}
	
   if ( is_page() && get_post_meta($post->ID, 'secondline_themes_header_image', true ) ) {
      $secondline_themes_custom_page_title_img = "body #page-title-slt {background-image:url('" . esc_url( get_post_meta($post->ID, 'secondline_themes_header_image', true)) . "'); }";
	}	else {
		$secondline_themes_custom_page_title_img = "";
	}
	
	if( is_singular('post') && get_post_meta($post->ID, 'secondline_themes_header_image', true ) ) {
		$secondline_themes_custom_post_title_img = "body #page-title-slt-post-page {background-image:url('" . esc_url( get_post_meta($post->ID, 'secondline_themes_header_image', true)) . "'); }";
	}	else {
		$secondline_themes_custom_post_title_img = "";
	}	
	
   if ( (is_page() && get_post_meta($post->ID, 'secondline_themes_header_image', true ) ) || ( get_theme_mod( 'secondline_themes_page_title_bg_image',  get_template_directory_uri().'/images/page-title.jpg' )  != null ) ) {
	   if ( get_theme_mod( 'secondline_themes_page_title_overlay_color') ) {
		  $secondline_themes_page_tite_overlay_image_cover = "#page-title-slt:before {background:" .  esc_attr( get_theme_mod('secondline_themes_page_title_overlay_color') ) . "; }";
		}	else {
			$secondline_themes_page_tite_overlay_image_cover = "";
		}
   } else {
			$secondline_themes_page_tite_overlay_image_cover = "";
	}	


    $secondline_themes_boxed_layout = "";

	$secondline_themes_custom_css = "
	
	$secondline_themes_custom_page_title_img
	
	$secondline_themes_custom_post_title_img
	
	#page-title-slt {
		background-image:url(" .   esc_attr( get_theme_mod( 'secondline_themes_page_title_bg_image',  get_template_directory_uri().'/images/page-title.jpg' ) ). ");
		$secondline_themes_page_tite_bg_cover
	}
	
	#page-title-slt-post-page {
		background-color: " . esc_attr( get_theme_mod('secondline_themes_post_title_bg_color', '#000000') ) . ";
		background-image:url(" .   esc_attr( get_theme_mod( 'secondline_themes_post_page_title_bg_image',  get_template_directory_uri().'/images/page-title.jpg' ) ). ");
		$secondline_themes_post_tite_bg_cover
	}
		
	#boxed-layout-slt .form-submit input#submit, #boxed-layout-slt input.button, #boxed-layout-slt button.button, #boxed-layout-slt a.button, .infinite-nav-slt a, #newsletter-form-fields input.button, a.secondline-themes-button, .secondline-themes-sticky-post, .post-password-form input[type=submit], #respond input#submit, .wpcf7-form input.wpcf7-submit {
		font-size:" . esc_attr( get_theme_mod('secondline_themes_button_font_size', '18') ) . "px;		
		color:" . esc_attr( get_theme_mod('secondline_themes_button_font', '#ffffff') ) . ";
	}
	#boxed-layout-slt button.button, #boxed-layout-slt a.button { font-size:" . esc_attr( get_theme_mod('secondline_themes_button_font_size', '18') - 1 ) . "px; }
	#boxed-layout-slt .form-submit input#submit:hover, #boxed-layout-slt input.button:hover, #boxed-layout-slt button.button:hover, #boxed-layout-slt a.button:hover, .infinite-nav-slt a:hover, #newsletter-form-fields input.button:hover, a.secondline-themes-button:hover, .post-password-form input[type=submit]:hover, #respond input#submit:hover, .wpcf7-form input.wpcf7-submit:hover {
		background:" . esc_attr( get_theme_mod('secondline_themes_button_background_hover', '#4c4b46') ) . ";
		color:" . esc_attr( get_theme_mod('secondline_themes_button_font_hover', '#ffffff') ) . ";
	}


	#secondline-shopping-cart-count a.secondline-count-icon-nav, nav#site-navigation { letter-spacing: ". esc_attr( get_theme_mod('secondline_themes_nav_letterspacing', '0.5') ). "px; }
	#secondline-inline-icons .secondline-themes-social-icons a {
		padding-top:" . esc_attr( get_theme_mod('secondline_themes_nav_padding', '35') +1 ). "px;
		padding-bottom:" . esc_attr( get_theme_mod('secondline_themes_nav_padding', '35') +1 ). "px;
		font-size:" . esc_attr( get_theme_mod('secondline_themes_nav_font_size', '15')  ). "px;
	}
	.mobile-menu-icon-slt {
		min-width:" . esc_attr( get_theme_mod('secondline_themes_nav_font_size', '15') + 6 ). "px;
		padding-top:" . esc_attr( get_theme_mod('secondline_themes_nav_padding', '35') - 3 ). "px;
		padding-bottom:" . esc_attr( get_theme_mod('secondline_themes_nav_padding', '35') - 5 ). "px;
		font-size:" . esc_attr( get_theme_mod('secondline_themes_nav_font_size', '15') + 6 ). "px;
	}
	.mobile-menu-icon-slt span.secondline-mobile-menu-text {
		font-size:" . esc_attr( get_theme_mod('secondline_themes_nav_font_size', '15') ). "px;
	}
	#secondline-shopping-cart-count span.secondline-cart-count {
		top:" . esc_attr( get_theme_mod('secondline_themes_nav_padding', '35') - 1). "px;
	}
	#secondline-shopping-cart-count a.secondline-count-icon-nav i.shopping-cart-header-icon {
		padding-top:" . esc_attr( get_theme_mod('secondline_themes_nav_padding', '35') - 6 ). "px;
		padding-bottom:" . esc_attr( get_theme_mod('secondline_themes_nav_padding', '35') - 6 ). "px;
		font-size:" . esc_attr( get_theme_mod('secondline_themes_nav_font_size', '15') + 12 ). "px;
	}
	#secondline-themes-header-search-icon i.pe-7s-search {
		padding-top:" . esc_attr( get_theme_mod('secondline_themes_nav_padding', '35') - 5 ). "px;
		padding-bottom:" . esc_attr( get_theme_mod('secondline_themes_nav_padding', '35') - 5 ). "px;
		font-size:" . esc_attr( get_theme_mod('secondline_themes_nav_font_size', '15') + 10 ). "px;
	}
	nav#secondline-themes-right-navigation ul {
		padding-top:" . esc_attr( get_theme_mod('secondline_themes_nav_padding', '35') - 20 ). "px;
	}
	nav#secondline-themes-right-navigation ul li a {
		font-size:" . esc_attr( get_theme_mod('secondline_themes_nav_font_size', '15') ). "px;
	}
	.sf-menu a {
		padding-top:" . esc_attr( get_theme_mod('secondline_themes_nav_padding', '35') ). "px;
		padding-bottom:" . esc_attr( get_theme_mod('secondline_themes_nav_padding', '35') ). "px;
		font-size:" . esc_attr( get_theme_mod('secondline_themes_nav_font_size', '15') ). "px;
	}
	
	.sf-menu li li a {
		font-size:".  esc_attr( get_theme_mod('secondline_themes_sub_nav_font_size', '13') ). "px;
	}
	#secondline-checkout-basket .secondline-sub-total {
		font-size:".  esc_attr( get_theme_mod('secondline_themes_sub_nav_font_size', '13' ) ). "px;
	}
	#panel-search-secondline input, #secondline-checkout-basket ul#secondline-cart-small li.empty {
		font-size:".  esc_attr( get_theme_mod('secondline_themes_sub_nav_font_size', '13' ) ). "px;
	}
	.secondline-fixed-scrolled .sf-menu li li a:hover,  .secondline-fixed-scrolled .sf-menu li.sfHover li a, .secondline-fixed-scrolled .sf-menu li.current-menu-item li a, .sf-menu li.sfHover li a, .sf-menu li.sfHover li.sfHover li a, .sf-menu li.sfHover li.sfHover li.sfHover li a, .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover li a, .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover li.sfHover li a {
		background:none;
	}
	.secondline-mini-banner-icon {
		top:" . esc_attr( (get_theme_mod('secondline_themes_nav_padding', '35') - get_theme_mod('secondline_themes_nav_font_size', '15')) - 4 ). "px;
		right:" . esc_attr( get_theme_mod('secondline_themes_nav_left_right', '18') / 2 ) . "px;
	}

	#secondline-inline-icons .secondline-themes-social-icons a {
		padding-left:" . esc_attr( get_theme_mod('secondline_themes_nav_left_right', '18') -  7 ). "px;
		padding-right:" . esc_attr( get_theme_mod('secondline_themes_nav_left_right', '18') - 7 ). "px;
	}
	#secondline-themes-header-search-icon i.pe-7s-search {
		padding-left:" . esc_attr( get_theme_mod('secondline_themes_nav_left_right', '18') ). "px;
		padding-right:" . esc_attr( get_theme_mod('secondline_themes_nav_left_right', '18') ). "px;
	}
	#secondline-inline-icons .secondline-themes-social-icons {
		padding-right:" . esc_attr( get_theme_mod('secondline_themes_nav_left_right', '18') - 7 ). "px;
	}
	.sf-menu a {
		padding-left:" . esc_attr( get_theme_mod('secondline_themes_nav_left_right', '18') ). "px;
		padding-right:" . esc_attr( get_theme_mod('secondline_themes_nav_left_right', '18') ). "px;
	}

	.sf-menu li.highlight-button {
		margin-right:". esc_attr( get_theme_mod('secondline_themes_nav_left_right', '18') - 7 ) . "px;
		margin-left:" . esc_attr( get_theme_mod('secondline_themes_nav_left_right', '18') - 7 ) . "px;
	}
	.sf-arrows .sf-with-ul {
		padding-right:" . esc_attr( get_theme_mod('secondline_themes_nav_left_right', '18') + 15 ) . "px;
	}
	.sf-arrows .sf-with-ul:after {
		right:" . esc_attr( get_theme_mod('secondline_themes_nav_left_right', '18') + 9 ) . "px;
	}

	.rtl .sf-arrows .sf-with-ul {
		padding-right:" . esc_attr( get_theme_mod('secondline_themes_nav_left_right', '18') ) . "px;
		padding-left:" . esc_attr( get_theme_mod('secondline_themes_nav_left_right', '18') + 15 ) . "px;
	}
	.rtl  .sf-arrows .sf-with-ul:after {
		right:auto;
		left:" . esc_attr( get_theme_mod('secondline_themes_nav_left_right', '18') + 9 ) . "px;
	}

	@media only screen and (min-width: 960px) and (max-width: 1300px) {
		nav#secondline-themes-right-navigation ul li a {
			padding-left:16px;
			padding-right:16px;
		}
		.sf-menu a {
			padding-left:" . esc_attr( get_theme_mod('secondline_themes_nav_left_right', '18') - 4 ). "px;
			padding-right:" . esc_attr( get_theme_mod('secondline_themes_nav_left_right', '18') - 4 ). "px;
		}
		.sf-menu li.highlight-button {
			margin-right:" . esc_attr( get_theme_mod('secondline_themes_nav_left_right', '18') - 12 ). "px;
			margin-left:" . esc_attr( get_theme_mod('secondline_themes_nav_left_right', '18') - 12 ). "px;
		}
		.sf-arrows .sf-with-ul {
			padding-right:" . esc_attr( get_theme_mod('secondline_themes_nav_left_right', '18') + 13 ). "px;
		}
		.sf-arrows .sf-with-ul:after {
			right:" . esc_attr( get_theme_mod('secondline_themes_nav_left_right', '18') + 7 ). "px;
		}
		.rtl .sf-arrows .sf-with-ul {
			padding-left:" . esc_attr( get_theme_mod('secondline_themes_nav_left_right', '18')  ). "px;
			padding-left:" . esc_attr( get_theme_mod('secondline_themes_nav_left_right', '18') + 13 ). "px;
		}
		.rtl .sf-arrows .sf-with-ul:after {
			right:auto;
			left:" . esc_attr( get_theme_mod('secondline_themes_nav_left_right', '18') + 7 ). "px;
		}
		#secondline-inline-icons .secondline-themes-social-icons a {
			padding-left:" . esc_attr( get_theme_mod('secondline_themes_nav_left_right', '18') -  12 ). "px;
			padding-right:" . esc_attr( get_theme_mod('secondline_themes_nav_left_right', '18') - 12 ). "px;
		}
		#secondline-themes-header-search-icon i.pe-7s-search {
			padding-left:" . esc_attr( get_theme_mod('secondline_themes_nav_left_right', '18') - 4). "px;
			padding-right:" . esc_attr( get_theme_mod('secondline_themes_nav_left_right', '18') - 4). "px;
		}
		#secondline-inline-icons .secondline-themes-social-icons {
			padding-right:" . esc_attr( get_theme_mod('secondline_themes_nav_left_right', '18') - 12 ). "px;
		}
	}

	#secondline-themes-lower-widget-container .widget, #widget-area-secondline .widget { padding:" . esc_attr(get_theme_mod('secondline_themes_widgets_margin_top', '65')) . "px 0px " . esc_attr(get_theme_mod('secondline_themes_widgets_margin_bottom', '40')) . "px 0px; }	

	@media only screen and (max-width: 959px) {
		#secondline-themes-lower-widget-container .widget, #widget-area-secondline .widget { padding:" . esc_attr(get_theme_mod('secondline_themes_widgets_margin_top', '65') - 10 ) . "px 0px " . esc_attr(get_theme_mod('secondline_themes_widgets_margin_bottom', '40') - 10 ) . "px 0px; }
	}

	$secondline_themes_boxed_layout
	";
        wp_add_inline_style( 'secondline-themes-custom-style', $secondline_themes_custom_css );
}
add_action( 'wp_enqueue_scripts', 'secondline_themes_customizer_styles' );
