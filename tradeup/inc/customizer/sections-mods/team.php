<?php
/* ------------------------------------------------------------------------- *
 *  ______
 *
 *  Team Section
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
	$wp_customize->add_section( new TUEXT_Section_FrontPage( $wp_customize, 'tradeup_section__team', array(
		'title'				=> esc_html__( 'Team Section', 'tradeup-extensions' ),
		'panel'				=> 'tradeup_panel__sections',
		'priority'			=> absint( tradeup_extensions_sec_prio( 'tradeup_section__team' ) ),
	) ) );



		/*  Team Section options
		/* ------------------------------------ */
		$wp_customize->add_setting( 'team-addedititems', array() );

		$wp_customize->add_control( new TUEXT_Control_AddEditItems( $wp_customize, 'team-addedititems', array(
			'section'      => 'tradeup_section__team',
			'type'         => 'add-edit-items',
			'section_type' => 'team',
			'item_type'    => __( 'Add or edit members', 'tradeup-extensions' )
		) ) );

		// Hide section
		tradeup_controller_checkbox(
			'team_section_hide',
			'tradeup_section__team',
			esc_html__( 'Hide this section', 'tradeup-extensions' ) );
		/*=====*/

		// Section title
		tradeup_controller_txt(
			'team_section_title',
			'tradeup_section__team',
			esc_html__( 'Section title', 'tradeup-extensions' ),
			esc_html__( 'Set a title for this section.', 'tradeup-extensions' ),
			esc_html__( 'Our Team', 'tradeup-extensions' ),
			'.sec-team .section-title' );
		/*=====*/

		// Section description
		tradeup_controller_txt_area(
			'team_section_description',
			'tradeup_section__team',
			esc_html__( 'Section description', 'tradeup-extensions' ),
			esc_html__( 'Set a description for this section.', 'tradeup-extensions' ),
			esc_html__( 'This is description field for the Team section. You have to setup this section at Customizer > Homepage Sections > Team Section.', 'tradeup-extensions' ),
			'.sec-team .section-description', true, 'tradeup_ext_sanitize_content_filtered' );
		/*=====*/

		// Section tabs
		$wp_customize->add_setting( 'team-sectiontabs', array() );

		$wp_customize->add_control( new TUEXT_Control_Tabs( $wp_customize, 'team-sectiontabs', array(
			'section'          => 'tradeup_section__team',
			'type'             => 'section-tabs',
			'title_colors'     => __( 'Colors', 'tradeup-extensions' ),
			'title_background' => __( 'Background', 'tradeup-extensions' )
		) ) );

		// Section colors
		tradeup_controller_color_picker(
			'team_color_background',
			'tradeup_section__team',
			esc_html__( 'Section background color:', 'tradeup-extensions' ),
			esc_html__( 'In case you do not have a background image', 'tradeup-extensions' ),
			'#ffffff' );
		/*=====*/

		tradeup_controller_color_picker(
			'team_color_heading_link',
			'tradeup_section__team',
			esc_html__( 'Headings color:', 'tradeup-extensions' ),
			'', '#000' );
		/*=====*/

		tradeup_controller_color_picker(
			'team_color_text',
			'tradeup_section__team',
			esc_html__( 'Title color:', 'tradeup-extensions' ),
			'', '#000' );
		/*=====*/

		tradeup_controller_color_picker(
			'team_color_heading_border',
			'tradeup_section__team',
			esc_html__( 'Separator color:', 'tradeup-extensions' ),
			'', '#e91e63' );
		/*=====*/

		tradeup_controller_color_picker(
			'team_color_hover',
			'tradeup_section__team',
			esc_html__( 'Position Color', 'tradeup-extensions' ),
			'',
			'#e91e63' );
		/*=====*/

		// Background image
		tradeup_controller_bg_image( 'team_bg_image', 'tradeup_section__team', esc_html__( 'Background Image:', 'tradeup-extensions' ), '', esc_html__( 'Use a HD image, suggested size: 1920x1080px', 'tradeup-extensions' ) );
		/*=====*/

		// Background overlay
		tradeup_controller_bg_overlay( 'team_bg_overlay', 'tradeup_section__team', esc_html__( 'Show Background Overlay', 'tradeup-extensions' ) );
		/*=====*/

		// Backgroud parallax
		tradeup_controller_bg_parallax( 'team_bg_parallax', 'tradeup_section__team', esc_html__( 'Enable Parallax Effect', 'tradeup-extensions' ) );
		tradeup_controller_simple_image(
			'team_bg_parallax_img',
			'tradeup_section__team',
			esc_html__( 'Parallax Background Image', 'tradeup-extensions' ),
			esc_html__( 'Use a HD image, suggested size: 1920x1080px', 'tradeup-extensions' ), '', false
		);
		/*=====*/
