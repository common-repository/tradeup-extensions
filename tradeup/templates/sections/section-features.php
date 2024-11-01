<?php
/* ------------------------------------------------------------------------- *
 *  Features Section Wrapper
/* ------------------------------------------------------------------------- */

if( tu_ext_show_section( 'features' ) ) :

	/**
	 * Hooked:
	 * tu_ext_part__features_wrap_start - 10
	 * tu_ext_part__features_overlay    - 20
	 * tu_ext_part__features_container  - 30
	 * tu_ext_part__features_wrap_end   - 999
	 *
	 * @since 1.0.4.3
	 * @see   ../inc/partials/sections/features.php
	 */
	do_action( 'tu_ext_part__features' );

endif; // END Features Section
