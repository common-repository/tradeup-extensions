<?php
/* ------------------------------------------------------------------------- *
 *
 *  Theme mods
 *  ________________
 *
 *	This file registers theme mods and adds some functions for
 *	the Customizer
 *	________________
 *
/* ------------------------------------------------------------------------- */


/*  Register Customizer options
/* ------------------------------------ */
if( ! function_exists( 'tradeup_extensions_customize_register' ) ) {
	function tradeup_extensions_customize_register( $wp_customize ) {
		$sections = tradeup_extensions_sections();

		// Register custom sections/controls
		require_once( TRADEUP_EXTS_PATH . '/tradeup/inc/customizer/custom/section-dragdrop/drag-and-drop-info.php' );
		$wp_customize->register_section_type( 'TUEXT_Section_DragAndDrop' );


		require_once( TRADEUP_EXTS_PATH . '/tradeup/inc/customizer/custom/section-frontpage/front-page-section.php' );
		$wp_customize->register_section_type( 'TUEXT_Section_FrontPage' );

		require_once( TRADEUP_EXTS_PATH . '/tradeup/inc/customizer/custom/control-addedititems/add-edit-items.php' );
		$wp_customize->register_control_type( 'TUEXT_Control_AddEditItems' );

		require_once( TRADEUP_EXTS_PATH . '/tradeup/inc/customizer/custom/control-tabs/tabs.php' );
		$wp_customize->register_control_type( 'TUEXT_Control_Tabs' );
		
		
		/*  Add panels
		/* ------------------------------------ */
		// Front page
		$wp_customize->add_panel( 'tradeup_panel__sections', array(
		  'title' 				=> __( 'Homepage Sections', 'tradeup-extensions' ),
		  'priority'			=> 35,
		  'active_callback' 	=> 'tradeup_front_pt',
		));
		$wp_customize->add_panel( 'tradeup_panel__sections_items', array(
		  'title' 				=> __( 'Sections Items', 'tradeup-extensions' ),
		  'priority'			=> 36,
		  'active_callback' 	=> 'tradeup_front_pt',
		));

			// Sections position control
			$wp_customize->add_setting( 'tradeup_sections_position', array(
				'default'           => '',
				'sanitize_callback' => 'tradeup_ext_sanitize_sections_position'
			) );

			$wp_customize->add_control( 'tradeup_sections_position', array(
				'section'  => 'title_tagline',
				'settings' => 'tradeup_sections_position',
				'type'     => 'text'
			) );

			// Move section sidebars to another panel
			foreach ( $wp_customize->sections() as $id => $section ) {
				$sections_items = tradeup_extensions_sections_items();
				foreach( $sections_items as $section_name ) {
					$needle = 'sidebar-widgets-section-' . $section_name;
					if( $needle === $id ) {
						$section->panel = 'tradeup_panel__sections_items';
					}
				}
			}

			/*  Add sections
			/* ------------------------------------ */
			/// Drag & Drop msg
			$wp_customize->add_section( new TUEXT_Section_DragAndDrop( $wp_customize, 'dragdrop', array(
				'title'     => esc_html__( 'Drag and drop for position', 'tradeup-extensions' ),
				'panel'     => 'tradeup_panel__sections',
				'priority'  => 0
			) ) );


			/// Theme Sections
			if( ! empty( $sections ) ) {
				foreach( $sections as $index => $section ) {
					require_once ( TRADEUP_EXTS_PATH . '/tradeup/inc/customizer/sections-mods/' . $section . '.php' );
				}
			}


			/// Extensions Settings
			$wp_customize->add_section( 'extensions_options', array(
				'title'				=> __( 'Extensions', 'tradeup-extensions' ),
				'panel'				=> 'settings_options'
			) );

				////// Settings
				tradeup_controller_info(
					'disable_helpers_info',
					'extensions_options',
					__( 'Disable helpers/placeholders', 'tradeup-extensions' ),
					__( 'Check the box bellow if you want to disable the helping/placeholder messages for all the sections.', 'tradeup-extensions' ), '' );

				tradeup_controller_checkbox(
					'disable_helpers',
					'extensions_options',
					esc_html__( 'Disable helping messages', 'tradeup-extensions' ), '', false );

				/*if( tuext_compt_polylang_check() ) {
					
					tradeup_controller_info(
						'use_polylang_info',
						'extensions_options',
						__( 'Enable Polylang translations', 'tradeup-extensions' ),
						__( '<p>If you enable this, you will need to add all your text/copy from <code>Languages > Strings translations</code></p><p>This will work for sections titles, descriptions and some buttons. Any changes made to these lines from the <strong>Homepage Sections</strong> panel will not work if this option is enabled</p>', 'tradeup-extensions' ), '' );

					tradeup_controller_checkbox(
						'use_polylang',
						'extensions_options',
						esc_html__( 'Use Polylang translations', 'tradeup-extensions' ), '', false );
				}*/ // END tuext_compt_polylang_check()


		$wp_customize->remove_section( 'themes' );

	}
}
add_action( 'customize_register', 'tradeup_extensions_customize_register', 12 );




/*  Backup widgets
/* ------------------------------------ */
if( ! function_exists( 'tradeup_extensions_sections_bk_action' ) ) {
	function tradeup_extensions_sections_bk_action() {

		// Check nonce
		if( ! isset( $_POST[ 'n_sections_bk' ] ) || ! wp_verify_nonce( $_POST[ 'n_sections_bk' ], 'n_sections_bk' ) )
			die( esc_html__( 'Permission denied', 'tradeup-extensions' ) );

		$current_widgets = get_option( 'sidebars_widgets' );

		if( current_user_can( 'edit_theme_options' ) && ! empty( $current_widgets ) ) {
			//if( isset( $current_widgets[ 'wp_inactive_widgets' ] ) ) unset( $current_widgets[ 'wp_inactive_widgets' ] );
			$current_widgets[ 'wp_inactive_widgets' ] = array();
			update_option( 'tradeup_ext_widgets_bk', $current_widgets ); }

		die();
	}
}
add_action( 'wp_ajax_tradeup_extensions_sections_bk', 'tradeup_extensions_sections_bk_action' );
add_action( 'wp_ajax_nopriv_tradeup_extensions_sections_bk', 'tradeup_extensions_sections_bk_action' );



