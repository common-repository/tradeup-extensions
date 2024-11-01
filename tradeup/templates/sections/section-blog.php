<?php
/* ------------------------------------------------------------------------- *
 *  Blog Section Wrapper
/* ------------------------------------------------------------------------- */

if( tu_ext_show_section( 'blog' ) ) :

	/**
	 * Hooked:
	 * tu_ext_part__blog_wrap_start - 10
	 * tu_ext_part__blog_overlay    - 20
	 * tu_ext_part__blog_container  - 30
	 * tu_ext_part__blog_wrap_end   - 999
	 *
	 * @since 1.0.4.3
	 * @see   ../inc/partials/sections/blog.php
	 */
	do_action( 'tu_ext_part__blog' );

endif; // END Blog Section
