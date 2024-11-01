<?php
/* ------------------------------------------------------------------------- *
 *  Testimonials Section Wrapper
/* ------------------------------------------------------------------------- */

if( tu_ext_show_section( 'testimonials' ) ) :

	/**
	 * Hooked:
	 * tu_ext_part__testimonials_wrap_start - 10
	 * tu_ext_part__testimonials_overlay    - 20
	 * tu_ext_part__testimonials_container  - 30
	 * tu_ext_part__testimonials_helper     - 40
	 * tu_ext_part__testimonials_items      - 50
	 * tu_ext_part__testimonials_nav        - 60
	 * tu_ext_part__testimonials_js         - 70
	 * tu_ext_part__testimonials_wrap_end   - 999
	 *
	 * @since 1.0.4.3
	 * @see   ../inc/partials/sections/testimonials.php
	 */
	do_action( 'tu_ext_part__testimonials' );

endif; // END Testimonials Section
