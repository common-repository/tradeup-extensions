<?php
/* ------------------------------------------------------------------------- *
 *  ______
 *
 *  Slider Section
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
	$wp_customize->add_section( new TUEXT_Section_FrontPage( $wp_customize, 'tradeup_section__slider', array(
		'title'				=> esc_html__( 'Slider Section', 'tradeup-extensions' ),
		'panel'				=> 'tradeup_panel__sections',
		'priority'			=> absint( tradeup_extensions_sec_prio( 'tradeup_section__slider' ) ),
	) ) );



		/*  Slider Section options
		/* ------------------------------------ */
		$wp_customize->add_setting( 'slider-addedititems', array() );

		$wp_customize->add_control( new TUEXT_Control_AddEditItems( $wp_customize, 'slider-addedititems', array(
			'section'      => 'tradeup_section__slider',
			'type'         => 'add-edit-items',
			'section_type' => 'slider',
			'item_type'    => __( 'Add or edit slides', 'tradeup-extensions' )
		) ) );

		// Hide section
		tradeup_controller_checkbox(
			'slider_section_hide',
			'tradeup_section__slider',
			esc_html__( 'Hide this section', 'tradeup-extensions' ) );
		/*=====*/

		// Disable arrows
		tradeup_controller_checkbox(
			'slider_arrows_disable',
			'tradeup_section__slider',
			esc_html__( 'Disable arrows', 'tradeup-extensions' ), esc_html__( 'This will disable navigation arrows', 'tradeup-extensions' ),
			false, false );
		/*=====*/

		// Autoplay options
		tradeup_controller_checkbox(
			'slider_autoplay_enable',
			'tradeup_section__slider',
			esc_html__( 'Enable autoplay', 'tradeup-extensions' ), esc_html__( 'This will only work on the live website', 'tradeup-extensions' ),
			false, true );
		/*=====*/

		tradeup_controller_txt(
			'slider_autoplay_delay',
			'tradeup_section__slider',
			esc_html__( 'Autoplay delay', 'tradeup-extensions' ), esc_html__( 'In miliseconds, 5000 = 5 seconds. This will only work on the live website', 'tradeup-extensions' ),
			'5000',
			'', true, false, 'absint' );
		/*=====*/

		// Section colors
		tradeup_controller_color_picker(
			'slider_background_color',
			'tradeup_section__slider',
			esc_html__( 'Section background color:', 'tradeup-extensions' ),
			esc_html__( 'In case you do not have a background image', 'tradeup-extensions' ),
			'#232323' );
		/*=====*/

		// Arrows
		tradeup_controller_rgba_picker(
			'slider_arrows_bg',
			'tradeup_section__slider',
			esc_html__( 'Arrows background color:', 'tradeup-extensions' ),
			'', 'rgba(255,255,255,0.1)', true, false );
		/*=====*/

		tradeup_controller_rgba_picker(
			'slider_arrows_bg_hover',
			'tradeup_section__slider',
			esc_html__( 'Arrows :hover bg color:', 'tradeup-extensions' ),
			'', 'rgba(255,255,255,0.2)', true, false );
		/*=====*/

		tradeup_controller_color_picker(
			'slider_arrows_color',
			'tradeup_section__slider',
			esc_html__( 'Arrows icon color:', 'tradeup-extensions' ),
			'', '#ffffff' );
		/*=====*/

		// Dots
		tradeup_controller_rgba_picker(
			'slider_dots_bg',
			'tradeup_section__slider',
			esc_html__( 'Dots background color:', 'tradeup-extensions' ),
			'', 'rgba(255,255,255,0.2)', true, false );
		/*=====*/

		tradeup_controller_rgba_picker(
			'slider_dots_bg_hover',
			'tradeup_section__slider',
			esc_html__( 'Dots hover bg color:', 'tradeup-extensions' ),
			'', 'rgba(255,255,255,0.4)', true, false );
		/*=====*/

		tradeup_controller_color_picker(
			'slider_dots_active',
			'tradeup_section__slider',
			esc_html__( 'Dots active border color:', 'tradeup-extensions' ),
			'', '#ffffff' );
		/*=====*/
