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
	 * About Section
	 * -------------
	 */

	// Section wrapper - start
	if( ! function_exists( 'tu_ext_part__about_wrap_start' ) ) {
		function tu_ext_part__about_wrap_start() {
			$mod      = 'about_bg_parallax';
			$enabled  = tu_ext_tm( $mod, false );
			$class    = $enabled ? ' tu-ext-parallax' : '';
			$parallax = tuext_section_parallax( $mod, 'about_bg_parallax_img', true );
			$format   = '<section id="section-about" class="grid-wrap sec-about%1$s"%2$s>';

			$output = sprintf( $format, $class, $parallax );
			$output = apply_filters( 'tu_ext_part___about_wrap_start', $output, $format, $class, $parallax );

			echo wp_kses_post($output);
		}
	}

	// Section wrapper - end
	if( ! function_exists( 'tu_ext_part__about_wrap_end' ) ) {
		function tu_ext_part__about_wrap_end() {
			?></section><?php
		}
	}

		// Overlay
		if( ! function_exists( 'tu_ext_part__about_overlay' ) ) {
			function tu_ext_part__about_overlay() {
				$section = 'about';
				$show    = tu_ext_tm( 'about_bg_overlay', false );
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
		if( ! function_exists( 'tu_ext_part__about_container' ) ) {
 			function tu_ext_part__about_container() {
 				/**
 				 * Hooked:
 				 * tu_ext_part__about_container_start   - 10
 				 * tu_ext_part__about_header            - 20
 				 * tu_ext_part__about_items             - 30
 				 * tu_ext_part__about_button            - 40
 				 * tu_ext_part__about_container_end     - 999
 				 */
 				do_action( 'tu_ext_part__about_container' );
 			}
 		}

			// Container start
			if( ! function_exists( 'tu_ext_part__about_container_start' ) ) {
				function tu_ext_part__about_container_start() {
					?><div class="grid-container grid-1 clearfix"><?php
				}
			}

			// Container end
			if( ! function_exists( 'tu_ext_part__about_container_end' ) ) {
				function tu_ext_part__about_container_end() {
					?></div><?php
				}
			}

			// Header
			if( ! function_exists( 'tu_ext_part__about_header' ) ) {
				function tu_ext_part__about_header() {
					$title = tu_ext_tm( 'about_section_title', esc_html__( 'Services', 'tradeup-extensions' ) );
					$desc  = tu_ext_tm( 'about_section_description', esc_html__( 'This is description field for the Services section. You have to setup this section at Customizer > Homepage Sections > Services Section.', 'tradeup-extensions' ) );

					if( $title != '' || $desc != '' ) {
						/**
						 * Hooked:
						 * tu_ext_part__about_header_start       - 10
						 * tu_ext_part__about_header_title       - 20
						 * tu_ext_part__about_header_description - 30
						 * tu_ext_part__about_header_end         - 999
						 */
						do_action( 'tu_ext_part__about_header' );
					}
				}
			}

				// Header start
				if( ! function_exists( 'tu_ext_part__about_header_start' ) ) {
					function tu_ext_part__about_header_start() {
						?><header class="section-header"><?php
					}
				}

				// Header end
				if( ! function_exists( 'tu_ext_part__about_header_end' ) ) {
					function tu_ext_part__about_header_end() {
						?></header><?php
					}
				}

				// Section title
				if( ! function_exists( 'tu_ext_part__about_header_title' ) ) {
					function tu_ext_part__about_header_title() {
						$section = 'about';
						$title   = tuext_sections_strings( $section, 'title' );
						$format  = '<h2 class="sm-title %1$s">%2$s</h2>%3$s';
						$divider = '<div class="section-sep"></div>';
						$anim    = tradeup_anim_classes( true );

						$output  = sprintf( $format, $anim, esc_html( $title ), $divider );
						$output  = apply_filters(
							'bx_ext_part___about_header_title',
							$output, $format, $anim, $title, $divider, $section
						);

						if( $title == '' ) return; // Do nothing

						echo wp_kses_post($output);
					}
				}

				// Section description
				if( ! function_exists( 'tu_ext_part__about_header_description' ) ) {
					function tu_ext_part__about_header_description() {
						$section = 'about';
						$desc    = tuext_sections_strings( $section, 'description' );
						$format  = '<p class="section-description fs-large %1$s">%2$s</p>';
						$anim    = tradeup_anim_classes( true );

						$output  = sprintf( $format, $anim, tuext_escape_content_filtered_nonp( $desc ) );
						$output  = apply_filters(
							'bx_ext_part___about_header_description',
							$output, $format, $anim, $desc, $section
						);

						if( $desc == '' ) return; // Do nothing

						echo wp_kses_post($output);
					}
				}

			/**
			 * Items
			 */
			if( ! function_exists( 'tu_ext_part__about_items' ) ) {
				function tu_ext_part__about_items() {
					/**
					 * Hooked:
					 * tu_ext_part__about_items_start    - 10
					 * tu_ext_part__about_items_display  - 20
					 * tu_ext_part__about_items_helper   - 30
					 * tu_ext_part__about_items_end      - 999
					 */
					do_action( 'tu_ext_part__about_items' );
				}
			}

				// Items start
				if( ! function_exists( 'tu_ext_part__about_items_start' ) ) {
					function tu_ext_part__about_items_start() {
						?><div class="grid-items clearfix <?php tradeup_anim_classes(); ?>"><?php
					}
				}

				// Items end
				if( ! function_exists( 'tu_ext_part__about_items_end' ) ) {
					function tu_ext_part__about_items_end() {
						?></div><?php
					}
				}

				// Items display
				if( ! function_exists( 'tu_ext_part__about_items_display' ) ) {
					function tu_ext_part__about_items_display() {
						if ( is_active_sidebar( 'section-about' ) && ! is_paged() ) {
							dynamic_sidebar( 'section-about' );
						}
					}
				}

				// Items helper
				if( ! function_exists( 'tu_ext_part__about_items_helper' ) ) {
					function tu_ext_part__about_items_helper() {
						$helpers = tu_ext_tm( 'disable_helpers', false );
						$format  = '<div class="grid-col grid-4x-col ta-center">%s</div>';
						$message = __( 'You have to setup this section at <b>Customizer > Homepage Sections > Services Section</b> and add service option by clicking on <b>Add or edit Service boxes</b>.<br/> To disable this message go to <b>Customizer > Settings > Extensions > Disable helpers/placeholders</b>.', 'tradeup-extensions' );
						$output  = sprintf( $format, $message );
						$output  = apply_filters( 'bx_ext_part___about_items_helper', $output, $format, $message, $helpers );

						if ( ! is_active_sidebar( 'section-about' ) && ! $helpers ) {
							echo wp_kses_post($output);
						}
					}
				}

			// Button
			if( ! function_exists( 'tu_ext_part__about_button' ) ) {
				function tu_ext_part__about_button() {
					$show   = tu_ext_tm( 'about_section_hide_btn' ) == 0 ? true : false;
					$anchor = tuext_sections_strings( 'about', 'button' );
					$url    = tu_ext_tm( 'about_section_btn_anchor_url', '#' );
					$target = tu_ext_tm( 'about_section_btn_target', false ) ? '_blank' : '_self';
					$format = '<div class="about-button clearfix"><a href="%1$s" target="%2$s" class="ac-btn btn-biggest btn-opaque">%3$s</a></div>';
					$output = sprintf( $format, $url, $target, $anchor );
					$output = apply_filters( 'tu_ext_part___about_button', $output, $format, $url, $target, $anchor );

					if ( $show ) {
						echo wp_kses_post($output);
					}
				}
			}
