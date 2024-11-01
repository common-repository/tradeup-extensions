<?php
/* ------------------------------------------------------------------------- *
 *  Output styles generated/saved by sections
/* ------------------------------------------------------------------------- */


/*  Check default
/* ------------------------------------ */
if ( ! function_exists( 'tradeup_cdefault' ) ) {
	function tradeup_cdefault( $option, $default ) {
		if( isset( $option ) && $option != '' && $option != $default ) {
			return true;
		}
	}
}


/*  Features section
/* ------------------------------------ */
if ( ! function_exists( 'tradeup_features_css_output' ) ) {
	function tradeup_features_css_output() {
		
		$disabled = get_theme_mod( 'features_section_hide', false );
		$widget = get_option( 'widget_bx-item-features' );
			unset( $widget['_multiwidget'] );
			
		if( ! $disabled ) {
			if ( count( $widget ) >= 1 ) {
				
				$custom_css = '';
				$default = apply_filters( 'tradeup_extensions_features_item___color', '#e91e63' );
				
				foreach( $widget as $widgetID => $value ) {
					$color = array_key_exists( 'color', $value ) ? $value['color'] : '';
					if( tradeup_cdefault( $color, $default ) ) {
						$wid = '#bx-item-features-' . $widgetID;
						$custom_css .= $wid . ' .ac-btn-alt{border-color:' . tradeup_sanitize_hex( $color ) . ';}';
						$custom_css .= $wid . ' .sec-feature-figure i{border-color:' . tradeup_sanitize_hex( $color ) . '; color:' . tradeup_sanitize_hex( $color ) . ';}';
						$custom_css .= $wid . ' a:not(.ac-btn-alt),' . $wid . ' a:not(.ac-btn-alt):hover,' . $wid . ' a:not(.ac-btn-alt):focus,' . $wid . ' a:not(.ac-btn-alt):active{color:' . tradeup_sanitize_hex( $color ) . ';}';
					}
				}
				
				if( ! is_customize_preview() ) {
					wp_add_inline_style( 'tradeup-style', tradeup_sanitize_css( $custom_css ) ); } 			
			}
		}
		
	}
}
add_action( 'wp_enqueue_scripts', 'tradeup_features_css_output', 100 );


