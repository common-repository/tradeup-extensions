<?php
/* ------------------------------------------------------------------------- *
 *  Enqueues scripts for Administration area
/* ------------------------------------------------------------------------- */
if ( ! function_exists( 'tradeup_extensions_admin_scripts' ) ) {
	function tradeup_extensions_admin_scripts() {
		global $tradeup_icons_simple, $tradeup_sections, $wp_customize;
		$current_screen    = get_current_screen();
		$sections_position = get_theme_mod( 'tradeup_sections_position' );
		$suffix            = tu_ext_get_min_suffix();

		if( $current_screen->id === "widgets" || isset( $wp_customize ) ) : // Show only on the Widgets page and Customizer

			// CSS Styles
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_style( 'tradeup-extensions-widgets-customizer', TRADEUP_EXTS_URL . 'tradeup/css/widgets-customizer' . $suffix . '.css', array(), '20160412', 'all' );
			wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/icons/css/font-awesome.min.css', array(), NULL, 'all' );

			// JS Scripts
			wp_enqueue_media();
			wp_enqueue_script(
				'tradeup-extensions-widgets-customizer',
				TRADEUP_EXTS_URL . 'tradeup/js/admin/widgets-customizer' . $suffix . '.js',
				array( 'jquery', 'underscore', 'backbone', 'jquery-ui-sortable', 'jquery-ui-autocomplete', 'wp-color-picker' ),
				'20160412', FALSE
			);

			$data = apply_filters( 'tradeup_extensions___widgets_customizer', array(
				/* A list of all the icons for autocomplete */
				'icons'              => (array) $tradeup_icons_simple,
				/* Admin */
				'admin_url'          => esc_url( admin_url() ),
				/* Sections array */
				'sections'           => (array) $tradeup_sections,
				'sections_position'  => (array) $sections_position,
				/* Messages */
				'msgs'               => (object) array(
					'bk_bubble'          => esc_html__( 'Click on this button if you want to backup the position of your current widgets, including sections items (available for this theme).', 'tradeup-extensions' ),
					'bk_fail'            => esc_html__( 'You need to save your settings before you backup!', 'tradeup-extensions' ),
					'bk_success'         => esc_html__( 'Widgets and sections items positions backed up!', 'tradeup-extensions' ),
					'bk_restore_success' => esc_html__( 'Backup restored! Refreshing the page now...', 'tradeup-extensions' ),
					'wrong_page'         => esc_html__( 'The current page does not contain this section. We will go back now!', 'tradeup-extensions' ),
				),
				'add_widget'         => array(
					// Features
					'features'     => esc_html__( 'Add a Feature', 'tradeup-extensions' ),
					'actions'      => esc_html__( 'Add an Action', 'tradeup-extensions' ),
					'about'        => esc_html__( 'Add a Service Box', 'tradeup-extensions' ),
					'testimonials' => esc_html__( 'Add a Testimonial', 'tradeup-extensions' ),
					'team'         => esc_html__( 'Add a Member', 'tradeup-extensions' ),
					'slider'       => esc_html__( 'Add a Slide', 'tradeup-extensions' ),
				),
			) );

			// Add some data
			wp_localize_script(
				'tradeup-extensions-widgets-customizer',
				'bxext_widgets_customizer',
				$data
			);

		endif;

	}
}
add_action( 'admin_enqueue_scripts', 'tradeup_extensions_admin_scripts' );



/**
 * Enqueue scripts & styles for the theme
 */
if( ! function_exists( 'tradeup_extensions_theme_styles') ) {
	function tradeup_extensions_theme_styles() {
		$suffix = tu_ext_get_min_suffix();

		/* New sections styles */
		wp_enqueue_style( 'tu-ext-sections-styles', TRADEUP_EXTS_URL . 'tradeup/css/sections' . $suffix . '.css', array(), '20170122', 'all' );

		/* New sections JS */
		wp_enqueue_script( 'tu-ext-sections-scripts', TRADEUP_EXTS_URL . 'tradeup/js/front/sections' . $suffix . '.js', array( 'jquery' ), '20170125', true );
	}
}
add_action( 'wp_enqueue_scripts', 'tradeup_extensions_theme_styles', 9 );
