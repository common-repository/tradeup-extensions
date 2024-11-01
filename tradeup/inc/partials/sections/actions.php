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
	 * Call to Action
	 * ---------------
	 */

	// Display
	if( ! function_exists( 'tu_ext_part__actions_display' ) ) {
		function tu_ext_part__actions_display() {
			if ( is_active_sidebar( 'section-actions' ) && ! is_paged() ) {
				dynamic_sidebar( 'section-actions' );
			}
		}
	}

	// Helper
	if( ! function_exists( 'tu_ext_part__actions_helper' ) ) {
		function tu_ext_part__actions_helper() {
			if ( ! is_active_sidebar( 'section-actions' ) ) {
			?>
			<section id="section-actions" class="grid-wrap sec-action elements-left">
                <div class="grid-container grid-1 clearfix <?php tradeup_anim_classes(); ?>">

                    <div class="grid-col grid-4x-col ta-center elements-meta section-header">
                        <h2 class="sm-title"><?php _e( 'Call to Action', 'tradeup-extensions' ); ?></h2>
                        <div class="elements-excerpt fs-large">
                            <?php _e( 'You have to setup this section at Customizer > Homepage Sections > Call to Action Section and add items by clicking on Add or edit actions.', 'tradeup-extensions' ); ?>
                        </div>
                        <div class="elements-buttons">
                       		<a href="#" class="ac-btn btn-big btn-1"><?php _e( 'Read More', 'tradeup-extensions' ); ?></a>
                    	</div>
                    </div><!-- END .elements-meta -->

                </div><!-- END .grid-container -->
            </section>
			<?php
			}
		}
	}