/*  Call to Action
/* ------------------------------------ */
if ( ! function_exists( 'tradeup_actions_css_output' ) ) {
	function tradeup_actions_css_output() {
		
		$disabled = get_theme_mod( 'actions_section_hide', false );
		$widget = get_option( 'widget_bx-item-actions' );
			unset( $widget['_multiwidget'] );
		
		if( ! $disabled ) {
			if ( count( $widget ) >= 1 ) {
				
				$custom_css = '';
				$btn_1_bg_def 			= apply_filters( 'tradeup_extensions_actions_item___btn1bg', '#e91e63' );
				$btn_1_hover_def 		= apply_filters( 'tradeup_extensions_actions_item___btn1hover', '#980336' );
				$btn_1_active_def 		= apply_filters( 'tradeup_extensions_actions_item___btn1active', '#980336' );
				$btn_2_bg_def 			= apply_filters( 'tradeup_extensions_actions_item___btn2bg', '#e91e63' );
				$btn_2_hover_def 		= apply_filters( 'tradeup_extensions_actions_item___btn2hover', '#980336' );
				$btn_2_active_def 		= apply_filters( 'tradeup_extensions_actions_item___btn2active', '#980336' );
				$title_color_def		= apply_filters( 'tradeup_extensions_actions_item___titlecolor', '#ffffff' );
				$links_color_def		= apply_filters( 'tradeup_extensions_actions_item___linkscolor', '#ffeb3b' );
				$excerpt_color_def		= apply_filters( 'tradeup_extensions_actions_item___excerptcolor', '#ffffff' );
				$background_color_def	= apply_filters( 'tradeup_extensions_actions_item___backgroundcolor', '#df3034' );
				$background_image_def	= '';
				$overlay_color_def		= apply_filters( 'tradeup_extensions_actions_item___overlaycolor', '#000000' );
				$parallax_def			= false;
				
				foreach( $widget as $widgetID => $value ) {
					$wid = '#bx-item-actions-' . $widgetID; 
					
					$btn_1_bg = array_key_exists( 'btn_1_bg', $value ) ? $value['btn_1_bg'] : '';
					$btn_1_hover = array_key_exists( 'btn_1_hover', $value ) ? $value['btn_1_hover'] : '';
					$btn_1_active = array_key_exists( 'btn_1_active', $value ) ? $value['btn_1_active'] : '';
					$btn_2_bg = array_key_exists( 'btn_2_bg', $value ) ? $value['btn_2_bg'] : '';
					$btn_2_hover = array_key_exists( 'btn_2_hover', $value ) ? $value['btn_2_hover'] : '';
					$btn_2_active = array_key_exists( 'btn_2_active', $value ) ? $value['btn_2_active'] : '';
					$title_color = array_key_exists( 'title_color', $value ) ? $value['title_color'] : '';
					$excerpt_color = array_key_exists( 'excerpt_color', $value ) ? $value['excerpt_color'] : '';
					$links_color = array_key_exists( 'links_color', $value ) ? $value['links_color'] : '';
					$background_color = array_key_exists( 'background_color', $value ) ? $value['background_color'] : '';
					$background_image = array_key_exists( 'background_image', $value ) ? $value['background_image'] : '';
					$overlay_color = array_key_exists( 'overlay_color', $value ) ? $value['overlay_color'] : '';
					$parallax = array_key_exists( 'parallax', $value ) ? $value['parallax'] : '';

					// Background
					if( ! $parallax ) {
						if( tradeup_cdefault( $background_color, $background_color_def ) ) {
							$custom_css .= $wid . '{background-color:' . tradeup_sanitize_hex( $background_color ) . '}'; }
						if( tradeup_cdefault( $background_image, $background_image_def ) ) {
							$custom_css .= $wid . '{background-image:url("' . esc_url( $background_image ) . '")}'; }
					} else {
						$custom_css .= $wid . '{background-color:transparent!important;}'; }
					if( tradeup_cdefault( $overlay_color, $overlay_color_def ) ) {
						$custom_css .= $wid . ' .grid-overlay {background-color:' . tradeup_sanitize_hex( $overlay_color ) . '}'; }
						
					// Heading + text
					if( tradeup_cdefault( $excerpt_color, $excerpt_color_def ) ) {
						$custom_css .= $wid . '{color:' . tradeup_sanitize_hex( $excerpt_color ) . '}'; }
					if( tradeup_cdefault( $title_color, $title_color_def ) ) {
						$custom_css .= $wid . ' h2{color:' . tradeup_sanitize_hex( $title_color ) . '}'; }
					if( tradeup_cdefault( $links_color, $links_color_def ) ) {
						$custom_css .= $wid . ' a:not(.ac-btn), ' . $wid . ' a:not(.ac-btn):hover, ' . $wid . ' a:not(.ac-btn):focus, ' . $wid . ' a:not(.ac-btn):active { color: ' . tradeup_sanitize_hex( $links_color ) . ' }'; }
						
					// Button #1
					if( tradeup_cdefault( $btn_1_bg, $btn_1_bg_def ) ) {
						$custom_css .= $wid . ' .btn-1{background-color:' . tradeup_sanitize_hex( $btn_1_bg ) . '}'; }
					if( tradeup_cdefault( $btn_1_hover, $btn_1_hover_def ) ) {
						$custom_css .= $wid . ' .btn-1:hover{background-color:' . tradeup_sanitize_hex( $btn_1_hover ) . '}'; }
					if( tradeup_cdefault( $btn_1_active, $btn_1_active_def ) ) {
						$custom_css .= $wid . ' .btn-1:focus,' .$wid . ' .btn-1:active{background-color:' . tradeup_sanitize_hex( $btn_1_active ) . '}'; }
					
					// Button #2	
					if( tradeup_cdefault( $btn_2_bg, $btn_2_bg_def ) ) {
						$custom_css .= $wid . ' .btn-2{background-color:' . tradeup_sanitize_hex( $btn_2_bg ) . '}'; }
					if( tradeup_cdefault( $btn_2_hover, $btn_2_hover_def ) ) {
						$custom_css .= $wid . ' .btn-2:hover{background-color:' . tradeup_sanitize_hex( $btn_2_hover ) . '}'; }
					if( tradeup_cdefault( $btn_2_active, $btn_2_active_def ) ) {
						$custom_css .= $wid . ' .btn-2:focus,' . $wid . ' .btn-2:active{background-color:' . tradeup_sanitize_hex( $btn_2_active ) . '}'; }
						
				}
				
				if( ! is_customize_preview() ) {
				wp_add_inline_style( 'tradeup-style', tradeup_sanitize_css( $custom_css ) ); }
			
			}
		}
		
	}
}
add_action( 'wp_enqueue_scripts', 'tradeup_actions_css_output', 100 );

