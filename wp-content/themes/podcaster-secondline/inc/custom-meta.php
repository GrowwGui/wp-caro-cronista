<?php

add_action( 'cmb2_admin_init', 'secondline_podcaster_page_metabox' );
function secondline_podcaster_page_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'secondline_themes_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$secondline_themes_cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'metabox_page_settings',
		'title'         => esc_html__('Page Settings', 'podcaster-secondline'),
		'object_types'  => array( 'page' ), // Post type,
	) );
	
	
	$secondline_themes_cmb_demo->add_field( array(
		'name'       => esc_html__('Sub-title', 'podcaster-secondline'),
		'id'         => $prefix . 'sub_title',
		'type'       => 'text',
	) );

	$secondline_themes_cmb_demo->add_field( array(
		'name'       => esc_html__('Sidebar Display', 'podcaster-secondline'),
		'id'         => $prefix . 'page_sidebar',
		'type'       => 'select',
		'options'     => array(
			'hidden-sidebar'   => esc_html__( 'Hide Sidebar', 'podcaster-secondline' ),
			'right-sidebar'    => esc_html__( 'Right', 'podcaster-secondline' ),
			'left-sidebar'    => esc_html__( 'Left', 'podcaster-secondline' ),
		),
	) );
	
	$secondline_themes_cmb_demo->add_field( array(
		'name' => esc_html__('Title Area Background Image', 'podcaster-secondline'),
		'id'         => $prefix . 'header_image',
		'type'         => 'file',
		'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
	) );
	
	$secondline_themes_cmb_demo->add_field( array(
		'name'       => esc_html__('Disable Title Area', 'podcaster-secondline'),
		'id'         => $prefix . 'disable_page_title',
		'type'       => 'checkbox',
	) );
	
}




add_action( 'cmb2_admin_init', 'secondline_podcaster_index_post_metabox' );
function secondline_podcaster_index_post_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'secondline_themes_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$secondline_themes_cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'metabox_post',
		'title'         => esc_html__('Post Settings', 'podcaster-secondline'),
		'object_types'  => array( 'post' ), // Post type
	) );
    
	$secondline_themes_cmb_demo->add_field( array(
		'name' => esc_html__('Title Area Background Image', 'podcaster-secondline'),
		'id'         => $prefix . 'header_image',
		'type'         => 'file',
		'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
	) );    	
	
	

	
	
}




add_action( 'cmb2_admin_init', 'secondline_podcaster_user_metabox' );
/**
 * Hook in and add a metabox to demonstrate repeatable grouped fields
 */
