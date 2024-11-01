<?php
/**
 * -------------
 * Item partials
 * -------------
 *
 * @see ../inc/partials/items-hooks.php
 */


	/**
	 * About item
	 * ----------
	 */

	// Title
	if( ! function_exists( 'tu_ext_item__about_title' ) ) {
		function tu_ext_item__about_title( $widget_options ) {
			$title        = $widget_options['title'];
			$title_output = $widget_options['title_output'];
			$format = '<h3 class="hs-secondary-large fw-light">%s</h3>';

			$output = sprintf( $format, $title_output );
			$output = apply_filters( 'tu_ext_item___about_title', $output, $format, $widget_options );

			if( $title == '' ) return;

			echo wp_kses_post($output);
		}
	}

	// Excerpt
	if( ! function_exists( 'tu_ext_item__about_excerpt' ) ) {
		function tu_ext_item__about_excerpt( $widget_options ) {
			$excerpt      = $widget_options['excerpt'];
			$allowed_html = $widget_options['allowed_html'];

			$output = tradeup_ext_escape_content_filtered( $excerpt );
			$output = apply_filters( 'tu_ext_item___about_excerpt', $output, $widget_options );

			if( $excerpt == '' ) return;

			echo wp_kses_post($output);
		}
	}
