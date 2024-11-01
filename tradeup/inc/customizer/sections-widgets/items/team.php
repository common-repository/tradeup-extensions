<?php
if( ! class_exists( 'Tradeup_Extensions_Team_Item' ) ) {
	/**
	 * Team Item
	 * Adds a Team member - name, avatar, position, description, social buttons
	 *
	 * @since 1.0.0
	 */
	class Tradeup_Extensions_Team_Item extends Tradeup_Extensions_Base {

		/**
		 * Widget defaults
		 *
		 * @var    array
		 * @since  1.0.0
		 * @access protected
		 */
		protected $defaults;

		/**
		 * Allowed HTML
		 *
		 * @var    array
		 * @since  1.0.0
		 * @access protected
		 */
		protected $allowed_html = array(
			'a' => array(
				'href'  => array(),
				'title' => array()
			),
			'em'     => array(),
			'strong' => array(),
		);

		/**
		 * Widget instance
		 *
		 * @since  1.0.0
		 * @access public
		 */
		function __construct() {

			// Variables
			$this->widget_title = __( 'TU: Team Member' , 'tradeup-extensions' );
			$this->widget_id    = 'team';

			// Settings
			$widget_ops = array(
				'classname'   => 'sec-team-member',
				'description' => esc_html__( 'Adds a Team member - name, avatar, position, description, social buttons', 'tradeup-extensions' ),
				'customize_selective_refresh' => true
			);

			// Control settings
			$control_ops = array(
				'width'   => NULL,
				'height'  => NULL,
				'id_base' => 'bx-item-' . $this->widget_id
			);

			// Create the widget
			parent::__construct(
				'bx-item-' . $this->widget_id,
				$this->widget_title,
				$widget_ops,
				$control_ops
			);

			// Set some widget defaults
			$this->defaults = array (
				'title'         => '',
				'position'      => '',
				'description'   => '',
				'avatar'        => '',
				'avatar_url'    => '',
				'avatar_trg'    => false,
				'social_links'  => array(),
			);

			// Underscore template for repeating fields
			add_action( 'customize_controls_print_footer_scripts', array( $this, 'repeating_tmpl' ), 0 );

		}

		/**
		 * Widget output
		 *
		 * @since  1.0.0
		 * @access public
		 */
		public function widget( $args, $instance ) {
			// Turn $args array into variables.
			extract( $args );

			// $instance Defaults
			$instance_defaults = $this->defaults;

			// Parse $instance
			$instance = wp_parse_args( $instance, $instance_defaults );

			// Options
			$title          = apply_filters( 'widget_title', empty( $instance[ 'title' ] ) ? '' : $instance[ 'title' ], $instance, $this->id_base );
			$position       = ! empty( $instance[ 'position' ] ) ? $instance[ 'position' ] : '';
			$description    = ! empty( $instance[ 'description' ] ) ? $instance[ 'description' ] : '';
			$avatar         = ! empty( $instance[ 'avatar' ] ) ? $instance[ 'avatar' ] : '';
			$avatar_url     = ! empty( $instance[ 'avatar_url' ] ) ? $instance[ 'avatar_url' ] : '';
			$avatar_trg     = ! empty( $instance[ 'avatar_trg' ] ) ? 1 : 0;
			$social_links   = ! empty( $instance[ 'social_links' ] ) ? $instance[ 'social_links' ] : array();

			// Some variables
			$wid = $this->number;
			$title_output = ( ! empty( $title ) ) ? $args['before_title'] . $title . $args['after_title'] : '';
			$allowed_html = $this->allowed_html();

			// Template vars
			set_query_var( 'wid', $wid );
			set_query_var( 'title', $title );
			set_query_var( 'position', $position );
			set_query_var( 'description', $description );
			set_query_var( 'avatar', $avatar );
			set_query_var( 'avatar_url', $avatar_url );
			set_query_var( 'avatar_trg', $avatar_trg );
			set_query_var( 'social_links', $social_links );
			set_query_var( 'title_output', $title_output );
			set_query_var( 'allowed_html', $allowed_html );

			// Add more widget classes
			$css_class   = array();
			$css_class[] = '';
			$css_class[] = 'col-lg-4 col-md-6 col-sm-6';
			$css_class   = apply_filters( 'tradeup_extensions_team_item___css_classes', $css_class );
			$css_classes = join( ' ', $css_class );

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

				tradeup_extensions_get_template_part( 'sections-items/item', 'team' );

				echo ob_get_clean();

			echo $args['after_widget'];

		}

		/**
		 * Allowed HTML
		 *
		 * @since  1.0.4.3
		 * @access public
		 */
		public function allowed_html() {
			$allowed_html = $this->allowed_html;
			return apply_filters( 'tradeup_extensions_team_item___allowed_html', $allowed_html );
		}

		/**
		 * Widget update
		 *
		 * @since  1.0.0
		 * @access public
		 */
		public function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			// Variables
			$allowed_html = $this->allowed_html();

			// Fields
			$instance[ 'title' ]        = sanitize_text_field( $new_instance[ 'title' ] );
			$instance[ 'position' ]     = sanitize_text_field( $new_instance[ 'position' ] );
			$instance[ 'avatar' ]       = esc_url_raw( $new_instance[ 'avatar' ] );
			$instance[ 'avatar_url' ]   = esc_url_raw( $new_instance[ 'avatar_url' ] );

			// Checkboxes
			$instance[ 'avatar_trg' ] = ! empty( $new_instance[ 'avatar_trg' ] ) ? 1 : 0;

			// Social Links
			$instance[ 'social_links' ] = tradeup_sanitize_array_map( 'esc_url_raw', $new_instance[ 'social_links' ] );

			// Text Area
			if ( current_user_can('unfiltered_html') ) {
				$instance[ 'description' ] =  tradeup_content_filter( $new_instance[ 'description' ], $allowed_html );
			} else {
				$instance[ 'description' ] = wp_kses_post( stripslashes( $new_instance[ 'description' ] ) );
			}

			// Return
			return $instance;
		}

		/**
		 * Repeating field Underscore template
		 *
		 * @since  1.0.4.3
		 * @access public
		 */
		public function repeating_tmpl() {
			?>
			<script type="text/template" id="tmpl-<?php echo esc_attr($this->id_base) ?>-repeater">

					<input type="url" name="{{ data.name }}[{{ data.key }}][url]"  value="{{ data.value }}" class="widefat" id="{{ data.wid }}[{{ data.key }}][url]" />
					<span class="tu-team-repeatable-helper"><a class="bx-widget-repeater-remove-item" href="#"><span class="dashicons dashicons-trash"></span></a></span>
					<span class="tu-team-repeatable-helper"><span class="dashicons dashicons-sort"></span></span>

					<input type="hidden" class="bx-widget-repeater-el-key" data-acb-el-key="{{ data.key }}" />

			</script>
			<?php
		}

		/**
		 * Widget form
		 *
		 * @since  1.0.0
		 * @access public
		 */
		public function form( $instance ) {
			// Parse $instance
			$instance_defaults = $this->defaults;
			$instance = wp_parse_args( $instance, $instance_defaults );
			extract( $instance, EXTR_SKIP );

			// Variables
			$title          = $instance[ 'title' ];
			$position       = $instance[ 'position' ];
			$description    = $instance[ 'description' ];
			$avatar         = $instance[ 'avatar' ];
			$avatar_url     = $instance[ 'avatar_url' ];
			$avatar_trg     = isset( $instance[ 'avatar_trg' ] ) ? (bool) $instance[ 'avatar_trg' ] : false;
			$social_links   = $instance[ 'social_links' ];

			// Form output

			/* Title */
			parent::text_input( $title, 'title', __( 'Member name:', 'tradeup-extensions' ), '', 'p-widget-title' );

			/* Position */
			parent::text_input( $position, 'position', __( 'Position/Job:', 'tradeup-extensions' ) );

			/* Avatar */
			parent::select_image( $avatar, 'avatar', '', __( 'Avatar - suggested size: 250x250px', 'tradeup-extensions' ) );

			/* Avatar URL */
			parent::text_input( $avatar_url, 'avatar_url', __( 'Link on avatar', 'tradeup-extensions' ), 'url', '', esc_attr__( 'https://google.com', 'tradeup-extensions' ) );

			/* Avatar URL target */
			parent::check_box( $avatar_trg, 'avatar_trg', __( 'Open link in a new window', 'tradeup-extensions' ) );

			/* Tabs */
			?>
			<div class="tu-widget-tabs tu-bs">

				<div class="tu-wt-tab-wrap tu-bs">

				<a href="#" class="tu-wt-tab-toggle tu-bs"><?php _e( 'Social Profiles', 'tradeup-extensions' ); ?></a>

					<div class="tu-wt-tab-contents tu-bs">

						<p><?php _e( 'Enter your social profile URL, for example: https://twitter.com/', 'tradeup-extensions' ); ?></p>
						<p><?php _e( 'If the theme has an icon for your social profile, it will display it.', 'tradeup-extensions' ); ?></p>

						<ul class="tu-widget-repeatable-items tu-clearfix">
							<?php
							if ( ! empty( $social_links ) ) :
								foreach ( $social_links as $key => $value ) :
							?>
								<li class="tu-item-team-repeatable-item tu-bs tu-clearfix">
									<input type="url" name="<?php echo esc_attr($this->get_field_name( 'social_links' )); ?>[<?php echo esc_attr( $key ); ?>][url]"  value="<?php echo esc_url( $value['url'] ); ?>" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'social_links' )); ?>[<?php echo esc_attr( $key ); ?>][url]" />
									<span class="tu-team-repeatable-helper"><a class="bx-widget-repeater-remove-item" href="#"><span class="dashicons dashicons-trash"></span></a></span>
									<span class="tu-team-repeatable-helper"><span class="dashicons dashicons-sort"></span></span>
									<input type="hidden" class="bx-widget-repeater-el-key" data-acb-el-key="<?php echo esc_attr( $key ); ?>" />
								</li>
							<?php
								endforeach;
							endif;
							?>
						</ul>

						<p><a class="button bx-widget-repeater-add" href="#"><?php _e( 'Add another profile', 'tradeup-extensions' ); ?></a></p>

						<input type="hidden" class="bx-widget-repeatable-change" name="bx-widget-repeatable-change" />
						<input type="hidden" class="bx-widget-repeater-el" data-acb-el="social_links" />

					</div>
				</div>

			</div> <!-- Tabs -->
			<?php
		}


	} // Tradeup_Extensions_Team_Item .END

	// Register this widget
	register_widget( 'Tradeup_Extensions_Team_Item' );

}
