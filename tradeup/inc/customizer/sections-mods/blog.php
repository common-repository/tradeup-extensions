<?php
/* ------------------------------------------------------------------------- *
 *  ______
 *
 *  Blog
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
	$wp_customize->add_section( new TUEXT_Section_FrontPage( $wp_customize, 'tradeup_section__blog', array(
		'title'				=> esc_html__( 'Blog Section', 'tradeup-extensions' ),
		'panel'				=> 'tradeup_panel__sections',
		'priority'			=> absint( tradeup_extensions_sec_prio( 'tradeup_section__blog' ) ),
	) ) );



		/*  Blog Section options
		/* ------------------------------------ */

		// Hide section
		tradeup_controller_checkbox(
			'blog_section_hide',
			'tradeup_section__blog',
			esc_html__( 'Hide this section', 'tradeup-extensions' ) );
		/*=====*/

		// Section title
		tradeup_controller_txt(
			'blog_section_title',
			'tradeup_section__blog',
			esc_html__( 'Section title', 'tradeup-extensions' ),
			esc_html__( 'Set a title for this section.', 'tradeup-extensions' ),
			esc_html__( 'Our Latest Posts', 'tradeup-extensions' ),
			'.sec-blog .section-title' );
		/*=====*/

		// Section description
		tradeup_controller_txt_area(
			'blog_section_description',
			'tradeup_section__blog',
			esc_html__( 'Section description', 'tradeup-extensions' ),
			esc_html__( 'Set a description for this section.', 'tradeup-extensions' ),
			esc_html__( 'This is description field for the Blog section. You can find Blog settings at Customizer > Homepage Sections > Blog Section', 'tradeup-extensions' ),
			'.sec-blog .section-description', true, 'tradeup_ext_sanitize_content_filtered' );
		/*=====*/

		// Number of posts
		tradeup_controller_txt(
			'blog_section_nr_posts',
			'tradeup_section__blog',
			esc_html__( 'Number of posts', 'tradeup-extensions' ),
			esc_html__( 'How many posts do you want to display?.', 'tradeup-extensions' ),
			3, '', false, false, 'absint' );
		/*=====*/

		// Show action button
		tu_ext_controller_simple( array(
			'type' => 'checkbox',
			'setting_id' => 'blog_action_btn_show',
			'section_id' => 'tradeup_section__blog',
			'label' => esc_html__( 'Show "More Blogs" button?', 'tradeup-extensions' ),
			'default' => false,
			'transport' => false,
		) );

		// Action button
		tu_ext_controller_simple( array(
			'setting_id' => 'blog_action_btn',
			'section_id' => 'tradeup_section__blog',
			'label' => esc_html__( 'More articles label:', 'tradeup-extensions' ),
			'default' => esc_html__( 'View More Blogs', 'tradeup-extensions' ),
			'sanitize' => 'sanitize_text_field',
			'selector' => '.blog-action-btn',
			'escape'   => 'esc_html',
		) );

		// Action button url
		tu_ext_controller_simple( array(
			'setting_id' => 'blog_action_btn_url',
			'section_id' => 'tradeup_section__blog',
			'label' => esc_html__( 'More articles URL:', 'tradeup-extensions' ),
			'default' => '#',
			'sanitize' => 'esc_url_raw',
			'postmsg' => true,
		) );

		// Section tabs
		$wp_customize->add_setting( 'blog-sectiontabs', array() );

		$wp_customize->add_control( new TUEXT_Control_Tabs( $wp_customize, 'blog-sectiontabs', array(
			'section'          => 'tradeup_section__blog',
			'type'             => 'section-tabs',
			'title_colors'     => __( 'Colors', 'tradeup-extensions' ),
			'title_background' => __( 'Background', 'tradeup-extensions' )
		) ) );

		// Section colors
		tradeup_controller_color_picker(
			'blog_color_background',
			'tradeup_section__blog',
			esc_html__( 'Section background color:', 'tradeup-extensions' ),
			esc_html__( 'In case you do not have a background image', 'tradeup-extensions' ),
			'#ffffff' );
		/*=====*/

		tradeup_controller_color_picker(
			'blog_color_heading_border',
			'tradeup_section__blog',
			esc_html__( 'Separator color:', 'tradeup-extensions' ),
			'', '#e91e63' );
		/*=====*/

		tradeup_controller_color_picker(
			'blog_color_heading_link',
			'tradeup_section__blog',
			esc_html__( 'Headings and links colors:', 'tradeup-extensions' ),
			'', '#232323' );
		/*=====*/

		tradeup_controller_color_picker(
			'blog_color_text',
			'tradeup_section__blog',
			esc_html__( 'Title color:', 'tradeup-extensions' ),
			'', '#000' );
		/*=====*/

		tradeup_controller_color_picker(
			'blog_color_hover',
			'tradeup_section__blog',
			esc_html__( 'Text color:', 'tradeup-extensions' ),
			'',
			'#232323' );
		/*=====*/

		tradeup_controller_color_picker(
			'blog_color_rm_border',
			'tradeup_section__blog',
			esc_html__( '"View More" Button color:', 'tradeup-extensions' ),
			'',
			'#fff' );
		/*=====*/

		tradeup_controller_color_picker(
			'blog_color_rm_border_hover',
			'tradeup_section__blog',
			esc_html__( '"View More" Button Background color:', 'tradeup-extensions' ),
			'',
			'#e91e63' );
		/*=====*/

		// Background image
		tradeup_controller_bg_image( 'blog_bg_image', 'tradeup_section__blog', esc_html__( 'Background Image:', 'tradeup-extensions' ), '', esc_html__( 'Use a HD image, suggested size: 1920x1080px', 'tradeup-extensions' ) );
		/*=====*/

		// Background overlay
		tradeup_controller_bg_overlay( 'blog_bg_overlay', 'tradeup_section__blog', esc_html__( 'Show Background Overlay', 'tradeup-extensions' ) );
		/*=====*/

		// Backgroud parallax
		tradeup_controller_bg_parallax( 'blog_bg_parallax', 'tradeup_section__blog', esc_html__( 'Enable Parallax Effect', 'tradeup-extensions' ) );
		tradeup_controller_simple_image(
			'blog_bg_parallax_img',
			'tradeup_section__blog',
			esc_html__( 'Parallax Background Image', 'tradeup-extensions' ),
			esc_html__( 'Use a HD image, suggested size: 1920x1080px. It is not recommended you use this option if you display more than 4 posts.', 'tradeup-extensions' ), '', false
		);
		/*=====*/
