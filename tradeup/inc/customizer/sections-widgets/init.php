<?php
/* ------------------------------------------------------------------------- *
 *  Initiate section's widgets
 *  ________________
 *
 *	This class will initiate all the available homepage sections/widgets
 *	________________
 *
/* ------------------------------------------------------------------------- */

if( ! class_exists( 'Tradeup_Extensions_Sections' ) ) {
	class Tradeup_Extensions_Sections {

		private static $instance;


		/*  Initiator
		/* ------------------------------------ */

		public static function init() {
			return self::$instance;
		}


		/*  Constructor
		/* ------------------------------------ */
		public function __construct() {

			// Widgets/Sections
			require_once ( TRADEUP_EXTS_PATH . '/tradeup/inc/customizer/sections-widgets/base.php' ); // Shared functions for all widgets
			require_once ( TRADEUP_EXTS_PATH . '/tradeup/inc/customizer/sections-widgets/items/features.php' ); // Features item
			require_once ( TRADEUP_EXTS_PATH . '/tradeup/inc/customizer/sections-widgets/items/actions.php' ); // Actions item
			require_once ( TRADEUP_EXTS_PATH . '/tradeup/inc/customizer/sections-widgets/items/about.php' ); // About Us item
			require_once ( TRADEUP_EXTS_PATH . '/tradeup/inc/customizer/sections-widgets/items/testimonials.php' ); // Testimonials item
			require_once ( TRADEUP_EXTS_PATH . '/tradeup/inc/customizer/sections-widgets/items/team.php' ); // Team item
			require_once ( TRADEUP_EXTS_PATH . '/tradeup/inc/customizer/sections-widgets/items/slider.php' ); // Slider item

		}


	}
}


/* Init everything via 'widgets_init' hook
/* --------------------------------------- */
if( ! function_exists( 'tradeup_extensions_sections_init' ) ) {
	function tradeup_extensions_sections_init() {
		global $tradeup_sections_init;
		$tradeup_sections_init = new Tradeup_Extensions_Sections();
		$tradeup_sections_init->init();
	}
}
add_action( 'widgets_init' , 'tradeup_extensions_sections_init' , 20 );
