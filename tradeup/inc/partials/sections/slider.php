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
	 * Slider Section
	 * --------------
	 */

	// Section wrapper - start
	if( ! function_exists( 'tu_ext_part__slider_wrap_start' ) ) {
		function tu_ext_part__slider_wrap_start() {
			?><section id="section-slider" class="sec-slider"><?php
		}
	}

	// Section wrapper - end
	if( ! function_exists( 'tu_ext_part__slider_wrap_end' ) ) {
		function tu_ext_part__slider_wrap_end() {
			?></section><?php
		}
	}

		// Arrows
		if( ! function_exists( 'tu_ext_part__slider_arrows' ) ) {
			function tu_ext_part__slider_arrows() {
				$hide    = tu_ext_tm( 'slider_arrows_disable', false );
				$code    = '<a href="#" class="ss-prev">' . tradeup_icon( 'angle-left', false ) . '</a>';
				$code   .= '<a href="#" class="ss-next">' . tradeup_icon( 'angle-right', false ) . '</a>';
				$output  = apply_filters( 'tu_ext_part___slider_arrows', $code );

				if( ! $hide ) {
					echo wp_kses_post($output);
				}
			}
		}

		// Items
		if( ! function_exists( 'tu_ext_part__slider_items' ) ) {
			function tu_ext_part__slider_items() {
				/**
 				 * Hooked:
 				 * tu_ext_part__slider_items_start   - 10
 				 * tu_ext_part__slider_items_display - 20
 				 * tu_ext_part__slider_items_helper  - 30
 				 * tu_ext_part__slider_items_end     - 999
 				 */
 				do_action( 'tu_ext_part__slider_items' );
			}
		}

			// Items - start
			if( ! function_exists( 'tu_ext_part__slider_items_start' ) ) {
				function tu_ext_part__slider_items_start() {
					?><div class="sec-slider-wrap owl-carousel" id="ac-slider-section"><?php
				}
			}

			// Items - end
			if( ! function_exists( 'tu_ext_part__slider_items_end' ) ) {
				function tu_ext_part__slider_items_end() {
					?></div><?php
				}
			}

			// Items display
			if( ! function_exists( 'tu_ext_part__slider_items_display' ) ) {
				function tu_ext_part__slider_items_display() {
					if ( is_active_sidebar( 'section-slider' ) && ! is_paged() ) {
						dynamic_sidebar( 'section-slider' );
					}
				}
			}

			// Items helper
			if( ! function_exists( 'tu_ext_part__slider_items_helper' ) ) {
				function tu_ext_part__slider_items_helper() {
					if ( ! is_active_sidebar( 'section-slider' ) ) {
						?>
						<div class="sec-slider-slide">
				        	<div class="sec-slider-overlay" style="background: linear-gradient(to bottom, rgba(5,20,30,0.9) 0%, rgba(5,20,30,0.1) 100%);">
				            	<div class="sec-hs-elements ta-center">
				                    <h2 class="hs-primary-large animated"><?php _e( 'Add Some Slides to make Slider Work.', 'tradeup-extensions' ); ?></h2>
				                    <p class="sec-hs-description fs-largest fw-regular"><?php _e( 'Open Customizer > Homepage Sections > Slider Section > Add or Edit slides', 'tradeup-extensions' ); ?></p>
				                </div>
				            </div>
				        </div>
						<?php
					}
				}
			}

		// JS
		if( ! function_exists( 'tu_ext_part__slider_js' ) ) {
			function tu_ext_part__slider_js() {
				$autoplay = tu_ext_tm( 'slider_autoplay_enable' ) == 0 ? 'false' : 'true';
				$delay    = tu_ext_tm( 'slider_autoplay_delay', '5000' );
				$arrows   = tu_ext_tm( 'slider_arrows_disable', false );
				?>
				<script type='text/javascript'>
					jQuery( document ).ready( function( $ ) {

						/* Create slider */
						function tu_createSlider() {
							var ap;
							if ( 'undefined' !== typeof wp && wp.customize  ) { ap = false; } else { ap = <?php echo esc_html( $autoplay ) ?>; }

							$('#ac-slider-section').owlCarousel({
								responsiveClass: true,
								items:           1,
								autoplay:        ap,
								autoplayTimeout: <?php echo absint( $delay ); ?>,
								loop:            false,
								rewind:          true,
								animateOut:      'fadeOut',
								nav:             false,
							});
						}

						<?php if( ! $arrows ) { ?>
						/* Navigation Arrows */
						$('.sec-slider .ss-next').click(function(event) { event.preventDefault(); $('#ac-slider-section').trigger('next.owl.carousel', [200]); });
						$('.sec-slider .ss-prev').click(function(event) { event.preventDefault(); $('#ac-slider-section').trigger('prev.owl.carousel', [200]); });
						<?php } ?>

						/* Initialize */
						tu_createSlider();

						<?php if( is_customize_preview() ) : ?>

						/* Destroy it */
						function tu_destroySlider() {
							var selector = '#ac-slider-section';
							$(selector).removeClass('owl-loaded owl-drag');
							$(selector + ' .owl-stage').children().unwrap();
							$(selector + ' .owl-stage-outer').children().unwrap();
							$(selector).find('.owl-stage').remove();
							$(selector).find('.owl-nav').remove();
							$(selector).find('.owl-dots').remove();
							$(selector + ' .sec-slider-slide').each(function(index, element) {
			                    $(element).removeClass('owl-item').removeClass('active').removeAttr('style'); });
							$(selector).removeData();
						}

						/* Height resizer */
						function tu_sliderHeightResizer() {
							var slideClass	= $( ".sec-slider-slide" ),
								main_window = $( window ),
								new_height	= ( $('body').hasClass( 'menu-ff' ) || $('body').hasClass( 'menu-nn' ) ) ? main_window.height() - $('.main-header').outerHeight() : main_window.height();
							slideClass.css( 'height', new_height );
						}

						/* Customizer Selective Refresh */
						if ( 'undefined' !== typeof wp && wp.customize  ) {
							wp.customize.selectiveRefresh.bind( 'sidebar-updated', function( sidebarPartial ) {
								if ( 'section-slider' === sidebarPartial.sidebarId ) {
									tu_destroySlider();
									tu_createSlider();
									tu_sliderHeightResizer();
								}
							});
						}

						<?php endif; ?>

					});
				</script>
				<?php
			}
		}
