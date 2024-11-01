<?php
/* ------------------------------------------------------------------------- *
 *  ______
 *
 *  Features Section
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
	$wp_customize->add_section( new TUEXT_Section_FrontPage( $wp_customize, 'tradeup_section__features', array(
		'title'				=> esc_html__( 'Features Section', 'tradeup-extensions' ),
		'panel'				=> 'tradeup_panel__sections',
		'priority'			=> absint( tradeup_extensions_sec_prio( 'tradeup_section__features' ) ),
	) ) );



		/*  Features Section options
		/* ------------------------------------ */
		$wp_customize->add_setting( 'features-addedititems', array() );

		$wp_customize->add_control( new TUEXT_Control_AddEditItems( $wp_customize, 'features-addedititems', array(
			'section'      => 'tradeup_section__features',
			'type'         => 'add-edit-items',
			'section_type' => 'features',
			'item_type'    => __( 'Add or edit features', 'tradeup-extensions' )
		) ) );

		// Hide section
		tradeup_controller_checkbox(
			'features_section_hide',
			'tradeup_section__features',
			esc_html__( 'Hide this section', 'tradeup-extensions' ) );
		/*=====*/

		// Section title
		tradeup_controller_txt(
			'features_section_title',
			'tradeup_section__features',
			esc_html__( 'Section title', 'tradeup-extensions' ),
			esc_html__( 'Set a title for this section.', 'tradeup-extensions' ),
			esc_html__( 'Our Features', 'tradeup-extensions' ),
			'.sec-features .section-title' );
		/*=====*/

		// Section tabs
		$wp_customize->add_setting( 'features-sectiontabs', array() );

		$wp_customize->add_control( new TUEXT_Control_Tabs( $wp_customize, 'features-sectiontabs', array(
			'section'          => 'tradeup_section__features',
			'type'             => 'section-tabs',
			'title_colors'     => __( 'Colors', 'tradeup-extensions' ),
			'title_background' => __( 'Background', 'tradeup-extensions' )
		) ) );

		// Section colors
		tradeup_controller_color_picker(
			'features_color_background',
			'tradeup_section__features',
			esc_html__( 'Section background color:', 'tradeup-extensions' ),
			esc_html__( 'In case you do not have a background image', 'tradeup-extensions' ),
			'#282e3f' );
		/*=====*/

		tradeup_controller_color_picker(
			'features_color_heading_link',
			'tradeup_section__features',
			esc_html__( 'Headings color:', 'tradeup-extensions' ),
			'', '#ffffff' );
		/*=====*/

		tradeup_controller_color_picker(
			'features_color_text',
			'tradeup_section__features',
			esc_html__( 'Text color:', 'tradeup-extensions' ),
			'', '#a7a6a6' );
		/*=====*/

		// Background image
		tradeup_controller_bg_image( 'features_bg_image', 'tradeup_section__features', esc_html__( 'Background Image:', 'tradeup-extensions' ), '', esc_html__( 'Use a HD image, suggested size: 1920x1080px', 'tradeup-extensions' ) );
		/*=====*/

		// Background overlay
		tradeup_controller_bg_overlay( 'features_bg_overlay', 'tradeup_section__features', esc_html__( 'Show Background Overlay', 'tradeup-extensions' ) );
		/*=====*/

		// Backgroud parallax
		tradeup_controller_bg_parallax( 'features_bg_parallax', 'tradeup_section__features', esc_html__( 'Enable Parallax Effect', 'tradeup-extensions' ) );
		tradeup_controller_simple_image(
			'features_bg_parallax_img',
			'tradeup_section__features',
			esc_html__( 'Parallax Background Image', 'tradeup-extensions' ),
			esc_html__( 'Use a HD image, suggested size: 1920x1080px', 'tradeup-extensions' ), '', false
		);
		/*=====*/
