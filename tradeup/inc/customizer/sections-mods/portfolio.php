<?php
/* ------------------------------------------------------------------------- *
 *  ______
 *
 *  Portfolio Section
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
	$wp_customize->add_section( new TUEXT_Section_FrontPage( $wp_customize, 'tradeup_section__portfolio', array(
		'title'				=> esc_html__( 'Portfolio Section', 'tradeup-extensions' ),
		'panel'				=> 'tradeup_panel__sections',
		'priority'			=> absint( tradeup_extensions_sec_prio( 'tradeup_section__portfolio' ) ),
	) ) );



		/*  Portfolio Section options
		/* ------------------------------------ */

		// Hide section
		tradeup_controller_checkbox(
			'portfolio_section_hide',
			'tradeup_section__portfolio',
			esc_html__( 'Hide this section', 'tradeup-extensions' ) );
		/*=====*/

		// Section title
		tradeup_controller_txt(
			'portfolio_section_title',
			'tradeup_section__portfolio',
			esc_html__( 'Section title', 'tradeup-extensions' ),
			esc_html__( 'Set a title for this section.', 'tradeup-extensions' ),
			esc_html__( 'Portfolio', 'tradeup-extensions' ),
			'.sec-portfolio .section-title' );
		/*=====*/

		// Section description
		tradeup_controller_txt_area(
			'portfolio_section_description',
			'tradeup_section__portfolio',
			esc_html__( 'Section description', 'tradeup-extensions' ),
			esc_html__( 'Set a description for this section.', 'tradeup-extensions' ),
			esc_html__( 'This is description feild for the Portfolio section. Portfolio content will appear from the Portfolio custom post type post. You can find Portfolio settings at Customizer > Homepage Sections > Portfolio Section.', 'tradeup-extensions' ),
			'.sec-portfolio .section-description', true, 'tradeup_ext_sanitize_content_filtered' );
		/*=====*/

		// Number of posts
		tradeup_controller_txt(
			'portfolio_section_nr_posts',
			'tradeup_section__portfolio',
			esc_html__( 'Number of posts', 'tradeup-extensions' ),
			esc_html__( 'How many items should we display. Integers only.', 'tradeup-extensions' ),
			3,
			'', false, false, 'absint' );
		/*=====*/

		// Show action button
		tu_ext_controller_simple( array(
			'type' => 'checkbox',
			'setting_id' => 'portfolio_action_btn_show',
			'section_id' => 'tradeup_section__portfolio',
			'label' => esc_html__( 'Show "More Projects" button?', 'tradeup-extensions' ),
			'default' => false,
			'transport' => false,
		) );

		// Action button
		tu_ext_controller_simple( array(
			'setting_id' => 'portfolio_action_btn',
			'section_id' => 'tradeup_section__portfolio',
			'label' => esc_html__( 'More Projects label:', 'tradeup-extensions' ),
			'default' => esc_html__( 'View More', 'tradeup-extensions' ),
			'sanitize' => 'sanitize_text_field',
			'selector' => '.portfolio-action-btn',
			'escape'   => 'esc_html',
		) );

		// Action button url
		tu_ext_controller_simple( array(
			'setting_id' => 'portfolio_action_btn_url',
			'section_id' => 'tradeup_section__portfolio',
			'label' => esc_html__( 'More projects URL:', 'tradeup-extensions' ),
			'default' => '#',
			'sanitize' => 'esc_url_raw',
			'postmsg' => true,
		) );
		/*=====*/

		// Section tabs
		$wp_customize->add_setting( 'portfolio-sectiontabs', array() );

		$wp_customize->add_control( new TUEXT_Control_Tabs( $wp_customize, 'portfolio-sectiontabs', array(
			'section'          => 'tradeup_section__portfolio',
			'type'             => 'section-tabs',
			'title_colors'     => __( 'Colors', 'tradeup-extensions' ),
			'title_background' => __( 'Background', 'tradeup-extensions' )
		) ) );

		// Section colors
		tradeup_controller_color_picker(
			'portfolio_color_background',
			'tradeup_section__portfolio',
			esc_html__( 'Section background color:', 'tradeup-extensions' ),
			esc_html__( 'In case you do not have a background image', 'tradeup-extensions' ),
			'#ffffff' );
		/*=====*/

		tradeup_controller_color_picker(
			'portfolio_color_heading_link',
			'tradeup_section__portfolio',
			esc_html__( 'Headings color:', 'tradeup-extensions' ),
			'', '#000' );
		/*=====*/

		tradeup_controller_color_picker(
			'portfolio_color_heading_border',
			'tradeup_section__portfolio',
			esc_html__( 'Separator color:', 'tradeup-extensions' ),
			'', '#e91e63' );
		/*=====*/

		tradeup_controller_rgba_picker(
			'portfolio_color_thumb_hover',
			'tradeup_section__portfolio',
			esc_html__( 'Thumbnail Hover Color:', 'tradeup-extensions' ),
			'', 'rgba(37,146,202,0.8)', true, false );
		/*=====*/

		tradeup_controller_color_picker(
			'portfolio_color_thumb_color',
			'tradeup_section__portfolio',
			esc_html__( 'Thumbnail Heading color:', 'tradeup-extensions' ),
			'', '#ffffff' );
		/*=====*/

		// Background image
		tradeup_controller_bg_image( 'portfolio_bg_image', 'tradeup_section__portfolio', esc_html__( 'Background Image:', 'tradeup-extensions' ), '', esc_html__( 'Use a HD image, suggested size: 1920x1080px', 'tradeup-extensions' ) );
		/*=====*/

		// Background overlay
		tradeup_controller_bg_overlay( 'portfolio_bg_overlay', 'tradeup_section__portfolio', esc_html__( 'Show Background Overlay', 'tradeup-extensions' ) );
		/*=====*/

		// Backgroud parallax
		tradeup_controller_bg_parallax( 'portfolio_bg_parallax', 'tradeup_section__portfolio', esc_html__( 'Enable Parallax Effect', 'tradeup-extensions' ) );
		tradeup_controller_simple_image(
			'portfolio_bg_parallax_img',
			'tradeup_section__portfolio',
			esc_html__( 'Parallax Background Image', 'tradeup-extensions' ),
			esc_html__( 'Use a HD image, suggested size: 1920x1080px', 'tradeup-extensions' ), '', false
		);
		/*=====*/