function secondline_podcaster_user_metabox() {
	
	// Start with an underscore to hide fields from custom fields list
	$prefix = 'secondline_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$secondline_cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'user_author_info',
		'title'         => esc_html__('Author Settings', 'podcaster-secondline'),
		'object_types'     => array( 'user' ), // Tells CMB2 to use user_meta vs post_meta

	) );
	
	$secondline_cmb_demo->add_field( array(
		'name'     => esc_html__( 'Author Information', 'podcaster-secondline' ),
		'id'       => $prefix . 'extra_info',
		'type'     => 'title',
		'on_front' => false,
	) );
	

	$secondline_cmb_demo->add_field( array(
		'name' => esc_html__( 'Author Sub-headline', 'podcaster-secondline' ),
		'desc' => esc_html__( 'Leave blank to hide this field', 'podcaster-secondline' ),
		'id'   => $prefix . 'user_sub_headline',
		'type' => 'text',
	) );
	
	$secondline_cmb_demo->add_field( array(
		'name' => esc_html__( 'Author Website URL', 'podcaster-secondline' ),
		'desc' => esc_html__( 'Leave blank to hide this field', 'podcaster-secondline' ),
		'id'   => $prefix . 'authorurl',
		'type' => 'text_url',
	) );

	$secondline_cmb_demo->add_field( array(
		'name' => esc_html__( 'Facebook URL', 'podcaster-secondline' ),
		'desc' => esc_html__( 'Leave blank to hide this field', 'podcaster-secondline' ),
		'id'   => $prefix . 'facebookurl',
		'type' => 'text_url',
	) );

	$secondline_cmb_demo->add_field( array(
		'name' => esc_html__( 'Twitter URL', 'podcaster-secondline' ),
		'desc' => esc_html__( 'Leave blank to hide this field', 'podcaster-secondline' ),
		'id'   => $prefix . 'twitterurl',
		'type' => 'text_url',
	) );
	
	$secondline_cmb_demo->add_field( array(
		'name' => esc_html__( 'Dribbble URL', 'podcaster-secondline' ),
		'desc' => esc_html__( 'Leave blank to hide this field', 'podcaster-secondline' ),
		'id'   => $prefix . 'dribbbleurlurl',
		'type' => 'text_url',
	) );


	$secondline_cmb_demo->add_field( array(
		'name' => esc_html__( 'Linkedin URL', 'podcaster-secondline' ),
		'desc' => esc_html__( 'Leave blank to hide this field', 'podcaster-secondline' ),
		'id'   => $prefix . 'linkedinurl',
		'type' => 'text_url',
	) );
	
	$secondline_cmb_demo->add_field( array(
		'name' => esc_html__( 'Pinterest URL', 'podcaster-secondline' ),
		'desc' => esc_html__( 'Leave blank to hide this field', 'podcaster-secondline' ),
		'id'   => $prefix . 'pinteresturl',
		'type' => 'text_url',
	) );
	
	$secondline_cmb_demo->add_field( array(
		'name' => esc_html__( 'MixCloud URL', 'podcaster-secondline' ),
		'desc' => esc_html__( 'Leave blank to hide this field', 'podcaster-secondline' ),
		'id'   => $prefix . 'mixcloudurl',
		'type' => 'text_url',
	) );
	
	
	$secondline_cmb_demo->add_field( array(
		'name' => esc_html__( 'Google+ URL', 'podcaster-secondline' ),
		'desc' => esc_html__( 'Leave blank to hide this field', 'podcaster-secondline' ),
		'id'   => $prefix . 'googleplusurl',
		'type' => 'text_url',
	) );
	
	$secondline_cmb_demo->add_field( array(
		'name' => esc_html__( 'Instagram URL', 'podcaster-secondline' ),
		'desc' => esc_html__( 'Leave blank to hide this field', 'podcaster-secondline' ),
		'id'   => $prefix . 'instagramurl',
		'type' => 'text_url',
	) );
	
	

	
	$secondline_cmb_demo->add_field( array(
		'name' => esc_html__( 'Youtube URL', 'podcaster-secondline' ),
		'desc' => esc_html__( 'Leave blank to hide this field', 'podcaster-secondline' ),
		'id'   => $prefix . 'youtubeurl',
		'type' => 'text_url',
	) );
	


	$secondline_cmb_demo->add_field( array(
		'name' => esc_html__( 'Vimeo URL', 'podcaster-secondline' ),
		'desc' => esc_html__( 'Leave blank to hide this field', 'podcaster-secondline' ),
		'id'   => $prefix . 'vimeourl',
		'type' => 'text_url',
	) );
	
	$secondline_cmb_demo->add_field( array(
		'name' => esc_html__( 'Soundcloud URL', 'podcaster-secondline' ),
		'desc' => esc_html__( 'Leave blank to hide this field', 'podcaster-secondline' ),
		'id'   => $prefix . 'soundcloudurl',
		'type' => 'text_url',
	) );
	
	
	$secondline_cmb_demo->add_field( array(
		'name' => esc_html__( 'MixCloud URL', 'podcaster-secondline' ),
		'desc' => esc_html__( 'Leave blank to hide this field', 'podcaster-secondline' ),
		'id'   => $prefix . 'mixcloudurl',
		'type' => 'text_url',
	) );

	
	
	
	$secondline_cmb_demo->add_field( array(
		'name' => esc_html__( 'E-mail Address', 'podcaster-secondline' ),
		'desc' => esc_html__( 'Leave blank to hide this field', 'podcaster-secondline' ),
		'id'   => $prefix . 'emailmailto',
		'type' => 'text',
	) );
	

}