/*  Restore widgets
/* ------------------------------------ */
if( ! function_exists( 'tradeup_extensions_sections_rt_action' ) ) {
	function tradeup_extensions_sections_rt_action() {

		// Check nonce
		if( ! isset( $_POST[ 'n_sections_rt' ] ) || ! wp_verify_nonce( $_POST[ 'n_sections_rt' ], 'n_sections_rt' ) )
			die( esc_html__( 'Permission denied', 'tradeup-extensions' ) );

		$backup = get_option( 'tradeup_ext_widgets_bk' );

		if( current_user_can( 'edit_theme_options' ) && ! empty( $backup ) ) {
			update_option( 'sidebars_widgets', $backup ); }

		die();
	}
}
add_action( 'wp_ajax_tradeup_extensions_sections_rt', 'tradeup_extensions_sections_rt_action' );
add_action( 'wp_ajax_nopriv_tradeup_extensions_sections_rt', 'tradeup_extensions_sections_rt_action' );



/*  Get/set section priority
/* ------------------------------------ */
if( ! function_exists( 'tradeup_extensions_sec_prio' ) ) {
	function tradeup_extensions_sec_prio( $section_name ) {
		$sections = get_theme_mod( 'tradeup_sections_position' );

		if( $sections === false ) return;
		
		if( ! is_array( $sections ) ) {
			$sections = json_decode( $sections );
		}

		if( ! empty( $sections ) ) {
			foreach( $sections as $priority => $section ) {
				if( $section == $section_name ) {
					return $priority + 1;
				}
			}
		}
	}
}



/*  Customizer CSS mods
/* ------------------------------------ */
global $tradeup_extensions_cs_mods;

$tradeup_extensions_cs_mods = apply_filters( 'tradeup_extensions_cs_mods___filter', array(

	/* Features Section */
	'features_color_heading_link' => '#ffffff',
	'features_color_background' => '#282e3f',
	'features_color_heading_border' => '#e91e63',
	'features_color_text' => '#a7a6a6',
	'features_color_hover' => '#ffffff',
	'features_bg_image' => '',
	'features_bg_image_size' => 'cover',
	'features_bg_image_repeat' => 'no-repeat',
	'features_bg_image_position' => 'center center',
	'features_bg_overlay_color' => '#000000',
	'features_bg_overlay_opacity' => '0.5',

	/* About Us Section */
	'about_color_heading_link' => '#000',
	'about_color_background' => '#fff',
	'about_color_heading_border' => '#e91e63',
	'about_color_text' => '#666666',
	'about_color_btn' => '#e91e63',
	'about_color_btn_2nd' => '#e91e63',
	'about_bg_image' => '',
	'about_bg_image_size' => 'cover',
	'about_bg_image_repeat' => 'no-repeat',
	'about_bg_image_position' => 'center center',
	'about_bg_overlay_color' => '#000000',
	'about_bg_overlay_opacity' => '0.5',

	/* Testimonials Section */
	'testimonials_color_background' => '#fff',
	'testimonials_color_headings' => '#000',
	'testimonials_color_heading_border' => '#e91e63',
	'testimonials_color_text' => '#000',
	'testimonials_color_item_bg' => 'rgba(40,40,40,1)',
	'testimonials_color_avatar_bg' => '#666666',
	'testimonials_color_button_bg' => '#e91e63',
	'testimonials_color_button_bg_hover' => '#aa7bff',
	'testimonials_color_button_bg_active' => '#6c32d4',
	'testimonials_color_nav_bg' => '#e91e63',
	'testimonials_color_nav_border' => '#e91e63',
	'testimonials_color_nav_btns' => '#ffffff',
	'testimonials_bg_image' => '',
	'testimonials_bg_image_size' => 'cover',
	'testimonials_bg_image_repeat' => 'no-repeat',
	'testimonials_bg_image_position' => 'center center',
	'testimonials_bg_overlay_color' => '#000000',
	'testimonials_bg_overlay_opacity' => '0.5',

	/* Team Section */
	'team_color_background' => '#ffffff',
	'team_color_heading_link' => '#000',
	'team_color_heading_border' => '#e91e63',
	'team_color_text' => '#000',
	'team_color_hover' => '#e91e63',
	'team_color_avatar_bg' => '#666666',
	'team_bg_image' => '',
	'team_bg_image_size' => 'cover',
	'team_bg_image_repeat' => 'no-repeat',
	'team_bg_image_position' => 'center center',
	'team_bg_overlay_color' => '#000000',
	'team_bg_overlay_opacity' => '0.5',

	/* Portfolio Section */
	'portfolio_color_background' => '#ffffff',
	'portfolio_color_heading_link' => '#000',
	'portfolio_color_heading_border' => '#e91e63',
	'portfolio_color_text' => '#636363',
	'portfolio_color_hover' => '#232323',
	'portfolio_color_thumb_hover' => 'rgba(37,146,202,0.8)',
	'portfolio_color_thumb_background' => '#e3e3e3',
	'portfolio_color_thumb_color' => '#ffffff',
	'portfolio_bg_image' => '',
	'portfolio_bg_image_size' => 'cover',
	'portfolio_bg_image_repeat' => 'no-repeat',
	'portfolio_bg_image_position' => 'center center',
	'portfolio_bg_overlay_color' => '#000000',
	'portfolio_bg_overlay_opacity' => '0.5',


	/* Blog Section */
	'blog_color_background' => '#ffffff',
	'blog_color_heading_link' => '#232323',
	'blog_color_heading_border' => '#e91e63',
	'blog_color_text' => '#000',
	'blog_color_hover' => '#232323',
	'blog_color_rm_border' => '#fff',
	'blog_color_rm_border_hover' => '#e91e63',
	'blog_bg_image' => '',
	'blog_bg_image_size' => 'cover',
	'blog_bg_image_repeat' => 'no-repeat',
	'blog_bg_image_position' => 'center center',
	'blog_bg_overlay_color' => '#000000',
	'blog_bg_overlay_opacity' => '0.5',

	/* Slider Section */
	'slider_background_color' => '#232323',
	'slider_arrows_bg' => 'rgba(255,255,255,0.1)',
	'slider_arrows_bg_hover' => 'rgba(255,255,255,0.2)',
	'slider_arrows_color' => '#ffffff',
	'slider_dots_bg' => 'rgba(255,255,255,0.2)',
	'slider_dots_bg_hover' => 'rgba(255,255,255,0.4)',
	'slider_dots_active' => '#ffffff',

) );



