<?php
/* ------------------------------------------------------------------------- *
 *
 *  Sidebars
 *  ________________
 *
 *	This file registers sidebars some sidebars for the theme and sections
 *
/* ------------------------------------------------------------------------- */



/*  Widgets and Sidebars Setup
/* ------------------------------------ */
if ( ! function_exists( 'tradeup_extensions_sidebars_and_widgets' ) ) {
	function tradeup_extensions_sidebars_and_widgets() {

		// Sections sidebars
		register_sidebar( array( // Features Section
			'name'          => __( 'Features Section', 'tradeup-extensions' ),
			'id'            => 'section-features',
			'description'   => __( 'Features or Services section', 'tradeup-extensions' ),
			'before_widget' => '<div id="%1$s" class="sec-item %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '',
			'after_title'   => '',
		) );

		register_sidebar( array( // Call to Action
			'name'          => __( 'Call to Action', 'tradeup-extensions' ),
			'id'            => 'section-actions',
			'description'   => __( 'Call to Action', 'tradeup-extensions' ),
			'before_widget' => '<section id="%1$s" class="sec-item %2$s">',
			'after_widget'  => '</section><!-- END .sec-action .widget -->',
			'before_title'  => '',
			'after_title'   => '',
		) );

		register_sidebar( array( // Services
			'name'          => __( 'Services Section', 'tradeup-extensions' ),
			'id'            => 'section-about',
			'description'   => __( 'Services Section', 'tradeup-extensions' ),
			'before_widget' => '<div id="%1$s" class="sec-item %2$s">',
			'after_widget'  => '</div><!-- END .sec-about .widget -->',
			'before_title'  => '',
			'after_title'   => '',
		) );

		register_sidebar( array( // Testimonials
			'name'          => __( 'Testimonials Section', 'tradeup-extensions' ),
			'id'            => 'section-testimonials',
			'description'   => __( 'Testimonials section', 'tradeup-extensions' ),
			'before_widget' => '<div id="%1$s" class="sec-item %2$s">',
			'after_widget'  => '</div><!-- END .sec-testimonials .widget -->',
			'before_title'  => '',
			'after_title'   => '',
		) );

		register_sidebar( array( // Team Section
			'name'          => __( 'Team Section', 'tradeup-extensions' ),
			'id'            => 'section-team',
			'description'   => __( 'Team section', 'tradeup-extensions' ),
			'before_widget' => '<div id="%1$s" class="sec-item %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '',
			'after_title'   => '',
		) );

		register_sidebar( array( // Slider Section
			'name'          => __( 'Slider Section', 'tradeup-extensions' ),
			'id'            => 'section-slider',
			'description'   => __( 'Slider section', 'tradeup-extensions' ),
			'before_widget' => '<div id="%1$s" class="sec-item %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '',
			'after_title'   => '',
		) );

	}
}
add_action( 'widgets_init', 'tradeup_extensions_sidebars_and_widgets', 30 );
