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
	 * Portfolio Section
	 * -----------------
	 */

	// Section wrapper - start
	if( ! function_exists( 'tu_ext_part__portfolio_wrap_start' ) ) {
		function tu_ext_part__portfolio_wrap_start() {
			$mod      = 'portfolio_bg_parallax';
			$enabled  = tu_ext_tm( $mod, false );
			$class    = $enabled ? ' tu-ext-parallax' : '';
			$parallax = tuext_section_parallax( $mod, 'portfolio_bg_parallax_img', true );
			$format   = '<section id="section-portfolio" class="grid-wrap sec-portfolio%1$s"%2$s>';

			$output = sprintf( $format, $class, $parallax );
			$output = apply_filters( 'tu_ext_part___portfolio_wrap_start', $output, $format, $class, $parallax );

			echo wp_kses_post($output);
		}
	}

	// Section wrapper - end
	if( ! function_exists( 'tu_ext_part__portfolio_wrap_end' ) ) {
		function tu_ext_part__portfolio_wrap_end() {
			?></section><?php
		}
	}

		// Overlay
		if( ! function_exists( 'tu_ext_part__portfolio_overlay' ) ) {
			function tu_ext_part__portfolio_overlay() {
				$section = 'portfolio';
				$show    = tu_ext_tm( 'portfolio_bg_overlay', false );
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
		if( ! function_exists( 'tu_ext_part__portfolio_container' ) ) {
 			function tu_ext_part__portfolio_container() {
 				/**
 				 * Hooked:
 				 * tu_ext_part__portfolio_container_start   - 10
 				 * tu_ext_part__portfolio_items             - 20
 				 * tu_ext_part__portfolio_container_end     - 999
 				 */
 				do_action( 'tu_ext_part__portfolio_container' );
 			}
 		}

			// Container start
			if( ! function_exists( 'tu_ext_part__portfolio_container_start' ) ) {
				function tu_ext_part__portfolio_container_start() {
					?><div class="grid-container grid-2 clearfix"><?php
				}
			}

			// Container end
			if( ! function_exists( 'tu_ext_part__portfolio_container_end' ) ) {
				function tu_ext_part__portfolio_container_end() {
					?></div><?php
				}
			}

			/**
			 * Items
			 */
			if( ! function_exists( 'tu_ext_part__portfolio_items' ) ) {
				function tu_ext_part__portfolio_items() {
					/**
					 * Hooked:
					 * tu_ext_part__portfolio_items_header    - 10
					 * tu_ext_part__portfolio_items_projects  - 20
					 * tu_ext_part__portfolio_items_action    - 30
					 * tu_ext_part__portfolio_items_js        - 40
					 */
					do_action( 'tu_ext_part__portfolio_items' );
				}
			}

				// Items header
				if( ! function_exists( 'tu_ext_part__portfolio_items_header' ) ) {
					function tu_ext_part__portfolio_items_header() {
						/**
						 * Hooked:
						 * tu_ext_part__portfolio_items_header_start       - 10
						 * tu_ext_part__portfolio_items_header_title       - 20
						 * tu_ext_part__portfolio_items_header_description - 30
						 * tu_ext_part__portfolio_items_header_end         - 999
						 */
						do_action( 'tu_ext_part__portfolio_items_header' );
					}
				}

					// Header start
					if( ! function_exists( 'tu_ext_part__portfolio_items_header_start' ) ) {
						function tu_ext_part__portfolio_items_header_start() {
							?><header class="section-header"><?php
						}
					}

					// Header end
					if( ! function_exists( 'tu_ext_part__portfolio_items_header_end' ) ) {
						function tu_ext_part__portfolio_items_header_end() {
							?></header><?php
						}
					}

					// Section title
					if( ! function_exists( 'tu_ext_part__portfolio_items_header_title' ) ) {
						function tu_ext_part__portfolio_items_header_title() {
							$section = 'portfolio';
							$title   = tuext_sections_strings( $section, 'title' );
							$format  = '<h2 class="sm-title %1$s">%2$s</h2>%3$s';
							$divider = '<div class="section-sep"></div>';
							$anim    = tradeup_anim_classes( true );

							$output  = sprintf( $format, $anim, esc_html( $title ), $divider );
							$output  = apply_filters(
								'tu_ext_part___portfolio_info_output_title',
								$output, $format, $anim, $title, $divider, $section
							);

							if( $title == '' ) return; // Do nothing

							echo wp_kses_post($output);
						}
					}

					// Section description
					if( ! function_exists( 'tu_ext_part__portfolio_items_header_description' ) ) {
						function tu_ext_part__portfolio_items_header_description() {
							$section = 'portfolio';
							$desc    = tuext_sections_strings( $section, 'description' );
							$format  = '<p class="section-description fs-large %1$s">%2$s</p>';
							$anim    = tradeup_anim_classes( true );

							$output  = sprintf( $format, $anim, tuext_escape_content_filtered_nonp( $desc ) );
							$output  = apply_filters(
								'tu_ext_part___portfolio_info_output_description',
								$output, $format, $anim, $desc, $section
							);

							if( $desc == '' ) return; // Do nothing

							echo wp_kses_post($output);
						}
					}

				// Items projects
				if( ! function_exists( 'tu_ext_part__portfolio_items_projects' ) ) {
					function tu_ext_part__portfolio_items_projects() {
						/**
						 * Hooked:
						 * tu_ext_part__portfolio_items_projects_start   - 10
						 * tu_ext_part__portfolio_items_projects_sizers  - 20
						 * tu_ext_part__portfolio_items_projects_display - 30
						 * tu_ext_part__portfolio_items_projects_end     - 999
						 */
						do_action( 'tu_ext_part__portfolio_items_projects' );
					}
				}

					// Projects start
					if( ! function_exists( 'tu_ext_part__portfolio_items_projects_start' ) ) {
						function tu_ext_part__portfolio_items_projects_start() {
							?><div id="sec-portfolio-wrap" class="grid-masonry-wrap <?php tradeup_anim_classes(); ?>" data-masonry-options='{ "columnWidth": ".sec-portfolio-grid-sizer", "gutter": ".sec-portfolio-gutter-sizer", "percentPosition": true, "itemSelector": ".grid-col" }'><?php
						}
					}

					// Projects end
					if( ! function_exists( 'tu_ext_part__portfolio_items_projects_end' ) ) {
						function tu_ext_part__portfolio_items_projects_end() {
							?></div><?php
						}
					}

					// Projects sizers
					if( ! function_exists( 'tu_ext_part__portfolio_items_projects_sizers' ) ) {
						function tu_ext_part__portfolio_items_projects_sizers() {
							?>
							<div class="sec-portfolio-grid-sizer"></div>
							<div class="sec-portfolio-gutter-sizer"></div>
							<?php
						}
					}

					// Projects display
					if( ! function_exists( 'tu_ext_part__portfolio_items_projects_display' ) ) {
						function tu_ext_part__portfolio_items_projects_display() {
							$number  = tu_ext_tm( 'portfolio_section_nr_posts', 3 );
							$helpers = tu_ext_tm( 'disable_helpers', false );
							/* Check if Jetpack is enabled and the Custom Content Types module is on */
							if( tradeup_jetpack_check( 'custom-content-types' ) ) :

								/* Projects Qyert */
								$args = apply_filters( 'tu_ext_part___portfolio_query', array(
									'order'           	=> 'asc',
									'orderby'         	=> 'date',
									'posts_per_page' 	=> absint( $number ),
									'post_type'			=> 'jetpack-portfolio'
								) );
								$query = new WP_Query( $args );

								/* Check if we have projects */
								if ( $query->have_posts() ) :

									/* If we have, show them */
									while ( $query->have_posts() ) : $query->the_post();

										/* Get the project template */
										$tmpl = apply_filters( 'tu_ext_part___portfolio_query_tmpl', 'portfolio-page' );
										get_template_part( 'tradeup-controls/partials/posts/content', $tmpl );

									/* END while statement */
									endwhile;

									/* Reset query */
									wp_reset_postdata();

									/* If we don't find projects, display this */
									else :

										if( ! $helpers ) :

											$helper_tmpl  = '<p class="ta-center msg-info">';
											$helper_tmpl .= sprintf( __( 'did you publish your first portfolio? <a href="%1$s">Get started here</a>.<br/> To disable this message go to <b>Customizer > Settings > Extensions > Disable helpers/placeholders</b>.', 'tradeup-extensions' ), esc_url( admin_url( 'post-new.php?post_type=jetpack-portfolio' ) ) );
											$helper_tmpl .= '</p>';

											echo apply_filters( 'tu_ext_part___portfolio_helper', $helper_tmpl );

										/* END Helpers */
										endif;

								/* END Projects check */
								endif;

							/* If Jetpack isn't enabled */
							else :

								$nojetpack_tmpl  = '<p class="ta-center msg-info">';
								$nojetpack_tmpl .= sprintf( __( 'You have to install & activate <b>Jetpack</b> plugin and enable the <b>Portfolio</b> custom post type module to use this section. Portfolio will appear here once you activate the plugin.<br/> To disable this message go to <b>Customizer > Settings > Extensions > Disable helpers/placeholders</b>.', 'tradeup-extensions' ) );
								$nojetpack_tmpl .= '</p>';

								echo apply_filters( 'tu_ext_part___portfolio_nojetpack', $nojetpack_tmpl );


							/* END Jetpack check */
							endif;
						}
					}

				// Action button
				if( ! function_exists( 'tu_ext_part__portfolio_items_action' ) ) {
					function tu_ext_part__portfolio_items_action() {
						$show   = tu_ext_tm( 'portfolio_action_btn_show', false );
						$label  = tuext_sections_strings( 'portfolio', 'button' );
						$url    = tu_ext_tm( 'portfolio_action_btn_url', '#' );
						$format = '<div class="grid-col grid-4x-col portfolio-action ta-center"><a href="%1$s" class="ac-btn btn-biggest portfolio-action-btn">%2$s</a></div>';

						$output = sprintf( $format, esc_url( $url ), esc_html( $label ) );
						$output = apply_filters( 'tu_ext_part___portfolio_items_action', $output, $format, $label, $url, $show );

						if( ! $show ) return;

						echo wp_kses_post($output);
					}
				}