<?php
/* ------------------------------------------------------------------------- *
 *  Helper Functions
/* ------------------------------------------------------------------------- */



/*  Check theme version
/* ------------------------------------ */
if( ! function_exists( 'tradeup_extensions_ck_theme_v' ) ) {
    function tradeup_extensions_ck_theme_v( $version, $sign = '>' ) {
        $theme_name = apply_filters( 'tradeup_extensions___get_theme_name', 'tradeup');
        $theme_ver = wp_get_theme( $theme_name )->get('Version');
        if( version_compare( $theme_ver, $version, $sign ) ) {
            return true;
        } else {
            return false;
        }
    }
}



/*  Check if Jetpack specific module
 *  is enabled
/* ------------------------------------ */
if( ! function_exists( 'tradeup_extensions_jp_active' ) ) {
    function tradeup_extensions_jp_active( $module ) {
        $active_modules = get_option( 'jetpack_active_modules' );
         
        if( $active_modules !== false ) {
            if( in_array( $module, $active_modules, TRUE ) ) { return true; } else { return false;  }
        } else {
            return false;
        }
    }
}



/*  Check if Jetpack specific module
 *  is enabled
/* ------------------------------------ */
if( ! function_exists( 'tradeup_extensions_jp_ck_mobile_theme' ) ) {
    function tradeup_extensions_jp_ck_mobile_theme() {
        if( tradeup_extensions_jp_active( 'minileven' ) ) {
            echo '<div class="notice error is-dismissible">';
        		echo '<p>' . __( 'Jetpack\'s <i> Mobile Theme</i> module is activated.', 'tradeup-extensions' )  .'</p>';
                echo '<p>' . __( 'This will cause an error or blank page on mobile devices. tradeup is already a responsive/mobile theme. Please disable the Mobile Theme module.', 'tradeup-extensions' ) . '</p>';
            echo '</div>';
        }
    }
}
add_action( 'admin_notices', 'tradeup_extensions_jp_ck_mobile_theme', 0 );



/*  Section parallax
/* ------------------------------------ */
if ( ! function_exists( 'tuext_section_parallax' ) ) {
	/**
	 * Adds a background image with parallax effect
	 *
	 * @since  1.0.4.3
	 * @param  string  $enabled Enable parallax theme mod
	 * @param  string  $bgimg   Parallax background image theme mod
	 * @param  boolean $return  Return or echo
	 * @return string
	 */
	function tuext_section_parallax( $enabled, $bgimg, $return = false ) {
		$background = get_theme_mod( $bgimg, '' );
		$parallax   = get_theme_mod( $enabled, false );
		$output     = '';

		if( $bgimg != '' && $parallax ) {
			$output = ' style="background-image: url(' . esc_url( $background ) . ');"';
		}

		if( $return ) { return $output; } else { echo esc_attr($output); }
	}
}



