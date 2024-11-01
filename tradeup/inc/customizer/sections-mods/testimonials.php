<?php
/* ------------------------------------------------------------------------- *
 *  ______
 *
 *  Testimonials
 *  ________________
 *
 *	Panel, settings and controls options
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
	$wp_customize->add_section( new TUEXT_Section_FrontPage( $wp_customize, 'tradeup_section__testimonials', array(
		'title'				=> esc_html__( 'Testimonials Section', 'tradeup-extensions' ),
		'panel'				=> 'tradeup_panel__sections',
		'priority'			=> absint( tradeup_extensions_sec_prio( 'tradeup_section__testimonials' ) ),
	) ) );



		/*  Testimonials Section options
		/* ------------------------------------ */
		$wp_customize->add_setting( 'testimonials-addedititems', array() );

		$wp_customize->add_control( new TUEXT_Control_AddEditItems( $wp_customize, 'testimonials-addedititems', array(
			'section'      => 'tradeup_section__testimonials',
			'type'         => 'add-edit-items',
			'section_type' => 'testimonials',
			'item_type'    => __( 'Add or edit testimonials', 'tradeup-extensions' )
		) ) );

		// Hide section
		tradeup_controller_checkbox(
			'testimonials_section_hide',
			'tradeup_section__testimonials',
			esc_html__( 'Hide this section', 'tradeup-extensions' ) );
		/*=====*/

		// Section title
		tradeup_controller_txt(
			'testimonials_section_title',
			'tradeup_section__testimonials',
			esc_html__( 'Section title', 'tradeup-extensions' ),
			esc_html__( 'Set a title for this section.', 'tradeup-extensions' ),
			esc_html__( 'Testimonials', 'tradeup-extensions' ),
			'.sec-testimonials .section-title' );
		/*=====*/

		// Section tabs
		$wp_customize->add_setting( 'testimonials-sectiontabs', array() );

		$wp_customize->add_control( new TUEXT_Control_Tabs( $wp_customize, 'testimonials-sectiontabs', array(
			'section'          => 'tradeup_section__testimonials',
			'type'             => 'section-tabs',
			'title_colors'     => __( 'Colors', 'tradeup-extensions' ),
			'title_background' => __( 'Background', 'tradeup-extensions' )
		) ) );

		// Section colors
		tradeup_controller_color_picker(
			'testimonials_color_background',
			'tradeup_section__testimonials',
			esc_html__( 'Section background color:', 'tradeup-extensions' ),
			esc_html__( 'In case you do not have a background image', 'tradeup-extensions' ),
			'#fff' );
		/*=====*/

		tradeup_controller_color_picker(
			'testimonials_color_headings',
			'tradeup_section__testimonials',
			esc_html__( 'Client Name color:', 'tradeup-extensions' ),
			'', '#000' );
		/*=====*/

		tradeup_controller_color_picker(
			'testimonials_color_heading_border',
			'tradeup_section__testimonials',
			esc_html__( 'Quotation color:', 'tradeup-extensions' ),
			'', '#e91e63' );
		/*=====*/

		tradeup_controller_color_picker(
			'testimonials_color_text',
			'tradeup_section__testimonials',
			esc_html__( 'Section Title color:', 'tradeup-extensions' ),
			'', '#000' );
		/*=====*/

		tradeup_controller_color_picker(
			'testimonials_color_avatar_bg',
			'tradeup_section__testimonials',
			esc_html__( 'Text Color:', 'tradeup-extensions' ),
			'', '#666666' );
		/*=====*/

		tradeup_controller_color_picker(
			'testimonials_color_button_bg',
			'tradeup_section__testimonials',
			esc_html__( 'Button background:', 'tradeup-extensions' ),
			'', '#e91e63' );
		/*=====*/

		tradeup_controller_color_picker(
			'testimonials_color_button_bg_hover',
			'tradeup_section__testimonials',
			esc_html__( 'Button :hover background:', 'tradeup-extensions' ),
			'', '#aa7bff' );
		/*=====*/

		tradeup_controller_color_picker(
			'testimonials_color_button_bg_active',
			'tradeup_section__testimonials',
			esc_html__( 'Button :active background:', 'tradeup-extensions' ),
			'', '#6c32d4' );
		/*=====*/

		tradeup_controller_rgba_picker(
			'testimonials_color_nav_bg',
			'tradeup_section__testimonials',
			esc_html__( 'Navigation background color:', 'tradeup-extensions' ),
			'', '#e91e63' );
		/*=====*/

		tradeup_controller_color_picker(
			'testimonials_color_nav_border',
			'tradeup_section__testimonials',
			esc_html__( 'Navigation border color:', 'tradeup-extensions' ),
			'', '#e91e63' );
		/*=====*/

		tradeup_controller_color_picker(
			'testimonials_color_nav_btns',
			'tradeup_section__testimonials',
			esc_html__( 'Navigation font color:', 'tradeup-extensions' ),
			'', '#ffffff' );
		/*=====*/

		// Background image
		tradeup_controller_bg_image( 'testimonials_bg_image', 'tradeup_section__testimonials', esc_html__( 'Background Image:', 'tradeup-extensions' ), '', esc_html__( 'Use a HD image, suggested size: 1920x1080px', 'tradeup-extensions' ) );
		/*=====*/

		// Background overlay
		tradeup_controller_bg_overlay( 'testimonials_bg_overlay', 'tradeup_section__testimonials', esc_html__( 'Show Background Overlay', 'tradeup-extensions' ) );
		/*=====*/

		// Backgroud parallax
		tradeup_controller_bg_parallax( 'testimonials_bg_parallax', 'tradeup_section__testimonials', esc_html__( 'Enable Parallax Effect', 'tradeup-extensions' ) );
		tradeup_controller_simple_image(
			'testimonials_bg_parallax_img',
			'tradeup_section__testimonials',
			esc_html__( 'Parallax Background Image', 'tradeup-extensions' ),
			esc_html__( 'Use a HD image, suggested size: 1920x1080px', 'tradeup-extensions' ), '', false
		);
		/*=====*/
