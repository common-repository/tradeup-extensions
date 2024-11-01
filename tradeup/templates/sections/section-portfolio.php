<?php
/* ------------------------------------------------------------------------- *
 *  Portfolio Section Wrapper
/* ------------------------------------------------------------------------- */

if( tu_ext_show_section( 'portfolio' ) ) :

	/**
	 * Hooked:
	 * tu_ext_part__portfolio_wrap_start - 10
	 * tu_ext_part__portfolio_overlay    - 20
	 * tu_ext_part__portfolio_container  - 30
	 * tu_ext_part__portfolio_wrap_end   - 999
	 *
	 * @since 1.0.4.3
	 * @see   ../inc/partials/sections/portfolio.php
	 */
	do_action( 'tu_ext_part__portfolio' );

endif; // END Portfolio Section