/*  Section strings
/* ------------------------------------ */
if( ! function_exists( 'tuext_sections_strings' ) ) {
	/**
	 * Display sections strings and use multilang if selected
	 *
	 * @since  1.0.4.3
	 * @param  string  $section Selected section
	 * @param  string  $string  Selected string
	 * @return string
	 */
	function tuext_sections_strings( $section, $string ) {
		// Check if we should use the Polylang strings
		$polylang = ( get_theme_mod( 'use_polylang', false ) && tuext_compt_polylang_check() ) ? true : false;
		// For section
		switch( $section ) {

			// Features
			case 'features' :
				switch ( $string ) {
					case 'title' :
						if( $polylang ) {
							return pll__( 'Our Features' );
						} else {
							return tu_ext_tm( 'features_section_title', __( 'Our Features', 'tradeup-extensions' ) );
						}
						break;
					case 'description' :
						if( $polylang ) {
							return pll__( 'This is a description for the Features section. You can set it up in the Customizer where you can also add items for it.' );
						} 
						break;
				}
				break;

			// About
			case 'about' :
				switch ( $string ) {
					case 'title' :
						if( $polylang ) {
							return pll__( 'Services' );
						} else {
							return tu_ext_tm( 'about_section_title', __( 'Services', 'tradeup-extensions' ) );
						}
						break;
					case 'description' :
						if( $polylang ) {
							return pll__( 'This is description field for the Services section. You have to setup this section at Customizer > Homepage Sections > Services Section.' );
						} else {
							return tu_ext_tm( 'about_section_description', __( 'This is description field for the Services section. You have to setup this section at Customizer > Homepage Sections > Services Section.', 'tradeup-extensions' ) );
						}
						break;
					case 'button' :
						if( $polylang ) {
							return pll__( 'Button Anchor Text' );
						} else {
							return tu_ext_tm( 'about_section_btn_anchor', __( 'Know More', 'tradeup-extensions' ) );
						}
						break;
				}
				break;

			// Team
			case 'team' :
				switch ( $string ) {
					case 'title' :
						if( $polylang ) {
							return pll__( 'Our Team' );
						} else {
							return tu_ext_tm( 'team_section_title', __( 'Our Team', 'tradeup-extensions' ) );
						}
						break;
					case 'description' :
						if( $polylang ) {
							return pll__( 'This is description field for the Team section. You have to setup this section at Customizer > Homepage Sections > Team Section.' );
						} else {
							return tu_ext_tm( 'team_section_description', __( 'This is description field for the Team section. You have to setup this section at Customizer > Homepage Sections > Team Section.', 'tradeup-extensions' ) );
						}
						break;
				}
				break;

			// Portfolio
			case 'portfolio' :
				switch ( $string ) {
					case 'title' :
						if( $polylang ) {
							return pll__( 'Portfolio' );
						} else {
							return tu_ext_tm( 'portfolio_section_title', __( 'Portfolio', 'tradeup-extensions' ) );
						}
						break;
					case 'description' :
						if( $polylang ) {
							return pll__( 'This is description feild for the Portfolio section. Portfolio content will appear from the Portfolio custom post type post. You can find Portfolio settings at Customizer > Homepage Sections > Portfolio Section.' );
						} else {
							return tu_ext_tm( 'portfolio_section_description', __( 'This is description feild for the Portfolio section. Portfolio content will appear from the Portfolio custom post type post. You can find Portfolio settings at Customizer > Homepage Sections > Portfolio Section.', 'tradeup-extensions' ) );
						}
						break;
					case 'button' :
						if( $polylang ) {
							return pll__( 'View More' );
						} else {
							return tu_ext_tm( 'portfolio_action_btn', __( 'View More', 'tradeup-extensions' ) );
						}
						break;
				}
				break;

			// Testimonials
			case 'testimonials' :
				switch ( $string ) {
					case 'title' :
						if( $polylang ) {
							return pll__( 'Testimonials' );
						} else {
							return tu_ext_tm( 'testimonials_section_title', __( 'Testimonials', 'tradeup-extensions' ) );
						}
						break;
				}
				break;

			// Blog
			case 'blog' :
				switch ( $string ) {
					case 'title' :
						if( $polylang ) {
							return pll__( 'Our Latest Posts' );
						} else {
							return tu_ext_tm( 'blog_section_title', __( 'Our Latest Posts', 'tradeup-extensions' ) );
						}
						break;
					case 'description' :
						if( $polylang ) {
							return pll__( 'This is description field for the Blog section. You can find Blog settings at Customizer > Homepage Sections > Blog Section.' );
						} else {
							return tu_ext_tm( 'blog_section_description', __( 'This is description field for the Blog section. You can find Blog settings at Customizer > Homepage Sections > Blog Section', 'tradeup-extensions' ) );
						}
						break;
					case 'button' :
						if( $polylang ) {
							return pll__( 'View More Blogs' );
						} else {
							return tu_ext_tm( 'blog_action_btn', __( 'View More Blogs', 'tradeup-extensions' ) );
						}
						break;
				}
				break;
		}

	}
}



/*  Get theme mod
/* ------------------------------------ */
if( ! function_exists( 'tu_ext_tm' ) ) {
	/**
	 * Wrapper for get_theme_mod with a filter applied on the default value.
	 *
	 * @since  1.0.4.3
	 * @param  string  $theme_mod Theme modification name.
	 * @param  boolean $default   The default value. If not set, returns false.
	 * @return mixed              Returns theme modification value.
	 */
	function tu_ext_tm( $theme_mod, $default = false ) {
		$def = $default ? apply_filters( 'bx_ext___tm_' . $theme_mod . '_default', $default ) : $default;
		$mod = get_theme_mod( $theme_mod, $def );
		return $mod;
	}
}



