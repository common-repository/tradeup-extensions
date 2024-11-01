<?php
/* ------------------------------------------------------------------------- *
 *
 *  Slider Item
 *  ________________
 *
 *	Adds a "Slide" - background image, title, description, buttons
 *	________________
 *
/* ------------------------------------------------------------------------- */

if( ! class_exists( 'Tradeup_Extensions_Slider_Item' ) ) {
	class Tradeup_Extensions_Slider_Item extends Tradeup_Extensions_Base {

		protected $defaults;


		/*  Constructor
		/* ------------------------------------ */
		function __construct() {

			// Variables
			$this->widget_title = __( 'TU: Slide' , 'tradeup-extensions' );
			$this->widget_id = 'slider';

			// Settings
			$widget_ops = array(
				'classname' => 'sec-slider-slide',
				'description' => esc_html__( 'Adds a "Slide" - background image, title, description, buttons', 'tradeup-extensions' ),
				'customize_selective_refresh' => true
			);

			// Control settings
			$control_ops = array( 'width' => NULL, 'height' => NULL, 'id_base' => 'bx-item-' . $this->widget_id );

			// Create the widget
			parent::__construct( 'bx-item-' . $this->widget_id, $this->widget_title, $widget_ops, $control_ops );

			// Set some widget defaults
			$this->defaults = array (
				'title'			=> '',
				'paragraph'		=> '',
				'btn_show'		=> false,
				'btn_type'		=> 'btns-2-def-op',
				'btn_between'	=> ' ',
				'btn_1_text'	=> esc_html__( 'Read More #1', 'tradeup-extensions' ),
				'btn_1_url'		=> '',
				'btn_1_target'	=> false,
				'btn_2_text'	=> esc_html__( 'Read More #2', 'tradeup-extensions' ),
				'btn_2_url'		=> '',
				'btn_2_target'	=> false,
				'btn_1_bg'		=> apply_filters( 'tradeup_extensions_slider_item___btn_1_bg', '#e91e63' ),
				'btn_1_bgh'		=> apply_filters( 'tradeup_extensions_slider_item___btn_1_bg_hover', '#980336' ),
				'btn_1_bgf'		=> apply_filters( 'tradeup_extensions_slider_item___btn_1_bg_focus', '#980336' ),
				'btn_2_bg'		=> apply_filters( 'tradeup_extensions_slider_item___btn_2_bg', '#1c82bc' ),
				'btn_2_bgo'		=> '0.5',
				'btn_2_bgh'		=> apply_filters( 'tradeup_extensions_slider_item___btn_2_bg_hover', '#1c82bc' ),
				'btn_2_bgf'		=> apply_filters( 'tradeup_extensions_slider_item___btn_2_bg_focus', '#1972a6' ),
				'btn_2_border'	=> apply_filters( 'tradeup_extensions_slider_item___btn_2_border', '#1c82bc' ),
				'background'	=> '',
				'ov_bg_top'		=> apply_filters( 'tradeup_extensions_slider_item___overlay_top', '#05141e' ),
				'ov_op_top'		=> '0.9',
				'ov_bg_bot'		=> apply_filters( 'tradeup_extensions_slider_item___overlay_bot', '#05141e' ),
				'ov_op_bot'		=> '0.1',
				'h2_color'		=> apply_filters( 'tradeup_extensions_slider_item___h2_color', '#ffffff' ),
				'p_color'		=> apply_filters( 'tradeup_extensions_slider_item___p_color', '#ffffff' ),
				'p_opacity'		=> '0.9',
				'text_shadow'	=> '0.7',
			);

		}


		/*  Front-end display
		/* ------------------------------------ */
		public function widget( $args, $instance ) {
			// Turn $args array into variables.
			extract( $args );

			// $instance Defaults
			$instance_defaults = $this->defaults;

			// Parse $instance
			$instance = wp_parse_args( $instance, $instance_defaults );

			// Options
			$title 			= apply_filters( 'widget_title', empty( $instance[ 'title' ] ) ? '' : $instance[ 'title' ], $instance, $this->id_base ); set_query_var( 'title', $title );
			$paragraph		= ! empty( $instance[ 'paragraph' ] ) ? $instance[ 'paragraph' ] : ''; set_query_var( 'paragraph', $paragraph );
			$btn_show		= ! empty( $instance[ 'btn_show' ] ) ? 1 : 0; set_query_var( 'btn_show', $btn_show );
			$btn_type		= ! empty( $instance[ 'btn_type' ] ) ? $instance[ 'btn_type' ] : $instance_defaults[ 'btn_type' ]; set_query_var( 'btn_type', $btn_type );
			$btn_between	= ! empty( $instance[ 'btn_between' ] ) ? $instance[ 'btn_between' ] : ' '; set_query_var( 'btn_between', $btn_between );
			$btn_1_text		= ! empty( $instance[ 'btn_1_text' ] ) ? $instance[ 'btn_1_text' ] : $instance_defaults[ 'btn_1_text' ]; set_query_var( 'btn_1_text', $btn_1_text );
			$btn_1_url		= ! empty( $instance[ 'btn_1_url' ] ) ? $instance[ 'btn_1_url' ] : ''; set_query_var( 'btn_1_url', $btn_1_url );
			$btn_1_target	= ! empty( $instance[ 'btn_1_target' ] ) ? 1 : 0; set_query_var( 'btn_1_target', $btn_1_target );
			$btn_2_text		= ! empty( $instance[ 'btn_2_text' ] ) ? $instance[ 'btn_2_text' ] : $instance_defaults[ 'btn_2_text' ]; set_query_var( 'btn_2_text', $btn_2_text );
			$btn_2_url		= ! empty( $instance[ 'btn_2_url' ] ) ? $instance[ 'btn_2_url' ] : ''; set_query_var( 'btn_2_url', $btn_2_url );
			$btn_2_target	= ! empty( $instance[ 'btn_2_target' ] ) ? 1 : 0; set_query_var( 'btn_2_target', $btn_2_target );
			$background		= ! empty( $instance[ 'background' ] ) ? $instance[ 'background' ] : '';
			$ov_bg_top		= ! empty( $instance[ 'ov_bg_top' ] ) ? $instance[ 'ov_bg_top' ] : $instance_defaults[ 'ov_bg_top' ];
			$ov_bg_bot		= ! empty( $instance[ 'ov_bg_bot' ] ) ? $instance[ 'ov_bg_bot' ] : $instance_defaults[ 'ov_bg_bot' ];
			$ov_op_top		= ! empty( $instance[ 'ov_op_top' ] ) ? $instance[ 'ov_op_top' ] : '0';
			$ov_op_bot		= ! empty( $instance[ 'ov_op_bot' ] ) ? $instance[ 'ov_op_bot' ] : '0';

			// Some variables
			$wid = $this->number; set_query_var( 'wid', $wid );
			$overlay = ' style="
			background: -moz-linear-gradient(to bottom, rgba('. esc_html( tradeup_hex2rgb( $ov_bg_top ) ) .','. esc_html( $ov_op_top ) .') 0%, rgba('. esc_html( tradeup_hex2rgb( $ov_bg_bot ) ) .','. esc_html( $ov_op_bot ) .') 100%);
			background: -webkit-linear-gradient(to bottom, rgba('. esc_html( tradeup_hex2rgb( $ov_bg_top ) ) .','. esc_html( $ov_op_top ) .') 0%, rgba('. esc_html( tradeup_hex2rgb( $ov_bg_bot ) ) .','. esc_html( $ov_op_bot ) .') 100%);
			background: linear-gradient(to bottom, rgba('. esc_html( tradeup_hex2rgb( $ov_bg_top ) ) .','. esc_html( $ov_op_top ) .') 0%, rgba('. esc_html( tradeup_hex2rgb( $ov_bg_bot ) ) .','. esc_html( $ov_op_bot ) .') 100%);"'; set_query_var( 'overlay', $overlay );

			// Add more widget classes
			$css_class = array();
			$css_class[] = '';
			$css_class = apply_filters( 'tradeup_extensions_slider_item___css_classes', $css_class );
			$css_classes = join(' ', $css_class);

			if ( ! empty( $css_classes ) ) {
				if( strpos($args['before_widget'], 'class') === false ) {
					$args[ 'before_widget' ] = str_replace( '>', 'class="'. esc_attr( $css_classes ) . '"', $args[ 'before_widget' ] );
				} else {
					$args[ 'before_widget' ] = str_replace( 'class="', 'class="'. esc_attr( $css_classes ) . ' ', $args[ 'before_widget' ] );
				}
			}

			// Widget template output
			echo $args['before_widget'];

				ob_start();

				tradeup_extensions_get_template_part( 'sections-items/item', 'slider' );

				echo ob_get_clean();

				self::customizer_css( $instance ); // Output styles just for the customizer/selective refresh

			echo $args['after_widget'];

		}


		/*  Update Widget
		/* ------------------------------------ */
		public function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			// Fields
			$instance[ 'title' ] 		= sanitize_text_field( $new_instance[ 'title' ] );
			$instance[ 'paragraph' ] 	= tradeup_ext_sanitize_content_filtered( $new_instance[ 'paragraph' ] );
			$instance[ 'btn_between' ]	= sanitize_text_field( $new_instance[ 'btn_between' ] );
			$instance[ 'btn_1_text' ]	= sanitize_text_field( $new_instance[ 'btn_1_text' ] );
			$instance[ 'btn_1_url' ] 	= esc_url_raw( $new_instance[ 'btn_1_url' ] );
			$instance[ 'btn_1_bg' ]  	= sanitize_hex_color( $new_instance[ 'btn_1_bg' ] );
			$instance[ 'btn_1_bgh' ]  	= sanitize_hex_color( $new_instance[ 'btn_1_bgh' ] );
			$instance[ 'btn_1_bgf' ]  	= sanitize_hex_color( $new_instance[ 'btn_1_bgf' ] );
			$instance[ 'btn_2_bg' ]  	= sanitize_hex_color( $new_instance[ 'btn_2_bg' ] );
			$instance[ 'btn_2_bgh' ]  	= sanitize_hex_color( $new_instance[ 'btn_2_bgh' ] );
			$instance[ 'btn_2_bgf' ]  	= sanitize_hex_color( $new_instance[ 'btn_2_bgf' ] );
			$instance[ 'btn_2_border' ] = sanitize_hex_color( $new_instance[ 'btn_2_border' ] );
			$instance[ 'btn_2_text' ]	= sanitize_text_field( $new_instance[ 'btn_2_text' ] );
			$instance[ 'btn_2_url' ] 	= esc_url_raw( $new_instance[ 'btn_2_url' ] );
			$instance[ 'background' ] 	= esc_url_raw( $new_instance[ 'background' ] );
			$instance[ 'ov_bg_top' ]  	= sanitize_hex_color( $new_instance[ 'ov_bg_top' ] );
			$instance[ 'ov_bg_bot' ]  	= sanitize_hex_color( $new_instance[ 'ov_bg_bot' ] );
			$instance[ 'h2_color' ]  	= sanitize_hex_color( $new_instance[ 'h2_color' ] );
			$instance[ 'p_color' ]  	= sanitize_hex_color( $new_instance[ 'p_color' ] );

			// Select
			$instance[ 'btn_type' ]		= tradeup_sanitize_select( $new_instance[ 'btn_type' ], tradeup_slider_btns_select( true ), $this->defaults[ 'btn_type' ], false  );
			$instance[ 'btn_2_bgo' ]	= tradeup_sanitize_select( $new_instance[ 'btn_2_bgo' ], tradeup_opacity_options( false, true ), $this->defaults[ 'btn_2_bgo' ], false  );
			$instance[ 'ov_op_top' ]	= tradeup_sanitize_select( $new_instance[ 'ov_op_top' ], tradeup_opacity_options( false, true ), $this->defaults[ 'ov_op_top' ], false  );
			$instance[ 'ov_op_bot' ]	= tradeup_sanitize_select( $new_instance[ 'ov_op_bot' ], tradeup_opacity_options( false, true ), $this->defaults[ 'ov_op_bot' ], false  );
			$instance[ 'p_opacity' ]	= tradeup_sanitize_select( $new_instance[ 'p_opacity' ], tradeup_opacity_options( false, true ), $this->defaults[ 'p_opacity' ], false  );
			$instance[ 'text_shadow' ]	= tradeup_sanitize_select( $new_instance[ 'text_shadow' ], tradeup_opacity_options( false, true ), $this->defaults[ 'text_shadow' ], false  );

			// Checkboxes
			$instance[ 'btn_show' ]		= ! empty( $new_instance[ 'btn_show' ] ) ? 1 : 0;
			$instance[ 'btn_1_target' ]	= ! empty( $new_instance[ 'btn_1_target' ] ) ? 1 : 0;
			$instance[ 'btn_2_target' ]	= ! empty( $new_instance[ 'btn_2_target' ] ) ? 1 : 0;

			// Return
			return $instance;
		}


		/*  Widget's Form
		/* ------------------------------------ */
		public function form( $instance ) {
			// Parse $instance
			$instance_defaults = $this->defaults;
			$instance = wp_parse_args( $instance, $instance_defaults );
			extract( $instance, EXTR_SKIP );

			// Variables
			$title 			= $instance[ 'title' ];
			$paragraph		= $instance[ 'paragraph' ];
			$btn_show 		= isset( $instance[ 'btn_show' ] ) ? (bool) $instance[ 'btn_show' ] : false;
			$btn_type		= $instance[ 'btn_type' ];
			$btn_between	= $instance[ 'btn_between' ];
			$btn_1_text		= $instance[ 'btn_1_text' ];
			$btn_1_url		= $instance[ 'btn_1_url' ];
			$btn_1_target 	= isset( $instance[ 'btn_1_target' ] ) ? (bool) $instance[ 'btn_1_target' ] : false;
			$btn_1_bg 		= $instance[ 'btn_1_bg' ];
			$btn_1_bgh 		= $instance[ 'btn_1_bgh' ];
			$btn_1_bgf 		= $instance[ 'btn_1_bgf' ];
			$btn_2_bg		= $instance[ 'btn_2_bg' ];
			$btn_2_bgh		= $instance[ 'btn_2_bgh' ];
			$btn_2_bgf		= $instance[ 'btn_2_bgf' ];
			$btn_2_border	= $instance[ 'btn_2_border' ];
			$btn_2_bgo		= $instance[ 'btn_2_bgo' ];
			$btn_2_text		= $instance[ 'btn_2_text' ];
			$btn_2_url		= $instance[ 'btn_2_url' ];
			$btn_2_target 	= isset( $instance[ 'btn_2_target' ] ) ? (bool) $instance[ 'btn_2_target' ] : false;
			$background 	= $instance[ 'background' ];
			$ov_bg_top		= $instance[ 'ov_bg_top' ];
			$ov_bg_bot		= $instance[ 'ov_bg_bot' ];
			$ov_op_top		= $instance[ 'ov_op_top' ];
			$ov_op_bot		= $instance[ 'ov_op_bot' ];
			$h2_color		= $instance[ 'h2_color' ];
			$p_color		= $instance[ 'p_color' ];
			$p_opacity		= $instance[ 'p_opacity' ];
			$text_shadow	= $instance[ 'text_shadow' ];


			// Form output

			/* Title */
			parent::text_input( $title, 'title', __( 'Heading:', 'tradeup-extensions' ) );

			/* Paragraph */
			parent::text_area( $paragraph, 'paragraph', __( 'Paragraph:', 'tradeup-extensions' ), '', '' );

			/* Tabs */
			?>
            <div class="tu-widget-tabs tu-bs">

            	<div class="tu-wt-tab-wrap tu-bs">
                    <a href="#" class="tu-wt-tab-toggle tu-bs"><?php _e( 'Background', 'tradeup-extensions' ); ?></a>
                    <div class="tu-wt-tab-contents tu-bs">
                    	<br />
                    	<?php
							/* Background upload */
							parent::select_image( $background, 'background', '', __( 'Background image:', 'tradeup-extensions' ), __( 'Suggested size: 1920x1080px; Format: JPG, optimized;', 'tradeup-extensions' ) );

							/* Background color - top */
							parent::color_picker(
								$ov_bg_top, 'ov_bg_top', $this->defaults[ 'ov_bg_top' ],
								__( 'Overlay color - top:', 'tradeup-extensions' ), '' );

							/* Background opacity - top */
							parent::select_type( $ov_op_top, 'ov_op_top', tradeup_opacity_options( true ), __( 'Overlay opacity - top:', 'tradeup-extensions' ) );

							/* Background color - bottom */
							parent::color_picker(
								$ov_bg_bot, 'ov_bg_bot', $this->defaults[ 'ov_bg_bot' ],
								__( 'Overlay color - bottom:', 'tradeup-extensions' ), '' );
							/* Background opacity - top */
							parent::select_type( $ov_op_bot, 'ov_op_bot', tradeup_opacity_options( true ), __( 'Overlay opacity - bottom:', 'tradeup-extensions' ) );
						?>
                    </div>
                </div>

                <div class="tu-wt-tab-wrap tu-bs">
                    <a href="#" class="tu-wt-tab-toggle tu-bs"><?php _e( 'Buttons', 'tradeup-extensions' ); ?></a>
                    <div class="tu-wt-tab-contents tu-bs">
                    	<?php
							/* Show buttons */
							parent::check_box( $btn_show, 'btn_show', __( 'Display buttons', 'tradeup-extensions' ) );

							/* Select buttons type */
							parent::select_type( $btn_type, 'btn_type', tradeup_slider_btns_select(), __( 'Buttons template:', 'tradeup-extensions' ) );

							/* Between text */
							parent::text_input( $btn_between, 'btn_between', __( 'Between buttons:', 'tradeup-extensions' ) );

							?><span class="tu-wt-tab-clear nm"></span><?php

							/* Button #1 text */
							parent::text_input( $btn_1_text, 'btn_1_text', __( 'Button #1 text:', 'tradeup-extensions' ) );

							/* Button #1 url */
							parent::text_input( $btn_1_url, 'btn_1_url', __( 'Button #1 url:', 'tradeup-extensions' ), 'url' );

							/* Button #1 target */
							parent::check_box( $btn_1_target, 'btn_1_target', __( 'Open in a new window #1', 'tradeup-extensions' ) );

							?><span class="tu-wt-tab-clear nm"></span><?php

							/* Button #2 text */
							parent::text_input( $btn_2_text, 'btn_2_text', __( 'Button #2 text:', 'tradeup-extensions' ) );

							/* Button #2 url */
							parent::text_input( $btn_2_url, 'btn_2_url', __( 'Button #2 url:', 'tradeup-extensions' ), 'url' );

							/* Button #2 target */
							parent::check_box( $btn_2_target, 'btn_2_target', __( 'Open in a new window #2', 'tradeup-extensions' ) );
						?>
                    </div>
                </div>

                <div class="tu-wt-tab-wrap tu-bs">
                    <a href="#" class="tu-wt-tab-toggle tu-bs"><?php _e( 'Normal button colors', 'tradeup-extensions' ); ?></a>
                    <div class="tu-wt-tab-contents tu-bs">
                    	<?php
							/* Buttone #1 background color */
							parent::color_picker(
								$btn_1_bg, 'btn_1_bg', $this->defaults[ 'btn_1_bg' ],
								__( 'Background color:', 'tradeup-extensions' ), '' );

							/* Buttone #1 :hover background color */
							parent::color_picker(
								$btn_1_bgh, 'btn_1_bgh', $this->defaults[ 'btn_1_bgh' ],
								__( 'Hover state:', 'tradeup-extensions' ), '' );

							/* Buttone #1 :focus background color */
							parent::color_picker(
								$btn_1_bgf, 'btn_1_bgf', $this->defaults[ 'btn_1_bgf' ],
								__( 'Focus state:', 'tradeup-extensions' ), '' );
						?>
                    </div>
                </div>

                <div class="tu-wt-tab-wrap tu-bs">
                    <a href="#" class="tu-wt-tab-toggle tu-bs"><?php _e( 'Opaque button colors', 'tradeup-extensions' ); ?></a>
                    <div class="tu-wt-tab-contents tu-bs">
                    	<?php
							/* Buttone #2 background color */
							parent::color_picker(
								$btn_2_bg, 'btn_2_bg', $this->defaults[ 'btn_2_bg' ],
								__( 'Background color:', 'tradeup-extensions' ), '' );

							/* Buttone #2 border color */
							parent::color_picker(
								$btn_2_border, 'btn_2_border', $this->defaults[ 'btn_2_border' ],
								__( 'Border color:', 'tradeup-extensions' ), '' );

							/* Background opacity - top */
							parent::select_type( $btn_2_bgo, 'btn_2_bgo', tradeup_opacity_options( true ), __( 'Opacity:', 'tradeup-extensions' ) );

							/* Buttone #2 :hover background color */
							parent::color_picker(
								$btn_2_bgh, 'btn_2_bgh', $this->defaults[ 'btn_2_bgh' ],
								__( 'Hover state:', 'tradeup-extensions' ), '' );

							/* Buttone #2 :focus background color */
							parent::color_picker(
								$btn_2_bgf, 'btn_2_bgf', $this->defaults[ 'btn_2_bgf' ],
								__( 'Focus state:', 'tradeup-extensions' ), '' );
						?>
                    </div>
                </div>

                <div class="tu-wt-tab-wrap tu-bs">
                    <a href="#" class="tu-wt-tab-toggle tu-bs"><?php _e( 'Other colors', 'tradeup-extensions' ); ?></a>
                    <div class="tu-wt-tab-contents tu-bs">
                    	<?php
							/* Heading color */
							parent::color_picker(
								$h2_color, 'h2_color', $this->defaults[ 'h2_color' ],
								__( 'Heading color:', 'tradeup-extensions' ), '' );

							/* Text color */
							parent::color_picker(
								$p_color, 'p_color', $this->defaults[ 'p_color' ],
								__( 'Text color:', 'tradeup-extensions' ), '' );

							/* Text opacity */
							parent::select_type( $p_opacity, 'p_opacity', tradeup_opacity_options( true ), __( 'Text opacity:', 'tradeup-extensions' ) );

							/* Text shadow */
							parent::select_type( $text_shadow, 'text_shadow', tradeup_opacity_options( true ), __( 'Text shadow:', 'tradeup-extensions' ) );
						?>
                    </div>
                </div>

			</div><!-- Tabs -->
            <?php

		}


		/*  Customizer CSS
		/* ------------------------------------ */
		private function customizer_css( $instance ) {
			// Parse $instance
			$instance_defaults = $this->defaults;
			$instance = wp_parse_args( $instance, $instance_defaults );
			extract( $instance, EXTR_SKIP );

			// Variables
			$wid = esc_html( '#' . $this->id );
			$background = $instance[ 'background' ];
			$background_default = $this->defaults[ 'background' ];
			$btn_1_bg = $instance[ 'btn_1_bg' ];
			$btn_1_bg_default = $this->defaults[ 'btn_1_bg' ];
			$btn_1_bgh = $instance[ 'btn_1_bgh' ];
			$btn_1_bgh_default = $this->defaults[ 'btn_1_bgh' ];
			$btn_1_bgf = $instance[ 'btn_1_bgf' ];
			$btn_1_bgf_default = $this->defaults[ 'btn_1_bgf' ];
			$btn_2_bg = $instance[ 'btn_2_bg' ];
			$btn_2_bg_default = $this->defaults[ 'btn_2_bg' ];
			$btn_2_bgh = $instance[ 'btn_2_bgh' ];
			$btn_2_bgh_default = $this->defaults[ 'btn_2_bgh' ];
			$btn_2_bgf = $instance[ 'btn_2_bgf' ];
			$btn_2_bgf_default = $this->defaults[ 'btn_2_bgf' ];
			$btn_2_border = $instance[ 'btn_2_border' ];
			$btn_2_border_default = $this->defaults[ 'btn_2_border' ];
			$btn_2_bgo = $instance[ 'btn_2_bgo' ];
			$btn_2_bgo_default = $this->defaults[ 'btn_2_bgo' ];
			$h2_color = $instance[ 'h2_color' ];
			$h2_color_default = $this->defaults[ 'h2_color' ];
			$p_color = $instance[ 'p_color' ];
			$p_color_default = $this->defaults[ 'p_color' ];
			$p_opacity = $instance[ 'p_opacity' ];
			$p_opacity_default = $this->defaults[ 'p_opacity' ];
			$text_shadow = $instance[ 'text_shadow' ];
			$text_shadow_default = $this->defaults[ 'text_shadow' ];

			$custom_css = '';

			// Style Output
			if ( is_customize_preview() ) {

				$custom_css .= '<style type="text/css">';

					if( parent::cd( $background, $background_default ) ) {
					$custom_css .= $wid . ' { background-image: url("' . esc_url( $background ) . '"); }'; }

					if( parent::cd( $btn_1_bg, $btn_1_bg_default ) ) {
					$custom_css .= $wid . ' .home-btn { background-color: ' . sanitize_hex_color( $btn_1_bg ) . '; }'; }

					if( parent::cd( $btn_1_bgh, $btn_1_bgh_default ) ) {
					$custom_css .= $wid . ' .home-btn:hover { background-color: ' . sanitize_hex_color( $btn_1_bgh ) . '; }'; }

					if( parent::cd( $btn_1_bgf, $btn_1_bgf_default ) ) {
					$custom_css .= $wid . ' .home-btn:focus { background-color: ' . sanitize_hex_color( $btn_1_bgf ) . '; }'; }

					if( parent::cd( $btn_2_bg, $btn_2_bg_default ) || parent::cd( $btn_2_bgo, $btn_2_bgo_default ) ) {
					$custom_css .= $wid . ' .ac-btn-2nd { background-color: rgba(' . esc_html( tradeup_hex2rgb( $btn_2_bg ) ) . ',' . esc_html( $btn_2_bgo ) . '); }'; }

					if( parent::cd( $btn_2_bgh, $btn_2_bgh_default ) ) {
					$custom_css .= $wid . ' .ac-btn-2nd:hover { background-color: ' . sanitize_hex_color( $btn_2_bgh ) . '; }'; }

					if( parent::cd( $btn_2_bgf, $btn_2_bgf_default ) ) {
					$custom_css .= $wid . ' .ac-btn-2nd:focus { background-color: ' . sanitize_hex_color( $btn_2_bgf ) . '; }'; }

					if( parent::cd( $btn_2_border, $btn_2_border_default ) ) {
					$custom_css .= $wid . ' .ac-btn-2nd { box-shadow: inset 0 0 0 3px rgba(' . esc_html( tradeup_hex2rgb( $btn_2_border ) ) . ',1); }'; }

					if( parent::cd( $h2_color, $h2_color_default ) ) {
					$custom_css .= $wid . ' .sec-hs-elements .hs-primary-large { color: ' . esc_html( $h2_color ) . '; }'; }

					if( parent::cd( $p_color, $p_color_default ) ) {
					$custom_css .= $wid . ' .sec-hs-elements .sec-hs-description, ' . $wid . ' .sec-hs-elements .ac-btns-or  { color: ' . esc_html( $p_color ) . '; }'; }

					if( parent::cd( $p_opacity, $p_opacity_default ) ) {
					$custom_css .= $wid . ' .sec-hs-elements .sec-hs-description, ' . $wid . ' .sec-hs-elements .ac-btns-or  { opacity: ' . esc_html( $p_opacity ) . '; }'; }

					if( parent::cd( $text_shadow, $text_shadow_default ) ) {
					$custom_css .= $wid . ' .sec-hs-elements .hs-primary-large, ' . $wid . ' .sec-hs-elements .sec-hs-description, ' . $wid . ' .sec-hs-elements .ac-btns-or { text-shadow: 0 1px 2px rgba(0,0,0,' . esc_html( $text_shadow ) . '); }'; }

				$custom_css .= '</style>';

				_e($custom_css);
			}

		}


	} // Tradeup_Extensions_Slider_Item .END

	// Register this widget
	register_widget( 'Tradeup_Extensions_Slider_Item' );

}
