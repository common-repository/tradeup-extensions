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
	 * Team Section
	 * ---------------
	 */

	// Section wrapper - start
	if( ! function_exists( 'tu_ext_part__team_wrap_start' ) ) {
		function tu_ext_part__team_wrap_start() {
			$mod      = 'team_bg_parallax';
			$enabled  = tu_ext_tm( $mod, false );
			$class    = $enabled ? ' tu-ext-parallax' : '';
			$parallax = tuext_section_parallax( $mod, 'team_bg_parallax_img', true );
			$format   = '<section id="section-team" class="grid-wrap sec-team%1$s"%2$s>';

			$output = sprintf( $format, $class, $parallax );
			$output = apply_filters( 'tu_ext_part___team_wrap_start', $output, $format, $class, $parallax );

			echo wp_kses_post($output);
		}
	}

	// Section wrapper - end
	if( ! function_exists( 'tu_ext_part__team_wrap_end' ) ) {
		function tu_ext_part__team_wrap_end() {
			?></section><?php
		}
	}

		// Overlay
		if( ! function_exists( 'tu_ext_part__team_overlay' ) ) {
			function tu_ext_part__team_overlay() {
				$section = 'team';
				$show    = tu_ext_tm( 'team_bg_overlay', false );
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
		if( ! function_exists( 'tu_ext_part__team_container' ) ) {
 			function tu_ext_part__team_container() {
 				/**
 				 * Hooked:
 				 * tu_ext_part__team_container_start   - 10
 				 * tu_ext_part__team_items             - 20
 				 * tu_ext_part__team_container_end     - 999
 				 */
 				do_action( 'tu_ext_part__team_container' );
 			}
 		}

			// Container start
			if( ! function_exists( 'tu_ext_part__team_container_start' ) ) {
				function tu_ext_part__team_container_start() {
					?><div class="grid-container grid-1 clearfix"><?php
				}
			}

			// Container end
			if( ! function_exists( 'tu_ext_part__team_container_end' ) ) {
				function tu_ext_part__team_container_end() {
					?></div><?php
				}
			}

			/**
			 * Items
			 */
			if( ! function_exists( 'tu_ext_part__team_items' ) ) {
				function tu_ext_part__team_items() {
					/**
					 * Hooked:
					 * tu_ext_part__team_items_header    - 10
					 * tu_ext_part__blog_items_members   - 20
					 */
					do_action( 'tu_ext_part__team_items' );
				}
			}

				// Items header
				if( ! function_exists( 'tu_ext_part__team_items_header' ) ) {
					function tu_ext_part__team_items_header() {
						/**
						 * Hooked:
						 * tu_ext_part__team_items_header_start       - 10
						 * tu_ext_part__team_items_header_title       - 20
						 * tu_ext_part__team_items_header_description - 30
						 * tu_ext_part__team_items_header_end         - 999
						 */
						do_action( 'tu_ext_part__team_items_header' );
					}
				}

					// Header start
					if( ! function_exists( 'tu_ext_part__team_items_header_start' ) ) {
						function tu_ext_part__team_items_header_start() {
							?><header class="section-header"><?php
						}
					}

					// Header end
					if( ! function_exists( 'tu_ext_part__team_items_header_end' ) ) {
						function tu_ext_part__team_items_header_end() {
							?></header><?php
						}
					}

					// Section title
					if( ! function_exists( 'tu_ext_part__team_items_header_title' ) ) {
						function tu_ext_part__team_items_header_title() {
							$section = 'team';
							$title   = tuext_sections_strings( $section, 'title' );
							$format  = '<h2 class="sm-title %1$s">%2$s</h2>%3$s';
							$divider = '<div class="section-sep"></div>';
							$anim    = tradeup_anim_classes( true );

							$output  = sprintf( $format, $anim, esc_html( $title ), $divider );
							$output  = apply_filters(
								'tu_ext_part___team_info_output_title',
								$output, $format, $anim, $title, $divider, $section
							);

							if( $title == '' ) return; // Do nothing

							echo wp_kses_post($output);
						}
					}

					// Section description
					if( ! function_exists( 'tu_ext_part__team_items_header_description' ) ) {
						function tu_ext_part__team_items_header_description() {
							$section = 'team';
							$desc    = tuext_sections_strings( $section, 'description' );
							$format  = '<p class="section-description fs-large %1$s">%2$s</p>';
							$anim    = tradeup_anim_classes( true );

							$output  = sprintf( $format, $anim, tuext_escape_content_filtered_nonp( $desc ) );
							$output  = apply_filters(
								'tu_ext_part___team_info_output_description',
								$output, $format, $anim, $desc, $section
							);

							if( $desc == '' ) return; // Do nothing

							echo wp_kses_post($output);
						}
					}

				// Items members
				if( ! function_exists( 'tu_ext_part__team_items_members' ) ) {
					function tu_ext_part__team_items_members() {
						/**
						 * Hooked:
						 * tu_ext_part__team_items_members_start   - 10
						 * tu_ext_part__team_items_members_display - 20
						 * tu_ext_part__team_items_members_end     - 999
						 */
						do_action( 'tu_ext_part__team_items_members' );
					}
				}

					// Members start
					if( ! function_exists( 'tu_ext_part__team_items_members_start' ) ) {
						function tu_ext_part__team_items_members_start() {
							?><div class="row grid-items clearfix <?php tradeup_anim_classes(); ?>"><?php
						}
					}

					// Members end
					if( ! function_exists( 'tu_ext_part__team_items_members_end' ) ) {
						function tu_ext_part__team_items_members_end() {
							?></div><?php
						}
					}

					// Members display
					if( ! function_exists( 'tu_ext_part__team_items_members_display' ) ) {
						function tu_ext_part__team_items_members_display() {
							$helpers = tu_ext_tm( 'disable_helpers', false );

							if ( is_active_sidebar( 'section-team' ) && ! is_paged() ) :
								/* Display all memebers */
								dynamic_sidebar( 'section-team' );
							else :
								/* If no members are added */
								if ( ! $helpers ) {
									echo apply_filters(
										'tu_ext_part___team_items_members_display_none',
										'<div class="grid-col grid-4x-col ta-center">' . __( 'You have to setup this section at <b>Customizer > Homepage Sections > Team Section</b> and add teams by clicking on <b>Add or edit members</b>.<br/> To disable this message go to <b>Customizer > Settings > Extensions > Disable helpers/placeholders</b>.', 'tradeup-extensions' ) . '</div>'
									);
								}
							endif;
						}
					}