/*  Output CSS for JS templating
/* ------------------------------------ */
if( ! function_exists( 'tradeup_extensions_czr_output_css' ) ) {
	function tradeup_extensions_czr_output_css( $settings ) {
		global $tradeup_extensions_cs_mods;
		$new_settings = array();

		foreach( $tradeup_extensions_cs_mods as $bcs ) {
			$new_settings[ $bcs ] = '';
		}

		$settings = wp_parse_args( $settings, $new_settings );

		/* Variables */

		return <<<CSS
		/* Features Section */
		.sec-features {
			color: {$settings['features_color_text']};
			background-image: url( {$settings['features_bg_image']} );
			background-size: {$settings['features_bg_image_size']};
			background-repeat: {$settings['features_bg_image_repeat']};
			background-position: {$settings['features_bg_image_position']};
		}
		.sec-features .grid-overlay {
			background-color: {$settings['features_bg_overlay_color']};
			opacity: {$settings['features_bg_overlay_opacity']};
		}
		.sec-features .section-title, .sec-features h3, .sec-features a, .sec-feature .ac-btn-alt, .sec-feature .ac-btn-alt:hover, .sec-feature .ac-btn-alt:focus, .sec-feature .ac-btn-alt:active {
			color: {$settings['features_color_heading_link']};
		}
		.sec-features .section-title  {
			border-color: {$settings['features_color_heading_border']};
		}
		.sec-features {
			background-color: {$settings['features_color_background']};
		}
		.sec-features a:hover { color: {$settings['features_color_hover']}; }
		.sec-features a.ac-btn-alt:hover:after { border-color: {$settings['features_color_hover']}; }

		/* About Us Section */
		.sec-about {
			background-image: url( {$settings['about_bg_image']} );
			background-color: {$settings['about_color_background']};
			background-size: {$settings['about_bg_image_size']};
			background-repeat: {$settings['about_bg_image_repeat']};
			background-position: {$settings['about_bg_image_position']};
			color: {$settings['about_color_text']};
		}
		.sec-about .grid-overlay {
			background-color: {$settings['about_bg_overlay_color']};
			opacity: {$settings['about_bg_overlay_opacity']};
		}
		.sec-about .section-title, .sec-about-box h3, .sec-about-box a, .sec-about-box a:hover, .sec-about-box a:focus, .sec-about-box a:active {
			color: {$settings['about_color_heading_link']};
		}
		.sec-about .section-title, .sec-about-box:after {
			border-color: {$settings['about_color_heading_border']};
		}
		.sec-about .about-button .ac-btn.btn-opaque {
			box-shadow: inset 0 0 0 3px {$settings['about_color_btn_2nd']};
			background-color: {$settings['about_color_btn']};
		}
		.sec-about .about-button .ac-btn.btn-opaque:hover {
			background-color: {$settings['about_color_btn_2nd']};
		}

		/* Testimonials Section */
		.sec-testimonials {
			background-image: url( {$settings['testimonials_bg_image']} );
			background-color: {$settings['testimonials_color_background']};
			background-size: {$settings['testimonials_bg_image_size']};
			background-repeat: {$settings['testimonials_bg_image_repeat']};
			background-position: {$settings['testimonials_bg_image_position']};
			color: {$settings['testimonials_color_text']};
		}
		.sec-testimonials .grid-overlay {
			background-color: {$settings['testimonials_bg_overlay_color']};
			opacity: {$settings['testimonials_bg_overlay_opacity']};
		}
		.sec-testimonials .section-title {
			border-color: {$settings['testimonials_color_heading_border']};
		}
		.sec-testimonials .section-title, .sec-testimonials h3 {
			color: {$settings['testimonials_color_headings']};
		}
		.sec-testimonials .owl-item {
			background: radial-gradient(2.222em 2.222em at 50% -0.556em, rgba(0, 0, 0, 0) 2.194em, {$settings['testimonials_color_item_bg']} 2.250em);
		}
		.sec-testimonials .client-avatar { background-color: {$settings['testimonials_color_avatar_bg']}; }
		.sec-testimonials .testimonial-button .ac-btn { background-color: {$settings['testimonials_color_button_bg']}; }
		.sec-testimonials .testimonial-button .ac-btn:hover { background-color: {$settings['testimonials_color_button_bg_hover']}; }
		.sec-testimonials .testimonial-button .ac-btn:active { background-color: {$settings['testimonials_color_button_bg_active']}; }
		.sec-testimonials-nav-btns .sec-testimonials-nav-btn-prev {
			background-color: {$settings['testimonials_color_nav_bg']};
			border-color: {$settings['testimonials_color_nav_border']};
		}
		.sec-testimonials-nav-btn-prev, .sec-testimonials-nav-btn-next,
		.sec-testimonials-nav-btn-prev:hover, .sec-testimonials-nav-btn-next:hover,
		.sec-testimonials-nav-btn-prev:focus, .sec-testimonials-nav-btn-next:focus,
		.sec-testimonials-nav-btn-prev:active, .sec-testimonials-nav-btn-next:active { color: {$settings['testimonials_color_nav_btns']}; }

		/* Team Section */
		.sec-team {
			background-image: url( {$settings['team_bg_image']} );
			background-color: {$settings['team_color_background']};
			background-size: {$settings['team_bg_image_size']};
			background-repeat: {$settings['team_bg_image_repeat']};
			background-position: {$settings['team_bg_image_position']};
			color: {$settings['team_color_text']};
		}
		.sec-team .grid-overlay {
			background-color: {$settings['team_bg_overlay_color']};
			opacity: {$settings['team_bg_overlay_opacity']};
		}
		.sec-team .section-title, .sec-team-member h3, .sec-team-member h4, .sec-team a, .sec-team a:focus, .sec-team a:active {
			color: {$settings['team_color_heading_link']};
		}
		.sec-team .section-title, .sec-team-member h4.hb-bottom-abs-small:after {
			border-color: {$settings['team_color_heading_border']};
		}
		.sec-team a:hover {
			color: {$settings['team_color_hover']};
		}
		.sec-team .sec-team-member-avatar {
			background-color: {$settings['team_color_avatar_bg']};
		}

		/* Portfolio Section */
		.sec-portfolio {
			background-image: url( {$settings['portfolio_bg_image']} );
			background-color: {$settings['portfolio_color_background']};
			background-size: {$settings['portfolio_bg_image_size']};
			background-repeat: {$settings['portfolio_bg_image_repeat']};
			background-position: {$settings['portfolio_bg_image_position']};
			color: {$settings['portfolio_color_text']};
		}
		.sec-portfolio .grid-overlay {
			background-color: {$settings['portfolio_bg_overlay_color']};
			opacity: {$settings['portfolio_bg_overlay_opacity']};
		}
		.sec-portfolio .section-title, .sec-portfolio a:not(.ac-btn), .sec-portfolio a:not(.ac-btn):hover, .sec-portfolio a:not(.ac-btn):focus, .sec-portfolio a:not(.ac-btn):active {
			color: {$settings['portfolio_color_heading_link']};
		}
		.sec-portfolio .section-title {
			border-color: {$settings['portfolio_color_heading_border']};
		}
		.sec-portfolio a:not(.ac-btn):hover, .sec-portfolio a:not(.ac-btn):visited:hover {
			color: {$settings['portfolio_color_hover']};
		}
		.sec-portfolio-item figure figcaption {
			background-color: {$settings['portfolio_color_thumb_hover']};
		}
		.sec-portfolio-item {
			background-color: {$settings['portfolio_color_thumb_background']};
		}
		.sec-portfolio-item figure figcaption, .sec-portfolio-item .description a, .sec-portfolio-item .description a:hover, .sec-portfolio-item .description a:focus, .sec-portfolio-item .description a:active {
			color: {$settings['portfolio_color_thumb_color']};
		}

		
		/* Blog Section */
		.sec-blog {
			background-image: url( {$settings['blog_bg_image']} );
			background-color: {$settings['blog_color_background']};
			background-size: {$settings['blog_bg_image_size']};
			background-repeat: {$settings['blog_bg_image_repeat']};
			background-position: {$settings['blog_bg_image_position']};
			color: {$settings['blog_color_text']};
		}
		.sec-blog .grid-overlay {
			background-color: {$settings['blog_bg_overlay_color']};
			opacity: {$settings['blog_bg_overlay_opacity']};
		}
		.sec-blog .section-title, .sec-blog a, .sec-blog a:hover, .sec-blog a:focus, .sec-blog a:active, .sec-blog a.ac-btn-alt {
			color: {$settings['blog_color_heading_link']};
		}
		.sec-blog a:hover, .sec-blog a.ac-btn-alt:hover {
			color: {$settings['blog_color_hover']};
		}
		.sec-blog .section-title {
			border-color: {$settings['blog_color_heading_border']};
		}
		.sec-blog .ac-btn-alt {
			border-color: {$settings['blog_color_rm_border']};
		}
		.sec-blog .ac-btn-alt:hover:after {
			border-color: {$settings['blog_color_rm_border_hover']};
		}

		/* Slider Section */
		.sec-slider {
			background-color: {$settings['slider_background_color']};
		}
		.sec-slider .ss-prev, .sec-slider .ss-next {
			color: {$settings['slider_arrows_color']};
			background-color: {$settings['slider_arrows_bg']};
		}
		.sec-slider .ss-prev:hover, .sec-slider .ss-next:hover {
			color: {$settings['slider_arrows_color']};
			background-color: {$settings['slider_arrows_bg_hover']};
		}
		.sec-slider .owl-dot {
			background-color: {$settings['slider_dots_bg']};
		}
		.sec-slider .owl-dot:hover {
			background-color: {$settings['slider_dots_bg_hover']};
		}
		.sec-slider .owl-dot.active {
			border-color: {$settings['slider_dots_active']};
		}

CSS;
	}
}