/*  Debug mode
/* ------------------------------------ */
if( ! function_exists( 'tu_ext_get_min_suffix' ) ) {
	/**
	 * Add/remove ".min" suffix to scripts/styles based
	 * on SCRIPT_DEBUG or TRADEUP_DEBUG
	 *
	 * @since  1.0.4.3
	 * @return null|string
	 */
	function tu_ext_get_min_suffix() {
		$script_debug = defined( 'SCRIPT_DEBUG' ) && true === SCRIPT_DEBUG ? true : false;
		$tuext_debug  = defined( 'TRADEUP_DEBUG' ) && true === TRADEUP_DEBUG ? true : false;
		return ( $script_debug || $tuext_debug ) ? '' : '.min';
	}
}



/*  Show section
/* ------------------------------------ */
if( ! function_exists( 'tu_ext_show_section' ) ) {
	/**
	 * Show section if it's not hidden or in a shortcode
	 * @since  1.0.4.3
	 * @param  string  $section Section name, for example `contact`.
	 * @param  boolean $echo    Return or echo the value.
	 * @return mixed            Returns boolean if `$echo` is false else `true` or `false` as strings.
	 */
	function tu_ext_show_section( $section, $echo = false ) {
		$var         = $section . '_sec__shortcode';
		$newsections = apply_filters( 'tu_ext_show_section___new', array( 'maps', 'contact' ) );
		$def         = in_array( $section, $newsections ) ? 1 : 0;
		$default     = apply_filters( $section . '_section_hide___def', $def );
		$hide        = tu_ext_tm( $section . '_section_hide', $default ) == 0 ? true : false;
		$shortcode   = get_query_var( $var ) ? true : false;

		if( $echo ) {
			echo ( $hide || $shortcode ) ? 'show' : 'hide';
		} else {
			return ( $hide || $shortcode ) ? true : false;
		}
	}
}



/*  Sanitization
/* ------------------------------------ */
// Sections position
if( ! function_exists( 'tradeup_ext_sanitize_sections_position' ) ) {
	/**
	 * Sanitization function for the sections position theme mod
	 *
	 * @since  1.0.6
	 * @param  array|string $current Current theme mod
	 * @return string                Sections list in a JSON object
	 */
	function tradeup_ext_sanitize_sections_position( $current ) {
		$current = ! is_array( $current ) ? json_decode( $current ) : $current;
	
		return wp_json_encode( array_map( 'sanitize_key', array_unique( $current ) ) );
	}
}

// Textarea with autop
if( ! function_exists( 'tradeup_ext_sanitize_content_filtered' ) ) {
	/**
	 * Sanitzation function allowing wp_kses_post() tags through
	 *
	 * @since  1.0.4.3
	 * @param  string  $content Content to sanitize
	 * @return string           Sanitized content with wp_kses_post()
	 */
	function tradeup_ext_sanitize_content_filtered( $content ) {
		return wp_kses_post( wptexturize( $content ) );
	}
}

/*  Escaping
/* ------------------------------------ */
// Textarea with autop
if( ! function_exists( 'tradeup_ext_escape_content_filtered' ) ) {
	/**
	 * Escape textarea content and allow shortcodes. Also, wpautop the all thing.
	 *
	 * @since  1.0.4.3
	 * @param  string  $content The content that needs escaping
	 * @return string           Escaped content
	 */
	function tradeup_ext_escape_content_filtered( $content ) {
		$new_content = shortcode_unautop( do_shortcode( wpautop( wptexturize( wp_kses_post( $content ) ) ) ) );
		$partials    = apply_filters( 'tradeup_ext_escape_content_filtered___partials', array(
			'<p></p>'    => '',
			'<p><div'    => '<div',
			'</div></p>' => '</div>',
		), $new_content );

		foreach ( $partials as $partial => $change ) {
			$new_content = str_replace( $partial, $change, $new_content );
		}

		return $new_content;
	}
}

// Textarea without wpautop
if( ! function_exists( 'tuext_escape_content_filtered_nonp' ) ) {
	/**
	 * Escape textarea content and allow shortcodes.
	 *
	 * @since  1.0.4.3
	 * @param  string  $content The content that needs escaping
	 * @return string           Escaped content
	 */
	function tuext_escape_content_filtered_nonp( $content ) {
		return shortcode_unautop( do_shortcode( wptexturize( wp_kses_post( $content ) ) ) );
	}
}

// Unfiltered
if( ! function_exists( 'tradeup_ext_escape_unfiltered' ) ) {
	/**
	 * Unfiltered content
	 *
	 * @since  1.0.4.3
	 * @param  string  $content Content to be escaped
	 * @return string           Returns raw content, no escaping applied
	 */
	function tradeup_ext_escape_unfiltered( $content ) {
		return $content;
	}
}



