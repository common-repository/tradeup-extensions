/* Customizer Preview */
( function( $ ) {

	var style = $( 'tradeup-ext-czr-settings-output-css' ),
		 api = wp.customize;

	if ( ! style.length ) {
		style = $( 'head' ).append( '<style type="text/css" id="tradeup-ext-czr-settings-output-css" />' )
		                    .find( '#tradeup-ext-czr-settings-output-css' );
	}

	api.bind( 'preview-ready', function() {
		api.preview.bind( 'bx-ext-update-settings', function( new_settings ) {
			style.html( new_settings );
		} );
	} );

	/* Non colors, text or url settings
	/* -------------------------------- */

	// Repeating items for each section
	$.each( tu_ext_customizer_settings, function( index, section ) {

		// Features section overlay
		wp.customize( section + '_bg_overlay', function( value ) {
			value.bind( function( to ) {
				if( to ) {
					if( $( '.sec-' + section + ' .grid-overlay' ).length == 0 )
						$( '.sec-' + section ).prepend('<div class="grid-overlay"></div>'); }
				else {
					if( $( '.sec-' + section + ' .grid-overlay' ).length == 1 )
						$( '.sec-' + section + ' .grid-overlay' ).remove(); }
			} );
		} );

	});

	// About Us Section button url
	wp.customize( 'about_section_btn_anchor_url', function( value ) {
		value.bind( function( to ) {
			$( '.sec-about .about-button .ac-btn').attr( 'href', to );
		} );
	} );

	// About Section button target
	wp.customize( 'about_section_btn_target', function( value ) {
		value.bind( function( to ) {
			if( to ) {
				$( '.sec-about .ac-btn').attr( 'target', '_blank' );
			} else {
				$( '.sec-about .ac-btn').attr( 'target', '_self' );
			}
		} );
	} );

	wp.customize( 'blog_action_btn_url', function( value ) {
		value.bind( function( to ) {
			$( '.blog-action-btn' ).attr( 'href', to );
		} );
	} );

	wp.customize( 'portfolio_action_btn_url', function( value ) {
		value.bind( function( to ) {
			$( '.portfolio-action-btn' ).attr( 'href', to );
		} );
	} );

} )( jQuery );
