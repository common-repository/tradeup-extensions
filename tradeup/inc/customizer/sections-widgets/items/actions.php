<?php
/* ------------------------------------------------------------------------- *
 *
 *  Actions Item
 *  ________________
 *
 *	Adds an "Action" - title, excerpt, image and an action button
 *	________________
 *
/* ------------------------------------------------------------------------- */

if( ! class_exists( 'Tradeup_Extensions_Actions_Item' ) ) {
	class Tradeup_Extensions_Actions_Item extends Tradeup_Extensions_Base {

		protected $defaults;
		protected $allowed_html = array(
			'a' => array(
				'href' => array(),
				'title' => array()
			),
			'em' => array(),
			'strong' => array(),
			'p' => array(),
		);


		/*  Constructor
		/* ------------------------------------ */
		function __construct() {

			// Variables
			$this->widget_title = __( 'TU: Call to Action' , 'tradeup-extensions' );
			$this->widget_id = 'actions';

			// Settings
			$widget_ops = array(
				'classname' => 'sec-action',
				'description' => esc_html__( 'Adds an "Action" - title, excerpt, image and an action button', 'tradeup-extensions' ),
				'customize_selective_refresh' => true
			);

			// Control settings
			$control_ops = array( 'width' => NULL, 'height' => NULL, 'id_base' => 'bx-item-' . $this->widget_id );

			// Create the widget
			parent::__construct( 'bx-item-' . $this->widget_id, $this->widget_title, $widget_ops, $control_ops );

			// Set some widget defaults
			$this->defaults = array (
				'title'				=> '',
				'excerpt'			=> '',
				'or'				=> esc_html__( 'Or', 'tradeup-extensions' ),
				'alignment'			=> 'left',
				'image'				=> '',
				'show_btn_1'		=> true,
				'btn_1_title'		=> esc_html__( 'Read More', 'tradeup-extensions' ),
				'btn_1_url'			=> '',
				'btn_1_target'		=> false,
				'btn_1_bg'			=> apply_filters( 'tradeup_extensions_actions_item___btn1bg', '#e91e63' ),
				'btn_1_hover'		=> apply_filters( 'tradeup_extensions_actions_item___btn1hover', '#980336' ),
				'btn_1_active'		=> apply_filters( 'tradeup_extensions_actions_item___btn1active', '#980336' ),
				'btn_2_title'		=> esc_html__( 'Read More #2', 'tradeup-extensions' ),
				'btn_2_url'			=> '',
				'btn_2_target'		=> false,
				'btn_2_bg'			=> apply_filters( 'tradeup_extensions_actions_item___btn2bg', '#e91e63' ),
				'btn_2_hover'		=> apply_filters( 'tradeup_extensions_actions_item___btn2hover', '#980336' ),
				'btn_2_active'		=> apply_filters( 'tradeup_extensions_actions_item___btn2active', '#980336' ),
				'show_btn_2'		=> false,
				'title_color'		=> apply_filters( 'tradeup_extensions_actions_item___titlecolor', '#ffffff' ),
				'excerpt_color'		=> apply_filters( 'tradeup_extensions_actions_item___excerptcolor', '#a7a6a6' ),
				'links_color'		=> apply_filters( 'tradeup_extensions_actions_item___linkscolor', '#ffeb3b' ),
				'background_color'	=> apply_filters( 'tradeup_extensions_actions_item___backgroundcolor', '#211e1e' ),
				'background_image'	=> '',
				'overlay'			=> false,
				'overlay_color'		=> apply_filters( 'tradeup_extensions_actions_item___overlaycolor', '#000000' ),
				'overlay_opacity'	=> '0.5',
				'parallax'			=> false,
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
			$image				= ! empty( $instance[ 'image' ] ) ? $instance[ 'image' ] : ''; set_query_var( 'image', $image );
			$alignment			= ! empty( $instance[ 'alignment' ] ) ? $instance[ 'alignment' ] : 'left'; set_query_var( 'alignment', $alignment );
			$background_image	= ! empty( $instance[ 'background_image' ] ) ? $instance[ 'background_image' ] : '';
			$overlay			= ! empty( $instance[ 'overlay' ] ) ? 1 : 0; set_query_var( 'overlay', $overlay );
			$overlay_opacity	= ! empty( $instance[ 'overlay_opacity' ] ) ? $instance[ 'overlay_opacity' ] : '0'; set_query_var( 'overlay_opacity', $overlay_opacity );
			$parallax			= ! empty( $instance[ 'parallax' ] ) ? 1 : 0; set_query_var( 'parallax', $parallax );

			// Meta options
			$title 			= apply_filters( 'widget_title', empty( $instance[ 'title' ] ) ? '' : $instance[ 'title' ], $instance, $this->id_base ); set_query_var( 'title', $title );
			$excerpt	 	= ! empty( $instance[ 'excerpt' ] ) ? $instance[ 'excerpt' ] : ''; set_query_var( 'excerpt', $excerpt );
			$or				= ! empty( $instance[ 'or' ] ) ? $instance[ 'or' ] : ''; set_query_var( 'or', $or );
			$show_btn_1		= ! empty( $instance[ 'show_btn_1' ] ) ? 1 : 0; set_query_var( 'show_btn_1', $show_btn_1 );
			$show_btn_2		= ! empty( $instance[ 'show_btn_2' ] ) ? 1 : 0; set_query_var( 'show_btn_2', $show_btn_2 );
			$btn_1_title	= ! empty( $instance[ 'btn_1_title' ] ) ? $instance[ 'btn_1_title' ] : ''; set_query_var( 'btn_1_title', $btn_1_title );
			$btn_1_url		= ! empty( $instance[ 'btn_1_url' ] ) ? $instance[ 'btn_1_url' ] : ''; set_query_var( 'btn_1_url', $btn_1_url );
			$btn_1_target	= ! empty( $instance[ 'btn_1_target' ] ) ? 1 : 0; set_query_var( 'btn_1_target', $btn_1_target );
			$btn_2_title	= ! empty( $instance[ 'btn_2_title' ] ) ? $instance[ 'btn_2_title' ] : ''; set_query_var( 'btn_2_title', $btn_2_title );
			$btn_2_url		= ! empty( $instance[ 'btn_2_url' ] ) ? $instance[ 'btn_2_url' ] : ''; set_query_var( 'btn_2_url', $btn_2_url );
			$btn_2_target	= ! empty( $instance[ 'btn_2_target' ] ) ? 1 : 0; set_query_var( 'btn_2_target', $btn_2_target );

			// Some variables
			$wid = $this->number; set_query_var( 'wid', $wid );
			$allowed_html = apply_filters( 'tradeup_extensions_actions_item___allowed_html', $allowed_html = $this->allowed_html ); set_query_var( 'allowed_html', $allowed_html );

			if( $image != '' ) {
				$display_image = '<img class="sec-ribbon-item-tmb" src="' . esc_url( $image ) . '" alt="Thumbnail" />';
			} else {
				$display_image = '<img class="sec-ribbon-item-tmb" src="' . esc_url( get_template_directory_uri() ) . '/tmb/ribbon-tmb.jpg" alt="Thumbnail" />';
			}
			set_query_var( 'display_image', $display_image );

			if( $overlay_opacity != '0.5' ) { $opacity = ' style="opacity: ' . esc_attr( $overlay_opacity ) . '"'; } else { $opacity = ''; } set_query_var( 'opacity', $opacity );

			if( $background_image != '' ) { $bg_class = 'has-background'; } else { $bg_class = ''; }

			// Add more widget classes
			$css_class = apply_filters( 'tradeup_extensions_actions_item___css_classes', $css_class = array() );
			$css_class[] = 'grid-wrap';
			$css_class[] = 'elements-' . $alignment;
			$css_class[] = $bg_class;
			$css_class[] = $parallax ? 'tu-ext-parallax' : '';
			$css_classes = join(' ', $css_class);
			$parallaxBg1 = $parallax ? ' style="background-image: url(' . esc_url( $background_image ) . ');" ' : '';
			$parallaxBg2 = $parallax ? ' style="background-image: url(' . esc_url( $background_image ) . ');" ' : '';
			$format1 = $parallaxBg1 . 'class="'. esc_attr( $css_classes ) . '"';
			$format2 = $parallaxBg2 . 'class="'. esc_attr( $css_classes ) . ' ';

			if ( ! empty( $css_classes ) ) {
				if( strpos($args['before_widget'], 'class') === false ) {
					$args[ 'before_widget' ] = str_replace( '>', $format1, $args[ 'before_widget' ] );
				} else {
					$args[ 'before_widget' ] = str_replace( 'class="', $format2, $args[ 'before_widget' ] );
				}
			}

			// Widget template output
			echo $args['before_widget'];

				ob_start();

				tradeup_extensions_get_template_part( 'sections-items/item', 'actions' );

				echo ob_get_clean();

				self::customizer_css( $instance ); // Output styles just for the customizer/selective refresh

			echo $args['after_widget'];

		}


		/*  Update Widget
		/* ------------------------------------ */
		public function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			// Variables
			$allowed_html = apply_filters( 'tradeup_extensions_actions_item___allowed_html', $allowed_html = $this->allowed_html );

			// Fields
			$instance[ 'title' ] 			= sanitize_text_field( $new_instance[ 'title' ] );
			$instance[ 'or' ] 				= sanitize_text_field( $new_instance[ 'or' ] );
			$instance[ 'image' ] 			= esc_url_raw( $new_instance[ 'image' ] );
			$instance[ 'btn_1_title' ] 		= sanitize_text_field( $new_instance[ 'btn_1_title' ] );
			$instance[ 'btn_1_url' ] 		= esc_url_raw( $new_instance[ 'btn_1_url' ] );
			$instance[ 'btn_1_bg' ] 		= sanitize_hex_color( $new_instance[ 'btn_1_bg' ] );
			$instance[ 'btn_1_hover' ] 		= sanitize_hex_color( $new_instance[ 'btn_1_hover' ] );
			$instance[ 'btn_1_active' ] 	= sanitize_hex_color( $new_instance[ 'btn_1_active' ] );
			$instance[ 'btn_2_title' ] 		= sanitize_text_field( $new_instance[ 'btn_2_title' ] );
			$instance[ 'btn_2_url' ] 		= esc_url_raw( $new_instance[ 'btn_2_url' ] );
			$instance[ 'btn_2_bg' ] 		= sanitize_hex_color( $new_instance[ 'btn_2_bg' ] );
			$instance[ 'btn_2_hover' ] 		= sanitize_hex_color( $new_instance[ 'btn_2_hover' ] );
			$instance[ 'btn_2_active' ] 	= sanitize_hex_color( $new_instance[ 'btn_2_active' ] );
			$instance[ 'title_color' ] 		= sanitize_hex_color( $new_instance[ 'title_color' ] );
			$instance[ 'excerpt_color' ] 	= sanitize_hex_color( $new_instance[ 'excerpt_color' ] );
			$instance[ 'links_color' ] 		= sanitize_hex_color( $new_instance[ 'links_color' ] );
			$instance[ 'background_color' ] = sanitize_hex_color( $new_instance[ 'background_color' ] );
			$instance[ 'background_image' ] = esc_url_raw( $new_instance[ 'background_image' ] );
			$instance[ 'overlay_color' ]	= sanitize_hex_color( $new_instance[ 'overlay_color' ] );

			// Text Area
			if ( current_user_can('unfiltered_html') ) {
				$instance[ 'excerpt' ] = tradeup_ext_sanitize_content_filtered( $new_instance[ 'excerpt' ] );
			} else {
				$instance[ 'excerpt' ] = wp_kses_post( stripslashes( $new_instance[ 'excerpt' ] ) );
			}

			// Select
			$instance[ 'alignment'] 		= tradeup_sanitize_select( $new_instance[ 'alignment' ], array( 'left', 'right' ), $this->defaults[ 'alignment' ], false  );
			$instance[ 'overlay_opacity'] 	= tradeup_sanitize_select( $new_instance[ 'overlay_opacity' ], tradeup_opacity_options( false, true ), $this->defaults[ 'overlay_opacity' ], false  );

			// Checkboxes
			$instance[ 'show_btn_1' ]	= ! empty( $new_instance[ 'show_btn_1' ] ) ? 1 : 0;
			$instance[ 'btn_1_target' ]	= ! empty( $new_instance[ 'btn_1_target' ] ) ? 1 : 0;
			$instance[ 'show_btn_2' ]	= ! empty( $new_instance[ 'show_btn_2' ] ) ? 1 : 0;
			$instance[ 'btn_2_target' ]	= ! empty( $new_instance[ 'btn_2_target' ] ) ? 1 : 0;
			$instance[ 'overlay' ]		= ! empty( $new_instance[ 'overlay' ] ) ? 1 : 0;
			$instance[ 'parallax' ]		= ! empty( $new_instance[ 'parallax' ] ) ? 1 : 0;

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
			$excerpt 		= $instance[ 'excerpt' ];
			$or				= $instance[ 'or' ];
			$alignment		= $instance[ 'alignment' ];
			$image			= $instance[ 'image' ];
			$show_btn_1 	= isset( $instance[ 'show_btn_1' ] ) ? (bool) $instance[ 'show_btn_1' ] : false;
			$show_btn_2 	= isset( $instance[ 'show_btn_2' ] ) ? (bool) $instance[ 'show_btn_2' ] : false;
			$btn_1_title	= $instance[ 'btn_1_title' ];
			$btn_1_url		= $instance[ 'btn_1_url' ];
			$btn_1_target 	= isset( $instance[ 'btn_1_target' ] ) ? (bool) $instance[ 'btn_1_target' ] : false;
			$btn_1_bg		= $instance[ 'btn_1_bg' ];
			$btn_1_hover	= $instance[ 'btn_1_hover' ];
			$btn_1_active	= $instance[ 'btn_1_active' ];
			$btn_2_title	= $instance[ 'btn_2_title' ];
			$btn_2_url		= $instance[ 'btn_2_url' ];
			$btn_2_target 	= isset( $instance[ 'btn_2_target' ] ) ? (bool) $instance[ 'btn_2_target' ] : false;
			$btn_2_bg		= $instance[ 'btn_2_bg' ];
			$btn_2_hover	= $instance[ 'btn_2_hover' ];
			$btn_2_active	= $instance[ 'btn_2_active' ];
			$title_color	= $instance[ 'title_color' ];
			$excerpt_color	= $instance[ 'excerpt_color' ];
			$links_color	= $instance[ 'links_color' ];
			$background_color	= $instance[ 'background_color' ];
			$background_image	= $instance[ 'background_image' ];
			$overlay 		= isset( $instance[ 'overlay' ] ) ? (bool) $instance[ 'overlay' ] : false;
			$parallax 		= isset( $instance[ 'parallax' ] ) ? (bool) $instance[ 'parallax' ] : false;
			$overlay_color	= $instance[ 'overlay_color' ];

			// Some options for select fields
			$alignment_options = array(
				array(
					'value' 	=> 'left',
					'title' 	=> __( 'Left', 'tradeup-extensions' ),
					'disabled'	=> false
				),
				array(
					'value' 	=> 'right',
					'title' 	=> __( 'Right', 'tradeup-extensions' ),
					'disabled'	=> false
				),
			);

			// Form output

			/* Title */
			parent::text_input( $title, 'title', __( 'Title:', 'tradeup-extensions' ) );

			/* Excerpt */
			parent::text_area( $excerpt, 'excerpt', __( 'Text:', 'tradeup-extensions' ), '', '' );

			/* Tabs */
			?>
            <div class="tu-widget-tabs tu-bs">

                <div class="tu-wt-tab-wrap tu-bs">
                    <a href="#" class="tu-wt-tab-toggle tu-bs"><?php _e( 'Button', 'tradeup-extensions' ); ?></a>
                    <div class="tu-wt-tab-contents tu-bs">
                    	<?php
							parent::check_box( $show_btn_1, 'show_btn_1', __( 'Display button', 'tradeup-extensions' ) );

							parent::text_input( $btn_1_title, 'btn_1_title', __( 'Anchor text:', 'tradeup-extensions' ) );

							parent::text_input( $btn_1_url, 'btn_1_url', __( 'Url:', 'tradeup-extensions' ), 'url' );

							parent::check_box( $btn_1_target, 'btn_1_target', __( 'Open in a new window', 'tradeup-extensions' ) );

                         	parent::color_picker( $btn_1_bg, 'btn_1_bg', $this->defaults[ 'btn_1_bg' ],
								__( 'Button background color:', 'tradeup-extensions' ), '' );
							parent::color_picker( $btn_1_hover, 'btn_1_hover', $this->defaults[ 'btn_1_hover' ],
								__( 'Button hover state:', 'tradeup-extensions' ), '' );
							parent::color_picker( $btn_1_active, 'btn_1_active', $this->defaults[ 'btn_1_active' ],
								__( 'Button active state:', 'tradeup-extensions' ), '' );
						?>
                    </div>
                </div>

                <div class="tu-wt-tab-wrap tu-bs">
                    <a href="#" class="tu-wt-tab-toggle tu-bs"><?php _e( 'Design', 'tradeup-extensions' ); ?></a>
                    <div class="tu-wt-tab-contents tu-bs">
                    	<?php
							parent::color_picker( $title_color, 'title_color', $this->defaults[ 'title_color' ],
								__( 'Heading color:', 'tradeup-extensions' ), '' );
							parent::color_picker( $excerpt_color, 'excerpt_color', $this->defaults[ 'excerpt_color' ],
								__( 'Text color:', 'tradeup-extensions' ), '' );
							
							parent::color_picker( $background_color, 'background_color', $this->defaults[ 'background_color' ],
								__( 'Background color:', 'tradeup-extensions' ), '' );
							parent::select_image( $background_image, 'background_image', '', __( 'Background image:', 'tradeup-extensions' ) );
							parent::check_box( $overlay, 'overlay', __( 'Show overlay', 'tradeup-extensions' ) );
							parent::color_picker( $overlay_color, 'overlay_color', $this->defaults[ 'overlay_color' ],
								__( 'Overlay color:', 'tradeup-extensions' ), '' );
							parent::select_type( $overlay_opacity, 'overlay_opacity', tradeup_opacity_options( true, false ), __( 'Overlay opacity:', 'tradeup-extensions' ) );
							parent::check_box( $parallax, 'parallax', __( 'Enable parallax', 'tradeup-extensions' ), '', __( 'For performance reasons, the Parallax effect is only visible on the live website (not in Customizer). Also, make sure you have a background image selected.', 'tradeup-extensions' ) );
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
			$wid				= esc_html( '#' . $this->id );
			$btn_1_bg 			= $instance[ 'btn_1_bg' ];
			$btn_1_hover 		= $instance[ 'btn_1_hover' ];
			$btn_1_active 		= $instance[ 'btn_1_active' ];
			$btn_2_bg 			= $instance[ 'btn_2_bg' ];
			$btn_2_hover 		= $instance[ 'btn_2_hover' ];
			$btn_2_active 		= $instance[ 'btn_2_active' ];
			$title_color		= $instance[ 'title_color' ];
			$excerpt_color		= $instance[ 'excerpt_color' ];
			$links_color		= $instance[ 'links_color' ];
			$background_color	= $instance[ 'background_color' ];
			$background_image	= $instance[ 'background_image' ];
			$overlay_color		= $instance[ 'overlay_color' ];
			$parallax			= $instance[ 'parallax' ];
			$custom_css 		= '';

			// Style Output
			if ( is_customize_preview() ) {
				$custom_css .= '<style type="text/css" id="customizer-css_' . esc_attr( $this->id ) . '">';

					// Background
					if( parent::cd( $background_color, $this->defaults[ 'background_color' ] ) ) {
						$custom_css .= $wid . ' { background-color: ' . sanitize_hex_color( $background_color ) . ' }'; }
					if( parent::cd( $background_image, $this->defaults[ 'background_image' ] ) ) {
						$custom_css .= $wid . ' { background-image: url("' . esc_url( $background_image ) . '") }'; }
					if( $instance[ 'overlay' ] ) {
						if( parent::cd( $overlay_color, $this->defaults[ 'overlay_color' ] ) ) {
							$custom_css .= $wid . ' .grid-overlay { background-color: ' . sanitize_hex_color( $overlay_color ) . ' }'; }
					}
					// Heading + text
					if( parent::cd( $excerpt_color, $this->defaults[ 'excerpt_color' ] ) ) {
						$custom_css .= $wid . ' p { color: ' . sanitize_hex_color( $excerpt_color ) . ' }'; }
					if( parent::cd( $title_color, $this->defaults[ 'title_color' ] ) ) {
						$custom_css .= $wid . ' h2 { color: ' . sanitize_hex_color( $title_color ) . ' }'; }
					if( parent::cd( $links_color, $this->defaults[ 'links_color' ] ) ) {
						$custom_css .= $wid . ' a:not(.ac-btn), ' . $wid . ' a:not(.ac-btn):visited, ' . $wid . ' a:not(.ac-btn):hover { color: ' . sanitize_hex_color( $links_color ) . ' }'; }
					// Button #1
					if( parent::cd( $btn_1_bg, $this->defaults[ 'btn_1_bg' ] ) ) {
						$custom_css .= $wid . ' .btn-1 { background-color: ' . sanitize_hex_color( $btn_1_bg ) . ' }'; }
					if( parent::cd( $btn_1_hover, $this->defaults[ 'btn_1_hover' ] ) ) {
						$custom_css .= $wid . ' .btn-1:hover { background-color: ' . sanitize_hex_color( $btn_1_hover ) . ' }'; }
					if( parent::cd( $btn_1_active, $this->defaults[ 'btn_1_active' ] ) ) {
						$custom_css .= $wid . ' .btn-1:active { background-color: ' . sanitize_hex_color( $btn_1_active ) . ' }'; }
					// Button #2
					if( parent::cd( $btn_2_bg, $this->defaults[ 'btn_2_bg' ] ) ) {
						$custom_css .= $wid . ' .btn-2 { background-color: ' . sanitize_hex_color( $btn_2_bg ) . ' }'; }
					if( parent::cd( $btn_2_hover, $this->defaults[ 'btn_2_hover' ] ) ) {
						$custom_css .= $wid . ' .btn-2:hover { background-color: ' . sanitize_hex_color( $btn_2_hover ) . ' }'; }
					if( parent::cd( $btn_2_active, $this->defaults[ 'btn_2_active' ] ) ) {
						$custom_css .= $wid . ' .btn-2:active { background-color: ' . sanitize_hex_color( $btn_2_active ) . ' }'; }

				$custom_css .= '</style>';

				_e($custom_css);
			}

		}


	} // Tradeup_Extensions_Actions_Item .END

	// Register this widget
	register_widget( 'Tradeup_Extensions_Actions_Item' );

}