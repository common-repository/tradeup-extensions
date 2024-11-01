<?php
/**
 * ------------------
 * Template functions
 * ------------------
 *
 * In case you need to add some custom functions,
 * add them below.
 *
 */




/**
 * -----------------
 * Template partials
 * -----------------
 *
 * @see ../inc/partials/sections/hooks.php
 */

	/**
	 * Features Section
	 * ----------------
	 */

	// Section wrapper - start
	if( ! function_exists( 'tu_ext_part__features_wrap_start' ) ) {
		function tu_ext_part__features_wrap_start() {
			$mod      = 'features_bg_parallax';
			$enabled  = tu_ext_tm( $mod, false );
			$class    = $enabled ? ' tu-ext-parallax' : '';
			$parallax = tuext_section_parallax( $mod, 'features_bg_parallax_img', true );
			$format   = '<section id="section-features" class="grid-wrap sec-features%1$s"%2$s>';

			$output = sprintf( $format, $class, $parallax );
			$output = apply_filters( 'tu_ext_part___features_wrap_start', $output, $format, $class, $parallax );

			echo wp_kses_post($output);
		}
	}

	// Section wrapper - end
	if( ! function_exists( 'tu_ext_part__features_wrap_end' ) ) {
		function tu_ext_part__features_wrap_end() {
			?></section><?php
		}
	}

		// Overlay
		if( ! function_exists( 'tu_ext_part__features_overlay' ) ) {
			function tu_ext_part__features_overlay() {
				$section = 'features';
				$show    = tu_ext_tm( 'features_bg_overlay', false );
				$output  = '<div class="grid-overlay"></div>';
				$output  = apply_filters( 'tu_ext_part___overlay', $output, $section );

				// Do nothing if hidden
				if( ! $show ) return;

				echo wp_kses_post($output);
			}
		}

		/**
		 * Container
		 */
		if( ! function_exists( 'tu_ext_part__features_container' ) ) {
 			function tu_ext_part__features_container() {
 				/**
 				 * Hooked:
 				 * tu_ext_part__features_container_start   - 10
 				 * tu_ext_part__features_header            - 20
 				 * tu_ext_part__features_helper            - 30
 				 * tu_ext_part__features_items             - 40
 				 * tu_ext_part__features_container_end     - 999
 				 */
 				do_action( 'tu_ext_part__features_container' );
 			}
 		}

			// Container start
			if( ! function_exists( 'tu_ext_part__features_container_start' ) ) {
				function tu_ext_part__features_container_start() {
					?><div class="grid-container grid-1 clearfix"><?php
				}
			}

			// Container end
			if( ! function_exists( 'tu_ext_part__features_container_end' ) ) {
				function tu_ext_part__features_container_end() {
					?></div><?php
				}
			}

			// Header
			if( ! function_exists( 'tu_ext_part__features_header' ) ) {
				function tu_ext_part__features_header() {
					$title = tu_ext_tm( 'features_section_title', esc_html__( 'Our Features', 'tradeup-extensions' ) );
					$desc  = tu_ext_tm( 'features_section_description', esc_html__( 'This is a description for the Features section. You can set it up in the Customizer where you can also add items for it.', 'tradeup-extensions' ) );

					if( $title != '' || $desc != '' ) {
						/**
						 * Hooked:
						 * tu_ext_part__features_header_start       - 10
						 * tu_ext_part__features_header_title       - 20
						 * tu_ext_part__features_header_description - 30
						 * tu_ext_part__features_header_end         - 999
						 */
						do_action( 'tu_ext_part__features_header' );
					}
				}
			}

				// Header start
				if( ! function_exists( 'tu_ext_part__features_header_start' ) ) {
					function tu_ext_part__features_header_start() {
						?><header class="section-header"><?php
					}
				}

				// Header end
				if( ! function_exists( 'tu_ext_part__features_header_end' ) ) {
					function tu_ext_part__features_header_end() {
						?></header><?php
					}
				}

				// Section title
				if( ! function_exists( 'tu_ext_part__features_header_title' ) ) {
					function tu_ext_part__features_header_title() {
						$section = 'features';
						$title   = tuext_sections_strings( $section, 'title' );
						$format  = '<h2 class="sm-title %1$s">%2$s</h2>%3$s';
						$divider = '<div class="divider"></div>';
						$anim    = tradeup_anim_classes( true );

						$output  = sprintf( $format, $anim, esc_html( $title ), $divider );
						$output  = apply_filters(
							'tu_ext_part___features_header_title',
							$output, $format, $anim, $title, $divider, $section
						);

						if( $title == '' ) return; // Do nothing

						echo wp_kses_post($output);
					}
				}

				// Section description
				if( ! function_exists( 'tu_ext_part__features_header_description' ) ) {
					function tu_ext_part__features_header_description() {
						$section = 'features';
						$desc    = tuext_sections_strings( $section, 'description' );
						$format  = '<p class="section-description fs-large %1$s">%2$s</p>';
						$anim    = tradeup_anim_classes( true );

						$output  = sprintf( $format, $anim, tuext_escape_content_filtered_nonp( $desc ) );
						$output  = apply_filters(
							'tu_ext_part___features_header_description',
							$output, $format, $anim, $desc, $section
						);

						if( $desc == '' ) return; // Do nothing

						echo wp_kses_post($output);
					}
				}



			/**
			 * Items
			 */
			if( ! function_exists( 'tu_ext_part__features_items' ) ) {
				function tu_ext_part__features_items() {
					/**
					 * Hooked:
					 * tu_ext_part__features_items_start    - 10
					 * tu_ext_part__features_items_display  - 20
					 * tu_ext_part__features_items_helper  - 30
					 * tu_ext_part__features_items_end      - 999
					 */
					do_action( 'tu_ext_part__features_items' );
				}
			}

				// Items start
				if( ! function_exists( 'tu_ext_part__features_items_start' ) ) {
					function tu_ext_part__features_items_start() {
						?><div class="row grid-items clearfix <?php tradeup_anim_classes(); ?>"><?php
					}
				}

				// Items end
				if( ! function_exists( 'tu_ext_part__features_items_end' ) ) {
					function tu_ext_part__features_items_end() {
						?></div><?php
					}
				}

				// Items display
				if( ! function_exists( 'tu_ext_part__features_items_display' ) ) {
					function tu_ext_part__features_items_display() {
						if ( is_active_sidebar( 'section-features' ) && ! is_paged() ) {
							dynamic_sidebar( 'section-features' );
						}
					}
				}

				// Helper
				if( ! function_exists( 'tu_ext_part__features_helper' ) ) {
					function tu_ext_part__features_helper() {
						$helpers = tu_ext_tm( 'disable_helpers', false );
						$format  = '<div class="grid-col grid-4x-col ta-center">%s</div>';
						$message = __( 'You have to setup this section at <b>Customizer > Homepage Sections > Features Section</b> and add features by clicking on <b>Add or edit features</b>.<br/> To disable this message go to <b>Customizer > Settings > Extensions > Disable helpers/placeholders</b>.', 'tradeup-extensions' );
						$output  = sprintf( $format, $message );
						$output  = apply_filters( 'bx_ext_part___features_helper', $output, $format, $message, $helpers );

						if ( ! is_active_sidebar( 'section-features' ) && ! $helpers ) {
							echo wp_kses_post($output);
						}
					}
				}
