<?php
/* ------------------------------------------------------------------------- *
 *  Handle the templating system
/* ------------------------------------------------------------------------- */



/*
	Display sections in our theme via an action
	tradeup_new_frontpage_sections();
*/
if( ! function_exists( 'tradeup_extensions_display_sections' ) ) {
	function tradeup_extensions_display_sections() {
		$names = get_theme_mod( 'tradeup_sections_position' );
		if( $names === false ) return; // @since 1.0.6
		
		if( !is_array( $names ) ) {
			$names = json_decode( $names ); // @since 1.0.6
		}

		if( ! empty( $names ) ) {

			foreach( (array) $names as $key => $name ) {
				$new_name = str_replace( 'tradeup_section__', '', $name );
				tradeup_extensions_get_template_part( 'sections/section', $new_name );
			}

		}
	}
}
add_action( 'tradeup_new_frontpage_sections', 'tradeup_extensions_display_sections' );



/*
	Returns the path to the plugin templates directory
*/
if( ! function_exists( 'tradeup_extensions_get_templates_dir' ) ) {
	function tradeup_extensions_get_templates_dir() {
		return TRADEUP_EXTS_PATH . 'tradeup/templates';
	}
}



/*
	Returns the URL to the plugin templates directory
*/
if( ! function_exists( 'tradeup_extensions_get_templates_url' ) ) {
	function tradeup_extensions_get_templates_url() {
		return TRADEUP_EXTS_URL . 'tradeup/templates';
	}
}



/*
	Retrieves a template part
*/
if( ! function_exists( 'tradeup_extensions_get_template_part' ) ) {
	function tradeup_extensions_get_template_part( $slug, $name = null, $load = true ) {
		// Execute code for this part
		do_action( 'get_template_part_' . $slug, $slug, $name );

		// Setup possible parts
		$templates = array();
		if ( isset( $name ) )
			$templates[] = $slug . '-' . $name . '.php';
		$templates[] = $slug . '.php';

		// Allow template parts to be filtered
		$templates = apply_filters( 'tradeup_extensions___get_template_part', $templates, $slug, $name );

		// Return the part that is found
		return tradeup_extensions_locate_template( $templates, $load, false );
	}
}



/**
 * Retrieve the name of the highest priority template file that exists.
 *
 * Searches in the STYLESHEETPATH before TEMPLATEPATH so that themes which
 * inherit from a parent theme can just overload one file. If the template is
 * not found in either of those, it looks in the theme-compat folder last.
 *
 * Taken from bbPress
*/
if( ! function_exists( 'tradeup_extensions_locate_template' ) ) {
	function tradeup_extensions_locate_template( $template_names, $load = false, $require_once = true ) {
		// No file found yet
		$located = false;

		// Try to find a template file
		foreach ( (array) $template_names as $template_name ) {

			// Continue if template is empty
			if ( empty( $template_name ) )
				continue;

			// Trim off any slashes from the template name
			$template_name = ltrim( $template_name, '/' );

			// try locating this template file by looping through the template paths
			foreach( tradeup_extensions_get_theme_template_paths() as $template_path ) {

				if( file_exists( $template_path . $template_name ) ) {
					$located = $template_path . $template_name;
					break;
				}
			}

			if( $located ) {
				break;
			}
		}

		if ( ( true == $load ) && ! empty( $located ) )
			load_template( $located, $require_once );

		return $located;
	}
}



/*
	Returns a list of paths to check for template locations
*/
if( ! function_exists( 'tradeup_extensions_get_theme_template_paths' ) ) {
	function tradeup_extensions_get_theme_template_paths() {

		$template_dir = tradeup_extensions_get_theme_template_dir_name();

		$file_paths = array(
			1 => trailingslashit( get_stylesheet_directory() ) . $template_dir,
			10 => trailingslashit( get_template_directory() ) . $template_dir,
			100 => tradeup_extensions_get_templates_dir()
		);

		$file_paths = apply_filters( 'tradeup_extensions___template_paths', $file_paths );

		// sort the file paths based on priority
		ksort( $file_paths, SORT_NUMERIC );

		return array_map( 'trailingslashit', $file_paths );
	}
}



/*
	Returns the template directory name.
	Themes can filter this by using the tradeup_extensions___templates_dir filter.
*/
if( ! function_exists( 'tradeup_extensions_get_theme_template_dir_name' ) ) {
	function tradeup_extensions_get_theme_template_dir_name() {
		return trailingslashit( apply_filters( 'tradeup_extensions___templates_dir', 'tradeup_templates' ) );
	}
}
