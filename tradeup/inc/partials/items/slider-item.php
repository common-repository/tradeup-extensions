<?php
/**
 * -------------
 * Item partials
 * -------------
 *
 * @see ../inc/partials/items-hooks.php
 */


	/**
	 * Slider item
	 * -----------
	 */

	// Overlay
	if( ! function_exists( 'tu_ext_item__slider_overlay' ) ) {
		function tu_ext_item__slider_overlay( $widget_options ) {
			/**
			 * Hooked:
			 * tu_ext_item__slider_overlay_start       - 10
			 * tu_ext_item__slider_elements            - 20
			 * tu_ext_item__slider_overlay_end         - 999
			 */
			do_action( 'tu_ext_item__slider_overlay', $widget_options );
		}
	}

	// Overlay start
	if( ! function_exists( 'tu_ext_item__slider_overlay_start' ) ) {
		function tu_ext_item__slider_overlay_start( $widget_options ) {
			$overlay = $widget_options['overlay'];
			$format  = '<div class="sec-slider-overlay"%s>';

			$output  = sprintf( $format, $overlay );
			$output  = apply_filters( 'tu_ext_item___slider_overlay_start', $output, $format, $widget_options );

			echo wp_kses_post($output);
		}
	}

	// Overlay end
	if( ! function_exists( 'tu_ext_item__slider_overlay_end' ) ) {
		function tu_ext_item__slider_overlay_end( $widget_options ) {
			?></div><?php
		}
	}

		// Elements
		if( ! function_exists( 'tu_ext_item__slider_elements' ) ) {
			function tu_ext_item__slider_elements( $widget_options ) {
				/**
				 * Hooked:
				 * tu_ext_item__slider_elements_start       - 10
				 * tu_ext_item__slider_elements_title       - 20
				 * tu_ext_item__slider_elements_paragraph   - 30
				 * tu_ext_item__slider_elements_buttons     - 40
				 * tu_ext_item__slider_elements_end         - 999
				 */
				do_action( 'tu_ext_item__slider_elements', $widget_options );
			}
		}

			// Elements start
			if( ! function_exists( 'tu_ext_item__slider_elements_start' ) ) {
				function tu_ext_item__slider_elements_start( $widget_options ) {
					?><div class="sec-hs-elements"><?php
				}
			}

			// Elements end
			if( ! function_exists( 'tu_ext_item__slider_elements_end' ) ) {
				function tu_ext_item__slider_elements_end( $widget_options ) {
					?></div><?php
				}
			}

			// Title
			if( ! function_exists( 'tu_ext_item__slider_elements_title' ) ) {
				function tu_ext_item__slider_elements_title( $widget_options ) {
					$title  = $widget_options['title'];
					$format = '<h2 class="hs-primary-large animated">%s</h2>';

					$output = sprintf( $format, esc_html( $title ) );
					$output = apply_filters( 'bx_ext_item___slider_elements_title', $output, $format, $widget_options );

					if( $title == '' ) return;

					echo wp_kses_post($output);
				}
			}

			// Paragraph
			if( ! function_exists( 'tu_ext_item__slider_elements_paragraph' ) ) {
				function tu_ext_item__slider_elements_paragraph( $widget_options ) {
					$paragraph  = $widget_options['paragraph'];
					$format     = '<p class="sec-hs-description fs-largest fw-regular">%s</p>';

					$output = sprintf( $format, tuext_escape_content_filtered_nonp( $paragraph ) );
					$output = apply_filters( 'bx_ext_item___slider_elements_paragraph', $output, $format, $widget_options );

					if( $paragraph == '' ) return;

					echo wp_kses_post($output);
				}
			}

			// Buttons
			if( ! function_exists( 'tu_ext_item__slider_elements_buttons' ) ) {
				function tu_ext_item__slider_elements_buttons( $widget_options ) {
					$show         = $widget_options['btn_show'];
					$btn_type     = $widget_options['btn_type'];
					$btn_between  = $widget_options['btn_between'];
					$btn_1_text   = $widget_options['btn_1_text'];
					$btn_1_url    = $widget_options['btn_1_url'];
					$btn_1_target = $widget_options['btn_1_target'];
					$btn_2_text   = $widget_options['btn_2_text'];
					$btn_2_url    = $widget_options['btn_2_url'];
					$btn_2_target = $widget_options['btn_2_target'];


					$buttons = tradeup_slider_btns_output(
						$btn_type, $btn_between, $btn_1_text, $btn_1_url, $btn_1_target, $btn_2_text, $btn_2_url, $btn_2_target
					);
					$format  = '<div class="sec-hs-buttons btn-wraper">%s</div>';

					$output = sprintf( $format, $buttons );
					$output = apply_filters( 'bx_ext_item___slider_elements_buttons', $output, $format, $widget_options );

					if( ! $show ) return;

					echo wp_kses_post($output);
				}
			}