/*  Output inline styles
/* ------------------------------------ */
if( ! function_exists( 'tradeup_extensions_final_inline_css' ) ) {
	function tradeup_extensions_final_inline_css() {
		global $tradeup_extensions_cs_mods;
		$css = '';

		foreach ( $tradeup_extensions_cs_mods as $bcs => $bcs_value ) {
			${"$bcs"} = $bcs_value;
		}

		/*
			tradeup_cd() checks if it's not a default value
			tradeup_gcs() generates CSS for output
			-------
			You can find both functions in the theme: ../tradeup-controls/customizer/customizer.php
		*/


			/* Features Section */
			if( tradeup_cd( 'features_color_text', $features_color_text ) ) {
			$css .= tradeup_gcs( '.sec-features .contents-wrap p', 'color', 'features_color_text' ); }

			if( tradeup_cd( 'features_bg_overlay_color', $features_bg_overlay_color ) ) {
			$css .= tradeup_gcs( '.sec-features .grid-overlay', 'background-color', 'features_bg_overlay_color' ); }

			if( tradeup_cd( 'features_bg_overlay_opacity', $features_bg_overlay_opacity ) ) {
			$css .= tradeup_gcs( '.sec-features .grid-overlay', 'opacity', 'features_bg_overlay_opacity' ); }

			if( tradeup_cd( 'features_color_heading_link', $features_color_heading_link ) ) {
			$css .= tradeup_gcs( '.sec-features .sm-title,.sec-features .contents-wrap h3, .sec-features a, .sec-feature .ac-btn-alt, .sec-feature .ac-btn-alt:hover, .sec-feature .ac-btn-alt:focus, .sec-feature .ac-btn-alt:active', 'color', 'features_color_heading_link' ); }

			if( tradeup_cd( 'features_color_heading_border', $features_color_heading_border ) ) {
			$css .= tradeup_gcs( '.sec-features .sm-title', 'border-color', 'features_color_heading_border' ); }

			if( tradeup_cd( 'features_color_background', $features_color_background ) ) {
			$css .= tradeup_gcs( '.sec-features', 'background-color', 'features_color_background' ); }

			if( tradeup_cd( 'features_color_hover', $features_color_hover ) ) {
			$css .= tradeup_gcs( '.sec-features .sm-title', 'background', 'features_color_hover' );
			//$css .= tradeup_gcs( '.sec-features a.ac-btn-alt:hover:after, .sec-feature a.ac-btn-alt:focus:after, .sec-feature a.ac-btn-alt:active:after', 'border-color', 'features_color_hover', '', ' !important' ); 
		}


			if( tradeup_cd( 'features_bg_image', $features_bg_image ) ) {
			$css .= tradeup_gcs( '.sec-features', 'background-image', 'features_bg_image', 'url(', ')' ); }

			if( tradeup_cd( 'features_bg_image_size', $features_bg_image_size ) ) {
			$css .= tradeup_gcs( '.sec-features', 'background-size', 'features_bg_image_size' ); }

			if( tradeup_cd( 'features_bg_image_repeat', $features_bg_image_repeat ) ) {
			$css .= tradeup_gcs( '.sec-features', 'background-repeat', 'features_bg_image_repeat' ); }

			if( tradeup_cd( 'features_bg_image_position', $features_bg_image_position ) ) {
			$css .= tradeup_gcs( '.sec-features', 'background-position', 'features_bg_image_position' ); }


			/* About Us Section */
			if( tradeup_cd( 'about_color_background', $about_color_background ) ) {
			$css .= tradeup_gcs( '.sec-about', 'background-color', 'about_color_background' ); }

			if( tradeup_cd( 'about_color_text', $about_color_text ) ) {
			$css .= tradeup_gcs( '.sec-about .grid-items p', 'color', 'about_color_text' ); }

			if( tradeup_cd( 'about_color_heading_link', $about_color_heading_link ) ) {
			$css .= tradeup_gcs( '.sec-about .sm-title, .sec-about-box h3, .sec-about-box a, .sec-about-box a:hover, .sec-about-box a:focus, .sec-about-box a:active', 'color', 'about_color_heading_link' ); }

			if( tradeup_cd( 'about_color_heading_border', $about_color_heading_border ) ) {
			$css .= tradeup_gcs( '.sec-about .sm-title, .sec-about-box:after', 'border-color', 'about_color_heading_border' ); 
			
			$css .= tradeup_gcs( '.sec-about .section-sep:before', 'background', 'about_color_heading_border' ); 
			
			$css .= tradeup_gcs( '.sec-about .section-sep:after', 'border-color', 'about_color_heading_border' ); 

			}

			if( tradeup_cd( 'about_color_btn', $about_color_btn ) ) {

			$css .= tradeup_gcs( '.sec-about .about-button .ac-btn.btn-opaque', 'background-color', 'about_color_btn' ); }

			if( tradeup_cd( 'about_color_btn_2nd', $about_color_btn_2nd ) ) {
			$css .= tradeup_gcs( '.sec-about .about-button .ac-btn.btn-opaque', 'box-shadow', 'about_color_btn_2nd', 'inset 0 0 0 3px ' );
			$css .= tradeup_gcs( '.sec-about .about-button .ac-btn.btn-opaque:hover', 'background-color', 'about_color_btn_2nd' ); }

			if( tradeup_cd( 'about_bg_image', $about_bg_image ) ) {
			$css .= tradeup_gcs( '.sec-about', 'background-image', 'about_bg_image', 'url(', ')' ); }

			if( tradeup_cd( 'about_bg_image_size', $about_bg_image_size ) ) {
			$css .= tradeup_gcs( '.sec-about', 'background-size', 'about_bg_image_size' ); }

			if( tradeup_cd( 'about_bg_image_repeat', $about_bg_image_repeat ) ) {
			$css .= tradeup_gcs( '.sec-about', 'background-repeat', 'about_bg_image_repeat' ); }

			if( tradeup_cd( 'about_bg_image_position', $about_bg_image_position ) ) {
			$css .= tradeup_gcs( '.sec-about', 'background-position', 'about_bg_image_position' ); }

			if( tradeup_cd( 'about_bg_overlay_color', $about_bg_overlay_color ) ) {
			$css .= tradeup_gcs( '.sec-about .grid-overlay', 'background-color', 'about_bg_overlay_color' ); }

			if( tradeup_cd( 'about_bg_overlay_opacity', $about_bg_overlay_opacity ) ) {
			$css .= tradeup_gcs( '.sec-about .grid-overlay', 'opacity', 'about_bg_overlay_opacity' ); }


			/* Testimonials Section */
			if( tradeup_cd( 'testimonials_color_background', $testimonials_color_background ) ) {
			$css .= tradeup_gcs( '.sec-testimonials', 'background-color', 'testimonials_color_background' ); }

			if( tradeup_cd( 'testimonials_bg_image', $testimonials_bg_image ) ) {
			$css .= tradeup_gcs( '.sec-testimonials', 'background-image', 'testimonials_bg_image', 'url(', ')' ); }

			if( tradeup_cd( 'testimonials_bg_image_size', $testimonials_bg_image_size ) ) {
			$css .= tradeup_gcs( '.sec-testimonials', 'background-size', 'testimonials_bg_image_size' ); }

			if( tradeup_cd( 'testimonials_bg_image_repeat', $testimonials_bg_image_repeat ) ) {
			$css .= tradeup_gcs( '.sec-testimonials', 'background-repeat', 'testimonials_bg_image_repeat' ); }

			if( tradeup_cd( 'testimonials_bg_image_position', $testimonials_bg_image_position ) ) {
			$css .= tradeup_gcs( '.sec-testimonials', 'background-position', 'testimonials_bg_image_position' ); }

			if( tradeup_cd( 'testimonials_bg_overlay_color', $testimonials_bg_overlay_color ) ) {
			$css .= tradeup_gcs( '.sec-testimonials .grid-overlay', 'background-color', 'testimonials_bg_overlay_color' ); }

			if( tradeup_cd( 'testimonials_bg_overlay_opacity', $testimonials_bg_overlay_opacity ) ) {
			$css .= tradeup_gcs( '.sec-testimonials .grid-overlay', 'opacity', 'testimonials_bg_overlay_opacity' ); }

			if( tradeup_cd( 'testimonials_color_text', $testimonials_color_text ) ) {
			$css .= tradeup_gcs( '.sec-testimonials .sm-title', 'color', 'testimonials_color_text' ); }

			if( tradeup_cd( 'testimonials_color_heading_border', $testimonials_color_heading_border ) ) {
			$css .= tradeup_gcs( '.client-avatar:after', 'background', 'testimonials_color_heading_border' ); }

			if( tradeup_cd( 'testimonials_color_headings', $testimonials_color_headings ) ) {
			$css .= tradeup_gcs( '.sec-testimonials .section-title, .sec-testimonials h3', 'color', 'testimonials_color_headings' ); }

			if( tradeup_cd( 'testimonials_color_avatar_bg', $testimonials_color_avatar_bg ) ) {
			$css .= tradeup_gcs( '.sec-testimonials .testimonial-excerpt', 'color', 'testimonials_color_avatar_bg' ); }

			if( tradeup_cd( 'testimonials_color_button_bg', $testimonials_color_button_bg ) ) {
			$css .= tradeup_gcs( '.sec-testimonials .testimonial-button .ac-btn', 'background-color', 'testimonials_color_button_bg' ); }

			if( tradeup_cd( 'testimonials_color_button_bg_hover', $testimonials_color_button_bg_hover ) ) {
			$css .= tradeup_gcs( '.sec-testimonials .testimonial-button .ac-btn:hover', 'background-color', 'testimonials_color_button_bg_hover' ); }

			if( tradeup_cd( 'testimonials_color_button_bg_active', $testimonials_color_button_bg_active ) ) {
			$css .= tradeup_gcs( '.sec-testimonials .testimonial-button .ac-btn:active', 'background-color', 'testimonials_color_button_bg_active' ); }

			if( tradeup_cd( 'testimonials_color_nav_bg', $testimonials_color_nav_bg ) ) {
			$css .= tradeup_gcs( '.sec-testimonials-nav-btns .sec-testimonials-nav-btn-prev i, .sec-testimonials-nav-btns .sec-testimonials-nav-btn-next i', 'background-color', 'testimonials_color_nav_bg' ); }

			if( tradeup_cd( 'testimonials_color_nav_border', $testimonials_color_nav_border ) ) {
			$css .= tradeup_gcs( '.sec-testimonials-nav-btns .sec-testimonials-nav-btn-prev i, .sec-testimonials-nav-btns .sec-testimonials-nav-btn-next i', 'border-color', 'testimonials_color_nav_border' ); }

			if( tradeup_cd( 'testimonials_color_nav_btns', $testimonials_color_nav_btns ) ) {
			$css .= tradeup_gcs(
				'.sec-testimonials-nav-btn-prev, .sec-testimonials-nav-btn-next,
				.sec-testimonials-nav-btn-prev:hover, .sec-testimonials-nav-btn-next:hover,
				.sec-testimonials-nav-btn-prev:focus, .sec-testimonials-nav-btn-next:focus,
				.sec-testimonials-nav-btn-prev:active, .sec-testimonials-nav-btn-next:active',
				'color', 'testimonials_color_nav_btns' ); }


			/* Team Section */
			if( tradeup_cd( 'team_color_background', $team_color_background ) ) {
			$css .= tradeup_gcs( '.sec-team', 'background-color', 'team_color_background' ); }

			if( tradeup_cd( 'team_bg_image', $team_bg_image ) ) {
			$css .= tradeup_gcs( '.sec-team', 'background-image', 'team_bg_image', 'url(', ')' ); }

			if( tradeup_cd( 'team_bg_image_size', $team_bg_image_size ) ) {
			$css .= tradeup_gcs( '.sec-team', 'background-size', 'team_bg_image_size' ); }

			if( tradeup_cd( 'team_bg_image_repeat', $team_bg_image_repeat ) ) {
			$css .= tradeup_gcs( '.sec-team', 'background-repeat', 'team_bg_image_repeat' ); }

			if( tradeup_cd( 'team_bg_image_position', $team_bg_image_position ) ) {
			$css .= tradeup_gcs( '.sec-team', 'background-position', 'team_bg_image_position' ); }

			if( tradeup_cd( 'team_bg_overlay_color', $team_bg_overlay_color ) ) {
			$css .= tradeup_gcs( '.sec-team .grid-overlay', 'background-color', 'team_bg_overlay_color' ); }

			if( tradeup_cd( 'team_bg_overlay_opacity', $team_bg_overlay_opacity ) ) {
			$css .= tradeup_gcs( '.sec-team .grid-overlay', 'opacity', 'team_bg_overlay_opacity' ); }

			if( tradeup_cd( 'team_color_text', $team_color_text ) ) {
			$css .= tradeup_gcs( '.sec-team .sec-team-member .profile-name', 'color', 'team_color_text' ); }

			if( tradeup_cd( 'team_color_heading_link', $team_color_heading_link ) ) {
			$css .= tradeup_gcs( '.sec-team .sm-title, .sec-team-member h3, .sec-team-member h4, .sec-team a, .sec-team a:focus, .sec-team a:active', 'color', 'team_color_heading_link' ); }

			if( tradeup_cd( 'team_color_heading_border', $team_color_heading_border ) ) {
			$css .= tradeup_gcs( '.sec-team .sm-title, .sec-team-member h4.hb-bottom-abs-small:after', 'border-color', 'team_color_heading_border' ); 
			 
			$css .= tradeup_gcs( '.sec-team .section-sep:before', 'background', 'team_color_heading_border' ); 
			
			$css .= tradeup_gcs( '.sec-team .section-sep:after', 'border-color', 'team_color_heading_border' );

			}

			if( tradeup_cd( 'team_color_hover', $team_color_hover ) ) {
			$css .= tradeup_gcs( '.sec-team .sec-team-member .designation', 'color', 'team_color_hover' ); }

			if( tradeup_cd( 'team_color_avatar_bg', $team_color_avatar_bg ) ) {
			$css .= tradeup_gcs( '.sec-team .sec-team-member-avatar', 'background-color', 'team_color_avatar_bg' ); }

			/* Portfolio Section */
			if( tradeup_cd( 'portfolio_color_background', $portfolio_color_background ) ) {
			$css .= tradeup_gcs( '.sec-portfolio', 'background-color', 'portfolio_color_background' ); }

			if( tradeup_cd( 'portfolio_bg_image', $portfolio_bg_image ) ) {
			$css .= tradeup_gcs( '.sec-portfolio', 'background-image', 'portfolio_bg_image', 'url(', ')' ); }

			if( tradeup_cd( 'portfolio_bg_image_size', $portfolio_bg_image_size ) ) {
			$css .= tradeup_gcs( '.sec-portfolio', 'background-size', 'portfolio_bg_image_size' ); }

			if( tradeup_cd( 'portfolio_bg_image_repeat', $portfolio_bg_image_repeat ) ) {
			$css .= tradeup_gcs( '.sec-portfolio', 'background-repeat', 'portfolio_bg_image_repeat' ); }

			if( tradeup_cd( 'portfolio_bg_image_position', $portfolio_bg_image_position ) ) {
			$css .= tradeup_gcs( '.sec-portfolio', 'background-position', 'portfolio_bg_image_position' ); }

			if( tradeup_cd( 'portfolio_bg_overlay_color', $portfolio_bg_overlay_color ) ) {
			$css .= tradeup_gcs( '.sec-portfolio .grid-overlay', 'background-color', 'portfolio_bg_overlay_color' ); }

			if( tradeup_cd( 'portfolio_bg_overlay_opacity', $portfolio_bg_overlay_opacity ) ) {
			$css .= tradeup_gcs( '.sec-portfolio .grid-overlay', 'opacity', 'portfolio_bg_overlay_opacity' ); }

			if( tradeup_cd( 'portfolio_color_text', $portfolio_color_text ) ) {
			$css .= tradeup_gcs( '.sec-portfolio', 'color', 'portfolio_color_text' ); }

			if( tradeup_cd( 'portfolio_color_heading_link', $portfolio_color_heading_link ) ) {
			$css .= tradeup_gcs( '.sec-portfolio .sm-title', 'color', 'portfolio_color_heading_link' ); }

			if( tradeup_cd( 'portfolio_color_heading_border', $portfolio_color_heading_border ) ) {
			$css .= tradeup_gcs( '.sec-portfolio .sm-title', 'border-color', 'portfolio_color_heading_border' ); 

			$css .= tradeup_gcs( '.sec-portfolio .section-sep:before', 'background', 'portfolio_color_heading_border' ); 
			
			$css .= tradeup_gcs( '.sec-portfolio .section-sep:after', 'border-color', 'portfolio_color_heading_border' );
			}

			if( tradeup_cd( 'portfolio_color_hover', $portfolio_color_hover ) ) {
			$css .= tradeup_gcs( '.sec-portfolio a:not(.ac-btn):hover, .sec-portfolio a:not(.ac-btn):visited:hover', 'color', 'portfolio_color_hover' ); }

			if( tradeup_cd( 'portfolio_color_thumb_hover', $portfolio_color_thumb_hover ) ) {
			$css .= tradeup_gcs( '.sec-portfolio-item figure figcaption', 'background-color', 'portfolio_color_thumb_hover' ); }

			if( tradeup_cd( 'portfolio_color_thumb_background', $portfolio_color_thumb_background ) ) {
			$css .= tradeup_gcs( '.sec-portfolio-item', 'background-color', 'portfolio_color_thumb_background' ); }

			if( tradeup_cd( 'portfolio_color_thumb_color', $portfolio_color_thumb_color ) ) {
			$css .= tradeup_gcs(
				'.sec-portfolio a:not(.ac-btn), .sec-portfolio a:not(.ac-btn):hover, .sec-portfolio a:not(.ac-btn):focus, .sec-portfolio a:not(.ac-btn):active, .sec-portfolio-item figure figcaption, .sec-portfolio-item .description a, .sec-portfolio-item .description a:hover, .sec-portfolio-item .description a:focus, .sec-portfolio-item .description a:active', 'color', 'portfolio_color_thumb_color' ); }


			
			/* Blog Section */
			if( tradeup_cd( 'blog_color_background', $blog_color_background ) ) {
			$css .= tradeup_gcs( '.sec-blog', 'background-color', 'blog_color_background' ); }

			if( tradeup_cd( 'blog_bg_image', $blog_bg_image ) ) {
			$css .= tradeup_gcs( '.sec-blog', 'background-image', 'blog_bg_image', 'url(', ')' ); }

			if( tradeup_cd( 'blog_bg_image_size', $blog_bg_image_size ) ) {
			$css .= tradeup_gcs( '.sec-blog', 'background-size', 'blog_bg_image_size' ); }

			if( tradeup_cd( 'blog_bg_image_repeat', $blog_bg_image_repeat ) ) {
			$css .= tradeup_gcs( '.sec-blog', 'background-repeat', 'blog_bg_image_repeat' ); }

			if( tradeup_cd( 'blog_bg_image_position', $blog_bg_image_position ) ) {
			$css .= tradeup_gcs( '.sec-blog', 'background-position', 'blog_bg_image_position' ); }

			if( tradeup_cd( 'blog_bg_overlay_color', $blog_bg_overlay_color ) ) {
			$css .= tradeup_gcs( '.sec-blog .grid-overlay', 'background-color', 'blog_bg_overlay_color' ); }

			if( tradeup_cd( 'blog_bg_overlay_opacity', $blog_bg_overlay_opacity ) ) {
			$css .= tradeup_gcs( '.sec-blog .grid-overlay', 'opacity', 'blog_bg_overlay_opacity' ); }

			if( tradeup_cd( 'blog_color_text', $blog_color_text ) ) {
			$css .= tradeup_gcs( '.sec-blog .sm-title', 'color', 'blog_color_text' ); }

			if( tradeup_cd( 'blog_color_heading_link', $blog_color_heading_link ) ) {
			$css .= tradeup_gcs( '.sec-blog .section-title, .sec-blog a, .sec-blog a:hover, .sec-blog a:focus, .sec-blog a:active, .sec-blog a.ac-btn-alt', 'color', 'blog_color_heading_link' ); }

			if( tradeup_cd( 'blog_color_hover', $blog_color_hover ) ) {
			$css .= tradeup_gcs( '.sec-blog .section-description', 'color', 'blog_color_hover' ); }

			if( tradeup_cd( 'blog_color_heading_border', $blog_color_heading_border ) ) {
			$css .= tradeup_gcs( '.sec-blog .section-title', 'border-color', 'blog_color_heading_border' ); 

			$css .= tradeup_gcs( '.sec-blog .section-sep:before', 'background', 'blog_color_heading_border' ); 
			
			$css .= tradeup_gcs( '.sec-blog .section-sep:after', 'border-color', 'blog_color_heading_border' );
			}

			if( tradeup_cd( 'blog_color_rm_border', $blog_color_rm_border ) ) {
			$css .= tradeup_gcs( '.sec-blog .blog-action-btn', 'color', 'blog_color_rm_border' ); }

			if( tradeup_cd( 'blog_color_rm_border_hover', $blog_color_rm_border_hover ) ) {
			$css .= tradeup_gcs( '.sec-blog .blog-action-btn', 'background', 'blog_color_rm_border_hover' ); }


			/* Slider Section */
			if( tradeup_cd( 'slider_background_color', $slider_background_color ) ) {
			$css .= tradeup_gcs( '.sec-slider', 'background-color', 'slider_background_color' ); }

			if( tradeup_cd( 'slider_arrows_color', $slider_arrows_color ) ) {
			$css .= tradeup_gcs( '.sec-slider .ss-prev, .sec-slider .ss-next', 'color', 'slider_arrows_color' ); }

			if( tradeup_cd( 'slider_arrows_bg', $slider_arrows_bg ) ) {
			$css .= tradeup_gcs( '.sec-slider .ss-prev, .sec-slider .ss-next', 'background-color', 'slider_arrows_bg' ); }

			if( tradeup_cd( 'slider_arrows_color', $slider_arrows_color ) ) {
			$css .= tradeup_gcs( '.sec-slider .ss-prev:hover, .sec-slider .ss-next:hover', 'color', 'slider_arrows_color' ); }

			if( tradeup_cd( 'slider_arrows_bg_hover', $slider_arrows_bg_hover ) ) {
			$css .= tradeup_gcs( '.sec-slider .ss-prev:hover, .sec-slider .ss-next:hover', 'background-color', 'slider_arrows_bg_hover' ); }

			if( tradeup_cd( 'slider_dots_bg', $slider_dots_bg ) ) {
			$css .= tradeup_gcs( '.sec-slider .owl-dot', 'background-color', 'slider_dots_bg' ); }

			if( tradeup_cd( 'slider_dots_bg_hover', $slider_dots_bg_hover ) ) {
			$css .= tradeup_gcs( '.sec-slider .owl-dot:hover', 'background-color', 'slider_dots_bg_hover' ); }

			if( tradeup_cd( 'slider_dots_active', $slider_dots_active ) ) {
			$css .= tradeup_gcs( '.sec-slider .owl-dot.active', 'border-color', 'slider_dots_active' ); }

		// Adds inline css
		wp_add_inline_style( 'tradeup-style', esc_html( $css ) );
	}
}
add_action( 'wp_enqueue_scripts', 'tradeup_extensions_final_inline_css', 12 );



/*  CSS JS template
/* ------------------------------------ */

if( ! function_exists( 'tradeup_extensions_czr_output_css_template' ) ) {
	function tradeup_extensions_czr_output_css_template() {
		global $tradeup_extensions_cs_mods;
		$new_settings = array();

		foreach( $tradeup_extensions_cs_mods as $bcs => $bcs_value ) {
			$new_settings[ $bcs ] = '{{ data.' . $bcs . ' }}';
		}

		?>
		<script type="text/html" id="tmpl-tradeup-ext-czr-settings-output">
			<?php echo tradeup_extensions_czr_output_css( $new_settings  ); ?>
		</script>
		<?php
	}
}
add_action( 'customize_controls_print_footer_scripts', 'tradeup_extensions_czr_output_css_template', 11 );
