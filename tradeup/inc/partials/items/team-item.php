<?php
/**
 * -------------
 * Item partials
 * -------------
 *
 * @see ../inc/partials/items-hooks.php
 */


	/**
	 * Team item
	 * ---------
	 */

	// Thumbnail
	if( ! function_exists( 'tu_ext_item__team_thumbnail' ) ) {
		function tu_ext_item__team_thumbnail( $widget_options ) {
			$avatar = $widget_options['avatar'];
			$url    = $widget_options['avatar_url'];
			$target = $widget_options['avatar_trg'] ? '_blank' : '_self';
			$before = $url != '' ? '<a target="' . $target . '" href="' . esc_url( $url ) . '">' : '';
			$after  = $url != '' ? '</a>' : '';
			$title  = $widget_options['title'];
			$format = '<figure class="sec-team-member-avatar">%1$s<img src="%2$s" alt="%3$s" />%4$s</figure>';

			$output = sprintf( $format, $before, esc_url( $avatar ), esc_attr( $title ), $after );
			$output = apply_filters( 'tu_ext_item___team_thumbnail', $output, $format, $widget_options );

			if( $avatar == '' ) return;

			echo wp_kses_post($output);
		}
	}

	// Title
	if( ! function_exists( 'tu_ext_item__team_title' ) ) {
		function tu_ext_item__team_title( $widget_options ) {
			$title    = $widget_options['title'];
			$title_o  = $widget_options['title_output'];
			$format   = '<h4 class="profile-name">%s</h43>';

			$output = sprintf( $format, $title_o );
			$output = apply_filters( 'tu_ext_item___team_title', $output, $format, $widget_options );

			if( $title == '' ) return;

			echo wp_kses_post($output);
		}
	}

	// Position
	if( ! function_exists( 'tu_ext_item__team_position' ) ) {
		function tu_ext_item__team_position( $widget_options ) {
			$position = $widget_options['position'];
			$class    = $position == '' ? ' no-pos' : '';
			$format   = '<h4 class="designation">%2$s</h4>';

			$output = sprintf( $format, $class, esc_html( $position ) );
			$output = apply_filters( 'tu_ext_item___team_position', $output, $format, $widget_options );

			echo wp_kses_post($output);
		}
	}

	// Description
	if( ! function_exists( 'tu_ext_item__team_description' ) ) {
		function tu_ext_item__team_description( $widget_options ) {
			$description  = $widget_options['description'];
			$allowed_html = $widget_options['allowed_html'];
			$format       = '<p>%s</p>';

			$output = sprintf( $format, tradeup_content_filter( $description, $allowed_html, TRUE ) );
			$output = apply_filters( 'tu_ext_item___team_description', $output, $format, $widget_options );

			if( $description == '' ) return;

			echo wp_kses_post($output);
		}
	}

	// Description
	if( ! function_exists( 'tu_ext_item__team_social' ) ) {
		function tu_ext_item__team_social( $widget_options ) {
			$social_links = $widget_options['social_links'];
			$format       = '<div class="sec-team-member-social clearfix">%s</div>';
			$link         = '<a href="%s" target="_blank" class="social-btn simple-social"><i></i></a>';
			$links        = '';

			foreach ( $social_links as $profile ) {
				if( $profile[ 'url' ] != '' ) {
					$links .= sprintf( $link, esc_url( $profile[ 'url' ] ) );
				}
			}

			$output = sprintf( $format, $links );
			$output = apply_filters( 'tu_ext_item___team_social', $output, $format, $link, $links, $widget_options );

			if( empty( $social_links ) ) return;

			echo wp_kses_post($output);
		}
	}
