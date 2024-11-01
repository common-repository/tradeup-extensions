<?php
/*
Plugin Name: Tradeup Extensions
Plugin URI:  
Description: Adds Homepage sections and other extensions to Tradeup WordPress theme. 
Version: 1.1 
Author: wptexture
Author URI:  
Text Domain: tradeup-extensions
Domain Path: /languages
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

/* Some constants */
if( ! defined( 'TRADEUP_EXTS_VERSION' ) ) {
	define( 'TRADEUP_EXTS_VERSION', '1.0.0' ); }

if( ! defined( 'TRADEUP_EXTS_THEME_NAME' ) ) {
	define( 'TRADEUP_EXTS_THEME_NAME', 'Tradeup' ); }

if( ! defined( 'TRADEUP_EXTS_THEME_URL' ) ) {
	define( 'TRADEUP_EXTS_THEME_URL', 'https://wordpress.org/themes/tradeup/' ); }

if( ! defined( 'TRADEUP_EXTS_THEME_DOCS' ) ) {
	define( 'TRADEUP_EXTS_THEME_DOCS', 'https://testerwp.com/docs/tradeup-theme-doc/' ); }	
if( ! defined( 'TRADEUP_EXTS_URL' ) ) {
	define( 'TRADEUP_EXTS_URL', plugin_dir_url( __FILE__ ) ); }

if( ! defined( 'TRADEUP_EXTS_PATH' ) ) {
	define( 'TRADEUP_EXTS_PATH', plugin_dir_path( __FILE__ ) ); }

/* Theme names */
if( ! function_exists( 'tradeup_extensions_theme' ) ) {
	/**
	 * Get current theme name
	 *
	 * @since  1.0.0
	 * @param  boolean $parent Return child name if false
	 * @return string          Current theme name
	 */
	function tradeup_extensions_theme( $parent = false ) {
		$theme = wp_get_theme();
		if( ! $parent ) {
			return $theme->name;
		} else {
			return $theme->parent_theme;
		}
	}
}



