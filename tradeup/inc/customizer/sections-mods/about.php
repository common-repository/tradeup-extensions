<?php
/* ------------------------------------------------------------------------- *
 *  ______
 *
 *  About Us Section
 *  ________________
 *
 *	Settings and controls options
 *	_____________________________
 *
 *	All the "tradeup_controller_*" are located in the theme:
 *	../tradeup-controls/customizer/customizer.php
 *
 *	They use $wp_customize->add_setting and $wp_customize->add_control to
 *	add settings and controls, all sanitized.
 *
/* ------------------------------------------------------------------------- */



	/*  Add section
	/* ------------------------------------ */
	$wp_customize->add_section( new TUEXT_Section_FrontPage( $wp_customize, 'tradeup_section__about', array(
		'title'				=>  esc_html__( 'Services Section', 'tradeup-extensions' ),
		'panel'				=> 'tradeup_panel__sections',
		'priority'			=> absint( tradeup_extensions_sec_prio( 'tradeup_section__about' ) ),
	) ) );



		/*  About Us Section options
		/* ------------------------------------ */
		$wp_customize->add_setting( 'about-addedititems', array() );

		$wp_customize->add_control( new TUEXT_Control_AddEditItems( $wp_customize, 'about-addedititems', array(
			'section'      => 'tradeup_section__about',
			'type'         => 'add-edit-items',
			'section_type' => 'about',
			'item_type'    => __( 'Add or edit service boxes', 'tradeup-extensions' )
		) ) );

		// Hide section
		tradeup_controller_checkbox(
			'about_section_hide',
			'tradeup_section__about',
			esc_html__( 'Hide this section', 'tradeup-extensions' ) );
		/*=====*/

		// Section title
		tradeup_controller_txt(
			'about_section_title',
			'tradeup_section__about',
			esc_html__( 'Section title', 'tradeup-extensions' ),
			esc_html__( 'Set a title for this section.', 'tradeup-extensions' ),
			esc_html__( 'Services', 'tradeup-extensions' ),
			'.sec-about .section-title' );
		/*=====*/

		// Section description
		tradeup_controller_txt_area(
			'about_section_description',
			'tradeup_section__about',
			esc_html__( 'Section description', 'tradeup-extensions' ),
			esc_html__( 'Set a description for this section.', 'tradeup-extensions' ),
			esc_html__( 'This is a description for the About Us section. You can set it up in the Customizer where you can also add items for it.', 'tradeup-extensions' ),
			'.sec-about .section-description', true, 'tradeup_ext_sanitize_content_filtered' );
		/*=====*/

		// Section button anchor
		tradeup_controller_txt(
			'about_section_btn_anchor',
			'tradeup_section__about',
			esc_html__( 'Button Anchor Text', 'tradeup-extensions' ),
			'', esc_html__( 'Know More', 'tradeup-extensions' ),
			'.sec-about .about-button .ac-btn' );
		/*=====*/

		// Section button anchor
		tradeup_controller_txt(
			'about_section_btn_anchor_url',
			'tradeup_section__about',
			esc_html__( 'Button Link', 'tradeup-extensions' ),
			'', '#', '', true, false );
		/*=====*/

		//  Button Target
		tradeup_controller_checkbox(
			'about_section_btn_target',
			'tradeup_section__about',
			esc_html__( 'Open link in a new window', 'tradeup-extensions' ), '', false, true );
		/*=====*/

		// Hide section button
		tradeup_controller_checkbox(
			'about_section_hide_btn',
			'tradeup_section__about',
			esc_html__( 'Hide this button', 'tradeup-extensions' ) );
		/*=====*/

		// Section tabs
		$wp_customize->add_setting( 'about-sectiontabs', array() );

		$wp_customize->add_control( new TUEXT_Control_Tabs( $wp_customize, 'about-sectiontabs', array(
			'section'          => 'tradeup_section__about',
			'type'             => 'section-tabs',
			'title_colors'     => __( 'Colors', 'tradeup-extensions' ),
			'title_background' => __( 'Background', 'tradeup-extensions' )
		) ) );

		// Section colors
		tradeup_controller_color_picker(
			'about_color_background',
			'tradeup_section__about',
			esc_html__( 'Section background color:', 'tradeup-extensions' ),
			esc_html__( 'In case you do not have a background image', 'tradeup-extensions' ),
			'#fff' );
		/*=====*/

		tradeup_controller_color_picker(
			'about_color_heading_link',
			'tradeup_section__about',
			esc_html__( 'Headings colors:', 'tradeup-extensions' ),
			'', '#000' );
		/*=====*/

		tradeup_controller_color_picker(
			'about_color_heading_border',
			'tradeup_section__about',
			esc_html__( 'Border & Separator color:', 'tradeup-extensions' ),
			esc_html__( 'Applies to the Section Heading and boxes', 'tradeup-extensions' ),
			'#e91e63' );
		/*=====*/

		tradeup_controller_color_picker(
			'about_color_text',
			'tradeup_section__about',
			esc_html__( 'Text color:', 'tradeup-extensions' ),
			'', '#666666' );
		/*=====*/

		tradeup_controller_rgba_picker(
			'about_color_btn',
			'tradeup_section__about',
			esc_html__( 'Button background color:', 'tradeup-extensions' ),
			'', '#e91e63', true, false );
		/*=====*/

		tradeup_controller_color_picker(
			'about_color_btn_2nd',
			'tradeup_section__about',
			esc_html__( 'Button Hover & Border color:', 'tradeup-extensions' ),
			esc_html__( 'This applies to the border and hover state', 'tradeup-extensions' ),
			'#980336' );
		/*=====*/

		// Background image
		tradeup_controller_bg_image( 'about_bg_image', 'tradeup_section__about', esc_html__( 'Background Image:', 'tradeup-extensions' ), '', esc_html__( 'Use a HD image, suggested size: 1920x1080px', 'tradeup-extensions' ) );
		/*=====*/

		// Background overlay
		tradeup_controller_bg_overlay( 'about_bg_overlay', 'tradeup_section__about', esc_html__( 'Show Background Overlay', 'tradeup-extensions' ) );
		/*=====*/

		// Backgroud parallax
		tradeup_controller_bg_parallax( 'about_bg_parallax', 'tradeup_section__about', esc_html__( 'Enable Parallax Effect', 'tradeup-extensions' ) );
		tradeup_controller_simple_image(
			'about_bg_parallax_img',
			'tradeup_section__about',
			esc_html__( 'Parallax Background Image', 'tradeup-extensions' ),
			esc_html__( 'Use a HD image, suggested size: 1920x1080px', 'tradeup-extensions' ), '', false
		);
		/*=====*/
