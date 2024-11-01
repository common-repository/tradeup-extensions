<?php
/* ------------------------------------------------------------------------- *
 *
 *  Customizer
 *  ________________
 *
 *	This file adds the needed functions/files for the Customizer
 *
/* ------------------------------------------------------------------------- */



/*  Get all theme mods
/* ------------------------------------ */
require_once ( TRADEUP_EXTS_PATH . '/tradeup/inc/customizer/helpers.php' );
require_once ( TRADEUP_EXTS_PATH . '/tradeup/inc/customizer/theme-mods.php' );



/*  Customizer JS/CSS
/* ------------------------------------ */
if( ! function_exists( 'tradeup_extensions_customizer_js_css' ) ) {
	function tradeup_extensions_customizer_js_css() {
		global $tradeup_extensions_cs_mods;
		$suffix = tu_ext_get_min_suffix();

		// Customizer Hacks
		wp_enqueue_script( 'tradeup-extensions-customizer-js', TRADEUP_EXTS_URL . 'tradeup/js/customizer/customizer-ext' . $suffix . '.js', array(), '20160412', true );
		wp_localize_script( 'tradeup-extensions-customizer-js', 'tuext_customizer_nonces',
			array(
				'n_sections' => wp_create_nonce( 'n_sections' ),
				'n_sections_bk' => wp_create_nonce( 'n_sections_bk' ),
				'n_sections_rt' => wp_create_nonce( 'n_sections_rt' ),
				'tuext_create_frontpage' => wp_create_nonce( 'tuext_create_frontpage' ),
				'tuext_dismiss_create_frontpage' => wp_create_nonce( 'tuext_dismiss_create_frontpage' ),
		) );

		// Settings Manager
		wp_enqueue_script( 'tradeup-extensions-customizer-settings', TRADEUP_EXTS_URL . 'tradeup/js/customizer/customizer-ext-settings' . $suffix . '.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), '20160412', true );
		wp_localize_script( 'tradeup-extensions-customizer-settings', 'tu_ext_customizer_settings', $tradeup_extensions_cs_mods );

	}
}
add_action( 'customize_controls_enqueue_scripts', 'tradeup_extensions_customizer_js_css' );

if( ! function_exists( 'tradeup_extensions_customizer_preview_js' ) ) {
	function tradeup_extensions_customizer_preview_js() {
		$sections = tradeup_extensions_sections();
		$suffix   = tu_ext_get_min_suffix();

		wp_enqueue_script( 'tradeup-extensions-customize-preview', TRADEUP_EXTS_URL . 'tradeup/js/customizer/customize-ext-preview' . $suffix . '.js', array( 'customize-preview' ), '20160412', true );
		wp_localize_script( 'tradeup-extensions-customize-preview', 'tu_ext_customizer_settings', $sections );
	}
}
add_action( 'customize_preview_init', 'tradeup_extensions_customizer_preview_js' );