/* Load text domain */
if( ! function_exists( 'tradeup_extensions_textdomain' ) ) {
	/**
	 * Load text domain
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function tradeup_extensions_textdomain() {
		load_plugin_textdomain( 'tradeup-extensions', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}
}
add_action( 'plugins_loaded', 'tradeup_extensions_textdomain' );



/* Add Homepage sections */
if( ! function_exists( 'tradeup_extensions_sections' ) ) {
	/**
	 * A list of all the default & supported sections
	 *
	 * Use the `tradeup_extensions_sections___filter` to add yours
	 *
	 * @since  1.0.0
	 * @return array An array with unique, non duplicate sections names
	 */
	function tradeup_extensions_sections() {
		$sections = apply_filters( 'tradeup_extensions_sections___filter', array(
			'slider',
			'features',
			'about',
			'team',
			'portfolio',
			'actions',
			'testimonials',
			'blog'
		) );

		return array_map( 'sanitize_key', array_unique( $sections ) );
	}
}



if( ! function_exists( 'tradeup_extensions_sections_items' ) ) {
	/**
	 * Returns an array with names of sections
	 * that can add items
	 *
	 * @since  1.0.4.3
	 * @return array
	 */
	function tradeup_extensions_sections_items() {
		$sections = apply_filters( 'tradeup_extensions_sections_items___filter', array(
			'slider',
			'features',
			'about',
			'team',
			'actions',
			'testimonials',
		) );

		return array_map( 'sanitize_key', array_unique( $sections ) );
	}
}



if( ! function_exists( 'tradeup_extensions_add_sections' ) ) {
	/**
	 * Adds the sections saved in your theme mod
	 * 
	 * The theme will not handle this part anymore, it's deprecated in
	 * functions.php:L115-126
	 *
	 * @todo   Do some checks on `$positions` in case it's not JSON.
	 * @since  1.0.6
	 * @return void
	 */
	function tradeup_extensions_add_sections() {
		$mod       = 'tradeup_sections_position';
		$sections  = tradeup_extensions_sections();
		$positions = get_theme_mod( $mod );

		/* 
		 * Checks if no sections are saved in a theme_mod and if we 
		 * have at least one default sections 
		 */
		if( empty( $positions ) && ! empty( $sections ) ) {
			$new = array();

			/* Use the prefix for backwards compatibility */
			foreach( $sections as $key => $value ) {
				$new[] = 'tradeup_section__' . sanitize_key( $value );
			}

			/* Add the default sections if it's the first time. */
			set_theme_mod( $mod, json_encode( $new ) );
		}

		if( is_array( $positions ) ) {
			/* Pre version 1.0.6, convert them to JSON. */
			$a = json_encode( $positions );
			print_r($a);die;
			set_theme_mod( $mod, json_encode( $positions ) );
		}
	}
}
add_action( 'after_setup_theme', 'tradeup_extensions_add_sections', 15 );



if( ! function_exists( 'tradeup_extensions_add_new_sections' ) ) {
	/**
	 * Checks if new sections are added and adds them
	 * to the end of `tradeup_sections_position`
	 *
	 * @since  1.0.4.3
	 * @return array
	 */
	function tradeup_extensions_add_new_sections() {
		$prefix   = 'tradeup_section__';
		$sections = $new_sections = array();
		$defaults = tradeup_extensions_sections();
		$saved    = get_theme_mod( 'tradeup_sections_position' );

		/* Return if no theme mods are saved */
		if( $saved === false ) return;

		/* Check if it's an array, pre v1.0.6 */
		if( ! is_array( $saved ) ) {
			$saved = json_decode( $saved );
		}

		/**
		 * Create an array of all the sections and prefix
		 * them with `tradeup_section__`
		 */
		foreach ( $defaults as $section ) {
			$sections[] = $prefix . $section;
		}


		/**
		 * Check if any new sections were added
		 * @var array
		 */
		$diff = array_diff( $sections, $saved );

		/* If not, do nothing */
		if( empty( $diff ) ) return;

		/* Add all the new sections at the end of the array */
		foreach( $diff as $new_section ) {
			array_push( $saved, $new_section );
		}

		/* JSON encode the new array and set the theme mod with the new values */
		$saved = wp_json_encode( array_map( 'sanitize_key', array_unique( $saved ) ) );

		/* Update the theme mod with the new sections and positions */
		set_theme_mod( 'tradeup_sections_position', $saved );

	}
}
add_action( 'plugins_loaded', 'tradeup_extensions_add_new_sections' );


if ( ( 'Tradeup' == tradeup_extensions_theme() ) || ( 'Tradeup' == tradeup_extensions_theme( true ) ) ) {
	
	require_once ( dirname( __FILE__ ) . '/tradeup/inc/sidebars/register.php' );
	require_once ( dirname( __FILE__ ) . '/tradeup/inc/functions/helpers.php' );
	require_once ( dirname( __FILE__ ) . '/tradeup/inc/customizer/sections-widgets/init.php' );

	require_once ( dirname( __FILE__ ) . '/tradeup/inc/templating.php' );

	require_once ( dirname( __FILE__ ) . '/tradeup/inc/scripts/scripts.php' );

	require_once ( dirname( __FILE__ ) . '/tradeup/inc/customizer/customizer.php' );

	require_once ( dirname( __FILE__ ) . '/tradeup/inc/customizer/setup/front-page.php' );

	require_once ( dirname( __FILE__ ) . '/tradeup/inc/customizer/sections-widgets/styles.php' );//for slider images

	require_once ( dirname( __FILE__ ) . '/tradeup/inc/partials/partials.php' );

	require_once ( dirname( __FILE__ ) . '/tradeup/inc/partials/hooks.php' );

	require_once ( dirname( __FILE__ ) . '/tradeup/inc/partials/items-hooks.php' );//customizer content showing
}

// Disables the block editor from managing widgets.
add_filter( 'use_widgets_block_editor', '__return_false' );