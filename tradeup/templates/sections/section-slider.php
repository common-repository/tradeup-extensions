<?php
/* ------------------------------------------------------------------------- *
 *  Slider Section Wrapper
/* ------------------------------------------------------------------------- */

if( tu_ext_show_section( 'slider' ) ) :

	/**
	 * Hooked:
	 * tu_ext_part__slider_wrap_start - 10
	 * tu_ext_part__slider_arrows     - 20
	 * tu_ext_part__slider_items      - 30
	 * tu_ext_part__slider_js         - 40
	 * tu_ext_part__slider_wrap_end   - 999
	 *
	 * @since 1.0.4.3
	 * @see   ../inc/partials/sections/slider.php
	 */
	do_action( 'tu_ext_part__slider' );

endif; // END Slider Section
