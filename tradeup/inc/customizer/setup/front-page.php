<?php
/**
 * Check if "Tradeup Homepage" exists and if it's
 * set as a static front page
 * 
 * @since  1.0.0
 * @return boolean true or false
 */
if( ! function_exists( 'tuext_used_frontpage' ) ) {
	function tuext_used_frontpage() {
		$page_title = apply_filters( 'tradeup_extensions___frontpage_name', 'Tradeup Homepage' );
		$page = get_page_by_title( $page_title );
		$check = tuext_has_frontpage();

		if ( $check && get_option( 'page_on_front', -1 ) === $page->ID."" ) {
			return true;
		} else {
			return false;
		}
	}
}

/**
 * Checks if a Tradup Extensions front page is published
 * 
 * @since  1.4.0
 * @return boolean true or false
 */
if( ! function_exists( 'tuext_has_frontpage' ) ) {
	function tuext_has_frontpage() {
		$page_title = apply_filters( 'tradeup_extensions___frontpage_name', 'Tradeup Homepage' );
		$page = get_page_by_title( $page_title );

		if ( $page ) {
			if ( is_object( $page ) && property_exists( $page, 'post_status' ) && $page->post_status === 'publish' ) {
				return true;
			}
			return false;
		}
		return false;
	}
}

/**
 * Creates a front page and blog page and sets up
 * the static page option.
 * 
 * @since  1.4.0
 * @return void
 */
if( ! function_exists( 'tuext_create_frontpage' ) ) {
	function tuext_create_frontpage() {
		// Check nonce
		$nonce = $_POST[ 'tuext_create_frontpage' ];
		if ( ! wp_verify_nonce( $nonce, 'tuext_create_frontpage' ) ) {
			die();
		}

		// Setup front page
		$page_title = apply_filters( 'tradeup_extensions___frontpage_name', 'Tradeup Homepage' );
		$page_slug  = apply_filters( 'tradeup_extensions___frontpage_slug', 'tradeup-front-page' );

		$page = get_page_by_title( $page_title );
		if ( $page == null  || $page->post_status !== 'publish' ) {
			// Front Page
			$page_id = wp_insert_post(
				array(
					'comment_status' => 'closed',
					'ping_status'    => 'closed',
					'post_name'      => $page_slug,
					'post_title'     => $page_title,
					'post_status'    => 'publish',
					'post_type'      => 'page',
					'page_template'  => 'template-homepage.php',
				)
			);

			// Update static front page settings
			update_option('show_on_front', 'page');
			update_option('page_on_front', $page_id);
			update_option('tuext_fp_installed', true);

			// Blog view
			if ( get_page_by_title( 'Blog' ) == null ) {
				$page_id = wp_insert_post(
					array(
						'comment_status' => 'closed',
						'ping_status'    => 'closed',
						'post_name'      => 'blog',
						'post_title'     => 'Blog',
						'post_status'    => 'publish',
						'post_type'      => 'page',
					)
				);

				// Update option
				$blog = get_page_by_title( 'Blog' );
				update_option( 'page_for_posts', $blog->ID );
			}
		}

	}
}
add_action( 'wp_ajax_tuext_create_frontpage', 'tuext_create_frontpage' );

/**
 * Ajax action if the modal dismiss button is used
 * Updates the 'tuext_dismiss_fp_create' option to true
 * 
 * @since  1.4.0
 * @return void
 */
if( ! function_exists( 'tuext_dismiss_create_frontpage' ) ) {
	function tuext_dismiss_create_frontpage() {
		$nonce = $_POST[ 'tuext_create_frontpage' ];
		if ( ! wp_verify_nonce( $nonce, 'tuext_dismiss_create_frontpage' ) ) {
			die();
		}

		update_option( 'tuext_dismiss_fp_create', true );
	}
}
add_action( 'wp_ajax_tuext_dismiss_create_frontpage', 'tuext_dismiss_create_frontpage' );

/**
 * Adds an inline JS object and enqueues
 * thickbox scripts & styles
 * 
 * @todo   Maybe remove the `tuext_frontpage_vars` variable
 * @since  1.4.0
 * @return void
 */
if( ! function_exists( 'tuext_frontpage_vars' ) ) {
	function tuext_frontpage_vars() {
			$suffix = tu_ext_get_min_suffix();

			wp_localize_script( 'tradeup-extensions-customizer-js', 'tuext_frontpage_vars', array(
				'used_frontpage' => tuext_used_frontpage(),
				'has_frontpage' => tuext_has_frontpage(),
			) );
			
			// Magnific Popup CSS
			// @since 1.0.6
			wp_enqueue_style( 
				'magnific-popup-css', 
				TRADEUP_EXTS_URL . 'tradeup/css/magnific-popup.css', 
				array(), 
				'1.1.0', 'all' 
			);

			// Magnific Popup JS
			// @since 1.0.6
			wp_enqueue_script(
				'magnific-popup-js',
				TRADEUP_EXTS_URL . 'tradeup/js/customizer/jquery.magnific-popup' . $suffix . '.js',
				array( 'jquery' ),
				'1.1.0', FALSE
			);
	}
}

/**
 * "Static Front Page" modal template
 * 
 * @since  1.4.0
 * @return html
 */
if( ! function_exists( 'tuext_frontpage_modal' ) ) {
	function tuext_frontpage_modal() {
		?>
		<div id="tradeup-frontpage-modal" class="mfp-hide mfp-white-popup-block tuext-stp-modal-window">
			<h1><?php esc_html_e( 'Tradeup Homepage Setup', 'tradeup-extensions' ); ?></h1>
			<p><?php esc_html_e( 'Would you like to add a static Homepage?', 'tradeup-extensions' ); ?></p>
			<p><?php printf(
				esc_html__( 'It will add a page template called "Tradeup Homepage" that includes all 8 custom sections Or you can do this manually, %s.', 'tradeup-extensions' ),
				'<a href="' . TRADEUP_EXTS_THEME_DOCS . '" target="_blank">' . esc_html_x( 'here is how', 'Homepage setup modal', 'tradeup-extensions' ) . '</a>'
			);
			?></p>
			<div class="button-group">
				<a href="#" class="button-primary button button-hero" id="tuext-insert-frontpage"><?php esc_html_e( 'Insert Front Page', 'tradeup-extensions' ); ?></a>
				<a href="#" class="button-secondary button button-hero" id="tuext-dismiss-frontpage"><?php esc_html_e( 'Never Ask Again', 'tradeup-extensions' ); ?></a>
			</div>
      	</div>
		<?php
	}
}

/**
 * Init if front page doesn't exist.
 */
$tuext_check_fp = tuext_used_frontpage();
if( ! $tuext_check_fp && get_option( 'tuext_dismiss_fp_create', false ) === false ) {
	add_filter( 'customize_controls_enqueue_scripts', 'tuext_frontpage_vars', 20 );
	add_action( 'customize_controls_print_footer_scripts', 'tuext_frontpage_modal' );
}
