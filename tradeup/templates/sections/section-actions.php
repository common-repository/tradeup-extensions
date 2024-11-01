<?php
/* ------------------------------------------------------------------------- *
 *  Call to Action Wrapper
/* ------------------------------------------------------------------------- */

if( tu_ext_show_section( 'actions' ) ) :

	/**
	 * Hooked:
	 * tu_ext_part__actions_display - 10
	 * tu_ext_part__actions_helper  - 999
	 *
	 * @since 1.0.4.3
	 * @see   ../inc/partials/sections/actions.php
	 */
	do_action( 'tu_ext_part__actions' );

endif; // END Call to Action