/*  Section Parallax
/* ------------------------------------ */
if( tradeup_extensions_ck_theme_v( '1.0.4', '>=' ) || ! ( 'Tradeup' == tradeup_extensions_theme() ) || ! ( 'Tradeup' == tradeup_extensions_theme( true ) ) ) :
if ( ! function_exists( 'tradeup_section_parallax' ) ) {
	function tradeup_section_parallax( $enabled, $bgimg, $return = false ) {
		$background			= get_theme_mod( $bgimg, '' );
		$parallax			= get_theme_mod( $enabled, false );
		$output				= '';

		if( $bgimg != '' && $parallax ) {
			$output = ' data-parallax="scroll" data-speed="0.5" data-image-src="' . esc_url( $background ) . '" style="background: none !important;"';
		}

		if( $return ) { return $output; } else { echo esc_atttr($output); }
	}
}
endif;



if( tradeup_extensions_ck_theme_v( '1.0.3' ) || ! ( 'Tradeup' == tradeup_extensions_theme() ) || ! ( 'Tradeup' == tradeup_extensions_theme( true ) ) ) : // Backwards compatibility

/*  Slider buttons output
/* ------------------------------------ */
if( ! function_exists( 'tradeup_slider_btns_output' ) ) {
    function tradeup_slider_btns_output( $type = 'btns-2-def-op', $btns_between = ' ', $btn_1_text = '', $btn_1_link = '', $btn_1_target = false, $btn_2_text = '', $btn_2_link = '', $btn_2_target = false ) {
    	$btn_1_text 	= ! empty( $btn_1_text ) ? $btn_1_text : esc_html__( 'Read More #1', 'tradeup-extensions' );
    	$btn_1_link 	= ! empty( $btn_1_link ) ? $btn_1_link : '#';
    	$btn_1_target	= $btn_1_target ? '_blank' : '_self';
    	$btn_2_text 	= ! empty( $btn_2_text ) ? $btn_2_text : esc_html__( 'Read More #2', 'tradeup-extensions' );
    	$btn_2_link 	= ! empty( $btn_2_link ) ? $btn_2_link : '#';
    	$btn_2_target	= $btn_2_target ? '_blank' : '_self';
    	$output = '';

    	switch( $type ) {
    		// One button - default
    		case 'btns-1-default' :
    			$output .= '<a target="' . esc_attr( $btn_1_target ) . '" href="' . esc_url( $btn_1_link ) . '" class="home-btn btn-biggest">' . esc_html( $btn_1_text ) . '</a>';
    		break;

    		// One button - opaque
    		case 'btns-1-opaque' :
    			$output .= '<a target="' . esc_attr( $btn_1_target ) . '" href="' . esc_url( $btn_1_link ) . '" class="home-btn btn-biggest ac-btn-2nd btn-opaque">' . esc_html( $btn_1_text ) . '</a>';
    		break;

    		// One large - default
    		case 'btns-1-l-default' :
    			$output .= '<a target="' . esc_attr( $btn_1_target ) . '" href="' . esc_url( $btn_1_link ) . '" class="home-btn btn-biggest btn-width-50">' . esc_html( $btn_1_text ) . '</a>';
    		break;

    		// One large - opaque
    		case 'btns-1-l-opaque' :
    			$output .= '<a target="' . esc_attr( $btn_1_target ) . '" href="' . esc_url( $btn_1_link ) . '" class="home-btn btn-biggest ac-btn-2nd btn-width-50 btn-opaque">' . esc_html( $btn_1_text ) . '</a>';
    		break;

    		// Two - default
    		case 'btns-2-default' :
    			$output .= '<a target="' . esc_attr( $btn_1_target ) . '" href="' . esc_url( $btn_1_link ) . '" class="home-btn btn-biggest">' . esc_html( $btn_1_text ) . '</a>';
    			if( $btns_between != '' ) {
    				$output .= '<span class="ac-btns-or fw-bolder">' . esc_html( $btns_between ) . '</span>'; }
    			$output .= '<a target="' . esc_attr( $btn_2_target ) . '" href="' . esc_url( $btn_2_link ) . '" class="home-btn btn-biggest">' . esc_html( $btn_2_text ) . '</a>';
    		break;

    		// Two - opaque
    		case 'btns-2-opaque' :
    			$output .= '<a target="' . esc_attr( $btn_1_target ) . '" href="' . esc_url( $btn_1_link ) . '" class="home-btn btn-biggest ac-btn-2nd btn-opaque">' . esc_html( $btn_1_text ) . '</a>';
    			if( $btns_between != '' ) {
    				$output .= '<span class="ac-btns-or fw-bolder">' . esc_html( $btns_between ) . '</span>'; }
    			$output .= '<a target="' . esc_attr( $btn_2_target ) . '" href="' . esc_url( $btn_2_link ) . '" class="home-btn btn-biggest ac-btn-2nd btn-opaque">' . esc_html( $btn_2_text ) . '</a>';
    		break;

    		// Two - default + opaque
    		case 'btns-2-def-op' :
    			$output .= '<a target="' . esc_attr( $btn_1_target ) . '" href="' . esc_url( $btn_1_link ) . '" class="home-btn btn-biggest">' . esc_html( $btn_1_text ) . '</a>';
    			if( $btns_between != '' ) {
    				$output .= '<span class="ac-btns-or fw-bolder">' . esc_html( $btns_between ) . '</span>'; }
    			$output .= '<a target="' . esc_attr( $btn_2_target ) . '" href="' . esc_url( $btn_2_link ) . '" class="home-btn btn-biggest ac-btn-2nd btn-opaque">' . esc_html( $btn_2_text ) . '</a>';
    		break;

    		// Two - opaque + default
    		case 'btns-2-op-def' :
    			$output .= '<a target="' . esc_attr( $btn_1_target ) . '" href="' . esc_url( $btn_1_link ) . '" class="home-btn btn-biggest ac-btn-2nd btn-opaque">' . esc_html( $btn_1_text ) . '</a>';
    			if( $btns_between != '' ) {
    				$output .= '<span class="ac-btns-or fw-bolder">' . esc_html( $btns_between ) . '</span>'; }
    			$output .= '<a target="' . esc_attr( $btn_2_target ) . '" href="' . esc_url( $btn_2_link ) . '" class="home-btn btn-biggest">' . esc_html( $btn_2_text ) . '</a>';
    		break;

    		// Default
    		default : $output .= '';
    	}

    	return apply_filters( 'tradeup_slider___btns_output', $output );

    }
}



