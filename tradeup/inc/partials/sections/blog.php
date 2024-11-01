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
	 * Blog Section
	 * ---------------
	 */

	// Section wrapper - start
	if( ! function_exists( 'tu_ext_part__blog_wrap_start' ) ) {
		function tu_ext_part__blog_wrap_start() {
			$mod      = 'blog_bg_parallax';
			$enabled  = tu_ext_tm( $mod, false );
			$class    = $enabled ? ' tu-ext-parallax' : '';
			$parallax = tuext_section_parallax( $mod, 'blog_bg_parallax_img', true );
			$format   = '<section id="section-blog" class="grid-wrap sec-blog%1$s"%2$s>';

			$output = sprintf( $format, $class, $parallax );
			$output = apply_filters( 'tu_ext_part___blog_wrap_start', $output, $format, $class, $parallax );

			echo wp_kses_post($output);
		}
	}

	// Section wrapper - end
	if( ! function_exists( 'tu_ext_part__blog_wrap_end' ) ) {
		function tu_ext_part__blog_wrap_end() {
			?></section><?php
		}
	}

		// Overlay
		if( ! function_exists( 'tu_ext_part__blog_overlay' ) ) {
			function tu_ext_part__blog_overlay() {
				$section = 'blog';
				$show    = tu_ext_tm( 'blog_bg_overlay', false );
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
		if( ! function_exists( 'tu_ext_part__blog_container' ) ) {
 			function tu_ext_part__blog_container() {
 				/**
 				 * Hooked:
 				 * tu_ext_part__blog_container_start   - 10
 				 * tu_ext_part__blog_items             - 20
 				 * tu_ext_part__blog_container_end     - 999
 				 */
 				do_action( 'tu_ext_part__blog_container' );
 			}
 		}

			// Container start
			if( ! function_exists( 'tu_ext_part__blog_container_start' ) ) {
				function tu_ext_part__blog_container_start() {
					?><div class="grid-container grid-1 clearfix"><?php
				}
			}

			// Container end
			if( ! function_exists( 'tu_ext_part__blog_container_end' ) ) {
				function tu_ext_part__blog_container_end() {
					?></div><?php
				}
			}

			/**
			 * Items
			 */
			if( ! function_exists( 'tu_ext_part__blog_items' ) ) {
				function tu_ext_part__blog_items() {
					/**
					 * Hooked:
					 * tu_ext_part__blog_items_header   - 10
					 * tu_ext_part__blog_items_posts    - 20
					 * tu_ext_part__blog_items_end      - 999
					 */
					do_action( 'tu_ext_part__blog_items' );
				}
			}

				// Items header
				if( ! function_exists( 'tu_ext_part__blog_items_header' ) ) {
					function tu_ext_part__blog_items_header() {
						/**
						 * Hooked:
						 * tu_ext_part__blog_items_header_start       - 10
						 * tu_ext_part__blog_items_header_title       - 20
						 * tu_ext_part__blog_items_header_description - 30
						 * tu_ext_part__blog_items_header_end         - 999
						 */
						do_action( 'tu_ext_part__blog_items_header' );
					}
				}

					// Header start
					if( ! function_exists( 'tu_ext_part__blog_items_header_start' ) ) {
						function tu_ext_part__blog_items_header_start() {
							?><header class="section-header"><?php
						}
					}

					// Header end
					if( ! function_exists( 'tu_ext_part__blog_items_header_end' ) ) {
						function tu_ext_part__blog_items_header_end() {
							?></header><?php
						}
					}

					// Section title
					if( ! function_exists( 'tu_ext_part__blog_items_header_title' ) ) {
						function tu_ext_part__blog_items_header_title() {
							$section = 'blog';
							$title   = tuext_sections_strings( $section, 'title' );
							$format  = '<h2 class="sm-title %1$s">%2$s</h2>%3$s';
							$divider = '<div class="section-sep"></div>';
							$anim    = tradeup_anim_classes( true );

							$output  = sprintf( $format, $anim, esc_html( $title ), $divider );
							$output  = apply_filters(
								'bx_ext_part___blog_info_output_title',
								$output, $format, $anim, $title, $divider, $section
							);

							if( $title == '' ) return; // Do nothing

							echo wp_kses_post($output);
						}
					}

					// Section description
					if( ! function_exists( 'tu_ext_part__blog_items_header_description' ) ) {
						function tu_ext_part__blog_items_header_description() {
							$section = 'blog';
							$desc    = tuext_sections_strings( $section, 'description' );
							$format  = '<p class="section-description fs-large %1$s">%2$s</p>';
							$anim    = tradeup_anim_classes( true );

							$output  = sprintf( $format, $anim, tuext_escape_content_filtered_nonp( $desc ) );
							$output  = apply_filters(
								'bx_ext_part___blog_info_output_description',
								$output, $format, $anim, $desc, $section
							);

							if( $desc == '' ) return; // Do nothing

							echo wp_kses_post($output);
						}
					}

				// Items posts
				if( ! function_exists( 'tu_ext_part__blog_items_posts' ) ) {
					function tu_ext_part__blog_items_posts() {
						/**
						 * Hooked:
						 * tu_ext_part__blog_items_posts_start   - 10
						 * tu_ext_part__blog_items_posts_sizers  - 20
						 * tu_ext_part__blog_items_posts_loop    - 30
						 * tu_ext_part__blog_items_posts_end     - 999
						 * tu_ext_part__blog_items_posts_js      - 1010
						 * tu_ext_part__blog_items_posts_action  - 1020
						 */
						do_action( 'tu_ext_part__blog_items_posts' );
					}
				}

					// Posts start
					if( ! function_exists( 'tu_ext_part__blog_items_posts_start' ) ) {
						function tu_ext_part__blog_items_posts_start() {
							?><div id="sec-blog-wrap" class="row js-masonry grid-masonry-wrap <?php tradeup_anim_classes(); ?>" data-masonry-options='{ "columnWidth": ".sec-blog-grid-sizer", "gutter": ".sec-blog-gutter-sizer", "percentPosition": true, "itemSelector": ".grid-col" }'><?php
						}
					}

					// Posts end
					if( ! function_exists( 'tu_ext_part__blog_items_posts_end' ) ) {
						function tu_ext_part__blog_items_posts_end() {
							?></div><?php
						}
					}

					// Masonry JS
					/*if( ! function_exists( 'tu_ext_part__blog_items_posts_js' ) ) {
						function tu_ext_part__blog_items_posts_js() {
							?>
							<script type='text/javascript'>
								jQuery( document ).ready( function( $ ) {
									var $sec_blogwrap = $('#sec-blog-wrap').masonry();
									$sec_blogwrap.imagesLoaded( function() {
										$sec_blogwrap.masonry();
									});
								});
							</script>
							<?php
						}
					}*/

					// Action button
					if( ! function_exists( 'tu_ext_part__blog_items_posts_action' ) ) {
						function tu_ext_part__blog_items_posts_action() {
							$show   = tu_ext_tm( 'blog_action_btn_show', false );
							$label  = tuext_sections_strings( 'blog', 'button' );
							$url    = tu_ext_tm( 'blog_action_btn_url', '#' );
							$format = '<div class="grid-col grid-4x-col blog-action ta-center"><a href="%1$s" class="ac-btn btn-biggest blog-action-btn">%2$s</a></div>';

							$output = sprintf( $format, esc_url( $url ), esc_html( $label ) );
							$output = apply_filters( 'bx_ext_part___blog_items_posts_action', $output, $format, $label, $url, $show );

							if( ! $show ) return;

							echo wp_kses_post($output);
						}
					}

						// Posts sizers
						if( ! function_exists( 'tu_ext_part__blog_items_posts_sizers' ) ) {
							function tu_ext_part__blog_items_posts_sizers() {
								?><!-- <div class="sec-blog-grid-sizer"></div><div class="sec-blog-gutter-sizer"></div> --><?php
							}
						}

						// Posts loop
						if( ! function_exists( 'tu_ext_part__blog_items_posts_loop' ) ) {
							function tu_ext_part__blog_items_posts_loop() {
								$numb = tu_ext_tm( 'blog_section_nr_posts', 3 );
								$args = apply_filters( 'bx_ext_part___blog_items_posts_loop_args', array(
									'order'           	=> 'desc',
									'orderby'         	=> 'date',
									'posts_per_page' 	=> absint( $numb ),
									'post__not_in' 		=> get_option( 'sticky_posts' ),
								) );
								$query = new WP_Query( $args );

								/* start loop */
								if ( $query->have_posts() ) :
									while ( $query->have_posts() ) : $query->the_post();

									/**
									 * Hooked:
									 * tu_ext_part__blog_items_posts_loop_post_start   - 10
									 * tu_ext_part__blog_items_posts_loop_post_thumb   - 20
									 * tu_ext_part__blog_items_posts_loop_post_title   - 30
									 * tu_ext_part__blog_items_posts_loop_post_excerpt - 40
									 * tu_ext_part__blog_items_posts_loop_post_meta    - 50
									 * tu_ext_part__blog_items_posts_loop_post_end     - 999
									 */
									do_action( 'tu_ext_part__blog_items_posts_loop_post' );

									endwhile;

									/* reset query */
									wp_reset_postdata();

									/* if no posts are found */
									else :
										$no_posts         = '<p class="ta-center">%s</p>';
										$no_posts_msg     = __( 'There is no posts to show. Please add some posts.', 'tradeup-extensions' );
										$display_no_posts = sprintf( $no_posts, $no_posts_msg );
										$display_no_posts = apply_filters( 'tu_ext_part__blog_items_no_posts', $display_no_posts, esc_html( $no_posts_msg ), $no_posts );

										echo wp_kses($display_no_posts,post);

									/* end query */
									endif;
							}
						}

							// Post start
							if( ! function_exists( 'tu_ext_part__blog_items_posts_loop_post_start' ) ) {
								function tu_ext_part__blog_items_posts_loop_post_start() {
									?><div class="col-lg-4 col-md-6 col-sm-12"><div class="blog-items"><?php
								}
							}

							// Post end
							if( ! function_exists( 'tu_ext_part__blog_items_posts_loop_post_end' ) ) {
								function tu_ext_part__blog_items_posts_loop_post_end() {
									?></div></div><!-- .sec-blog-post --><?php
								}
							}

							// Post thumbnail
							if( ! function_exists( 'tu_ext_part__blog_items_posts_loop_post_thumb' ) ) {
								function tu_ext_part__blog_items_posts_loop_post_thumb() {
									$post_id = get_the_ID();
									$wrap    = '<figure class="sec-blog-post-thumbnail">%s</figure>';
									$before  = '<a href="' . esc_url( get_permalink() ) . '" rel="nofollow">';
									$after   = '</a>';
									$image   = get_the_post_thumbnail( $post_id, 'tradeup-tmb-blog-wide' );
									$format  = '%1$s%2$s%3$s';
									$inner   = sprintf( $format, $before, $image, $after );
									$output  = sprintf( $wrap, $inner );

									$output = apply_filters(
										'bx_ext_part___blog_items_posts_loop_post_thumb', $output, $wrap, $before, $after, $image, $format, $inner );

									if( has_post_thumbnail( $post_id ) ) {
										echo wp_kses_post($output);
									}
								}
							}

							// Post title
							if( ! function_exists( 'tu_ext_part__blog_items_posts_loop_post_title' ) ) {
								function tu_ext_part__blog_items_posts_loop_post_title() {
									$wrap   = '<header class="sec-blog-post-title">%s</header>';
									$before = '<h3 class="hs-secondary-large fw-light"><a href="' . esc_url( get_permalink() ) . '" title="' . the_title_attribute( array( 'echo' => false ) ) . '">';
									$after  = '</a></h3>';
									$title  = the_title( '', '', false );
									$format = '%1$s%2$s%3$s';
									$inner  = sprintf( $format, $before, $title, $after );
									$output = sprintf( $wrap, $inner );

									$output = apply_filters(
										'bx_ext_part___blog_items_posts_loop_post_thumb', $output, $wrap, $before, $after, $title, $format, $inner );

									if( $title != '' ){
										echo wp_kses_post($output);
									}
								}
							}

							// Post meta
							if( ! function_exists( 'tu_ext_part__blog_items_posts_loop_post_meta' ) ) {
								function tu_ext_part__blog_items_posts_loop_post_meta() {
									?>
									<footer class="sec-blog-post-meta">
										<div class="sec-blog-post-meta-list">
											<?php tradeup_post_meta(); ?>
										</div>
									</footer>
									<?php
								}
							}