/*  Slider section
/* ------------------------------------ */
if ( ! function_exists( 'tradeup_slider_css_output' ) ) {
	function tradeup_slider_css_output() {
		
		$disabled = get_theme_mod( 'slider_section_hide', false );
		$widget = get_option( 'widget_bx-item-slider' );
			unset( $widget['_multiwidget'] );
		
		if( ! $disabled ) {
			if ( count( $widget ) >= 1 ) {

				$custom_css = '';
				$background_def 		= '';
				$btn_1_bg_def			= apply_filters( 'tradeup_extensions_slider_item___btn_1_bg', '#e91e63' );
				$btn_1_bgh_def			= apply_filters( 'tradeup_extensions_slider_item___btn_1_bg_hover', '#980336' );
				$btn_1_bgf_def			= apply_filters( 'tradeup_extensions_slider_item___btn_1_bg_focus', '#980336' );
				$btn_2_bg_def			= apply_filters( 'tradeup_extensions_slider_item___btn_2_bg', '#1c82bc' );
				$btn_2_bgh_def			= apply_filters( 'tradeup_extensions_slider_item___btn_2_bg_hover', '#1c82bc' );
				$btn_2_bgf_def			= apply_filters( 'tradeup_extensions_slider_item___btn_2_bg_focus', '#1972a6' );
				$btn_2_border_def		= apply_filters( 'tradeup_extensions_slider_item___btn_2_border', '#1c82bc' );
				$btn_2_bgo_def			= '0.5';
				$h2_color_def			= apply_filters( 'tradeup_extensions_slider_item___h2_color', '#ffffff' );
				$p_color_def			= apply_filters( 'tradeup_extensions_slider_item___p_color', '#ffffff' );
				$p_opacity_def			= '0.9';
				$text_shadow_def		= '0.7';

				foreach( $widget as $widgetID => $value ) {
					$wid = '#bx-item-slider-' . $widgetID; 
					
					$background 		= array_key_exists( 'background', $value ) ? $value['background'] : '';
					$btn_1_bg			= array_key_exists( 'btn_1_bg', $value ) ? $value['btn_1_bg'] : '';
					$btn_1_bgh			= array_key_exists( 'btn_1_bgh', $value ) ? $value['btn_1_bgh'] : '';
					$btn_1_bgf			= array_key_exists( 'btn_1_bgf', $value ) ? $value['btn_1_bgf'] : '';
					$btn_2_bg			= array_key_exists( 'btn_2_bg', $value ) ? $value['btn_2_bg'] : '';
					$btn_2_bgh			= array_key_exists( 'btn_2_bgh', $value ) ? $value['btn_2_bgh'] : '';
					$btn_2_bgf			= array_key_exists( 'btn_2_bgf', $value ) ? $value['btn_2_bgf'] : '';
					$btn_2_border		= array_key_exists( 'btn_2_border', $value ) ? $value['btn_2_border'] : '';
					$btn_2_bgo			= array_key_exists( 'btn_2_bgo', $value ) ? $value['btn_2_bgo'] : '';
					$h2_color			= array_key_exists( 'h2_color', $value ) ? $value['h2_color'] : '';
					$p_color			= array_key_exists( 'p_color', $value ) ? $value['p_color'] : '';
					$p_opacity			= array_key_exists( 'p_opacity', $value ) ? $value['p_opacity'] : '';
					$text_shadow		= array_key_exists( 'text_shadow', $value ) ? $value['text_shadow'] : '';
						
					// Slide background image
					if( tradeup_cdefault( $background, $background_def ) ) {
					$custom_css .= $wid . ' { background-image: url("' . esc_url( $background ) . '"); }'; }
					
					//print_r($custom_css);die;

					// Button #1 options
					if( tradeup_cdefault( $btn_1_bg, $btn_1_bg_def ) ) {
					$custom_css .= $wid . ' .home-btn { background-color: ' . tradeup_sanitize_hex( $btn_1_bg ) . '; }'; }
					if( tradeup_cdefault( $btn_1_bgh, $btn_1_bgh_def ) ) {
					$custom_css .= $wid . ' .home-btn:hover { background-color: ' . tradeup_sanitize_hex( $btn_1_bgh ) . '; }'; }
					if( tradeup_cdefault( $btn_1_bgf, $btn_1_bgf_def ) ) {
					$custom_css .= $wid . ' .home-btn:focus, ' . $wid . ' .ac-btn-1st:active { background-color: ' . tradeup_sanitize_hex( $btn_1_bgf ) . '; }'; }
					
					// Button #2 options
					if( tradeup_cdefault( $btn_2_bg, $btn_2_bg_def ) || tradeup_cdefault( $btn_2_bgo, $btn_2_bgo_def ) ) {
					$custom_css .= $wid . ' .ac-btn-2nd { background-color: rgba(' . esc_html( tradeup_hex2rgb( $btn_2_bg ) ) . ',' . esc_html( $btn_2_bgo ) . '); }'; }
					if( tradeup_cdefault( $btn_2_bgh, $btn_2_bgh_def ) ) {
					$custom_css .= $wid . ' .ac-btn-2nd:hover { background-color: ' . tradeup_sanitize_hex( $btn_2_bgh ) . '; }'; }
					if( tradeup_cdefault( $btn_2_bgf, $btn_2_bgf_def ) ) {
					$custom_css .= $wid . ' .ac-btn-2nd:focus, ' . $wid . ' .ac-btn-2nd:active { background-color: ' . tradeup_sanitize_hex( $btn_2_bgf ) . '; }'; }
					if( tradeup_cdefault( $btn_2_border, $btn_2_border_def ) ) {
					$custom_css .= $wid . ' .ac-btn-2nd { box-shadow: inset 0 0 0 3px rgba(' . esc_html( tradeup_hex2rgb( $btn_2_border ) ) . ',1); }'; }
					
					// Other options
					if( tradeup_cdefault( $h2_color, $h2_color_def ) ) {
					$custom_css .= $wid . ' .sec-hs-elements .hs-primary-large { color: ' . esc_html( $h2_color ) . '; }'; }
					if( tradeup_cdefault( $p_color, $p_color_def ) ) {
					$custom_css .= $wid . ' .sec-hs-elements .sec-hs-description, ' . $wid . ' .sec-hs-elements .ac-btns-or  { color: ' . esc_html( $p_color ) . '; }'; }
					if( tradeup_cdefault( $p_opacity, $p_opacity_def ) ) {
					$custom_css .= $wid . ' .sec-hs-elements .sec-hs-description, ' . $wid . ' .sec-hs-elements .ac-btns-or  { opacity: ' . esc_html( $p_opacity ) . '; }'; }
					if( tradeup_cdefault( $text_shadow, $text_shadow_def ) ) {
					$custom_css .= $wid . ' .sec-hs-elements .hs-primary-large, ' . $wid . ' .sec-hs-elements .sec-hs-description, ' . $wid . ' .sec-hs-elements .ac-btns-or { text-shadow: 0 1px 2px rgba(0,0,0,' . esc_html( $text_shadow ) . '); }'; }
		
				}
				
				if( ! is_customize_preview() ) {
				wp_add_inline_style( 'tradeup-style', tradeup_sanitize_css( $custom_css ) ); }
			
			}
		}
		
	}
}
add_action( 'wp_enqueue_scripts', 'tradeup_slider_css_output', 100 );