/*  Slider buttons options
/* ------------------------------------ */
if( ! function_exists( 'tradeup_slider_btns_select' ) ) {
    function tradeup_slider_btns_select( $just_values = false ) {
    	if( ! $just_values ) {
    		$options = apply_filters( 'tradeup_slider_btns___select', $options = array(
    				array(
    					'value' 	=> 'btns-1-default',
    					'title'		=> esc_html__( 'One - Default', 'tradeup-extensions' ),
    					'disabled'	=> false
    				),
    				array(
    					'value' 	=> 'btns-1-opaque',
    					'title'		=> esc_html__( 'One - Opaque', 'tradeup-extensions' ),
    					'disabled'	=> false
    				),
    				array(
    					'value' 	=> 'btns-1-l-default',
    					'title'		=> esc_html__( 'One Large - Default', 'tradeup-extensions' ),
    					'disabled'	=> false
    				),
    				array(
    					'value' 	=> 'btns-1-l-opaque',
    					'title'		=> esc_html__( 'One Large - Opaque', 'tradeup-extensions' ),
    					'disabled'	=> false
    				),
    				array(
    					'value' 	=> 'btns-2-default',
    					'title'		=> esc_html__( 'Two - Default', 'tradeup-extensions' ),
    					'disabled'	=> false
    				),
    				array(
    					'value' 	=> 'btns-2-opaque',
    					'title'		=> esc_html__( 'Two - Opaque', 'tradeup-extensions' ),
    					'disabled'	=> false
    				),
    				array(
    					'value' 	=> 'btns-2-def-op',
    					'title'		=> esc_html__( 'Two - Default + Opaque', 'tradeup-extensions' ),
    					'disabled'	=> false
    				),
    				array(
    					'value' 	=> 'btns-2-op-def',
    					'title'		=> esc_html__( 'Two - Opaque + Default', 'tradeup-extensions' ),
    					'disabled'	=> false
    				),
    		) );
    	} else {
    		$options = apply_filters( 'tradeup_slider_btns___select_values', $options = array(
    			'btns-1-default', 'btns-1-opaque', 'btns-1-l-default', 'btns-1-l-opaque', 'btns-2-default', 'btns-2-opaque', 'btns-2-def-op', 'btns-2-op-def'
    		) );
    	}

    	return $options;
    }
}
endif; // Backwards compatibility END
