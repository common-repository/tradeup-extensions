<?php
/* ------------------------------------------------------------------------- *
 *  About Us Section Wrapper
/* ------------------------------------------------------------------------- */

if( tu_ext_show_section( 'about' ) ) :

	/**
	 * Hooked:
	 * tu_ext_part__about_wrap_start - 10
	 * tu_ext_part__about_overlay    - 20
	 * tu_ext_part__about_container  - 30
	 * tu_ext_part__about_wrap_end   - 999
	 *
	 * @since 1.0.4.3
	 * @see   ../inc/partials/sections/about.php
	 */
	do_action( 'tu_ext_part__about' );

endif; // END About Section
