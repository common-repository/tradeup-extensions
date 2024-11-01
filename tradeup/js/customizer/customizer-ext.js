var $   = window.jQuery;
    api = wp.customize || {};

window.BxExtensions = {

	/**
	 * Setting up some variables
	 *
	 * @type {Object}
	 */
	v : {
		panel    : 'tradeup_panel__sections',
		admin    : bxext_widgets_customizer.admin_url,
		icons    : bxext_widgets_customizer.icons,
		sections : bxext_widgets_customizer.sections,
		sections_position : bxext_widgets_customizer.sections_position,
		msgs     : bxext_widgets_customizer.msgs,
		actions  : $( '#customize-header-actions' ),
		mod      : 'tradeup_sections_position'
	},

	/**
	 * Initiazlie BxExtensions
	 *
	 * @return {Mixed}
	 */
	init : function() {
		var self = this;

		self.initFirstViewModal();
		self.initialSectionsPriorities();
		self.initSortableSections();
		self.backup();
	},

	/**
	 * Make the Homepage sections sortable in our panel
	 *
	 * @return {jQueryUI.Sortable}
	 */
	initSortableSections : function() {
		var self = this,
		    list = $( self.panelSections() );

		list.sortable({
			helper : 'clone',
			items  : '> li.control-section:not(.cannot-expand)',
			cancel : 'li.ui-sortable-handle.open',
			delay  : 150,
			axis   : 'y',
			update : function( event, ui ) {
				var updatedList,
				    sortable_sel = 'li[id*="tradeup_section__"]',
				    defaultList  = self.getPanelSections(),
					currentList  = self.sectionsArray();
				
				updatedList = _.union( currentList, defaultList );

				self.setPrio( updatedList );

				// If a sections is moved, save position in a theme mod
				list.find( '.tu_drag_and_spinner' ).show();

				self.setSectionsPosition( updatedList );

				$( '.wp-full-overlay-sidebar-content' ).scrollTop( 0 );
			},
		});
	},

	/**
	 * Updates the section's priority on the JS side
	 *
	 * @since  1.0.6
	 * @return {Void}
	 */
	initialSectionsPriorities : function() {
		var self    = this,
			current = JSON.parse( api( self.v.mod ).get() );

		self.setPrio( current );
	},

	/**
	 * Sets the section's priority on the JS side
	 *
	 * @since  1.0.6
	 * @return {Void}
	 */
	setPrio : function( list ) {
		_.each( list, function( sid, i ) {
			api.section( sid ).priority.set( i + 1 );
		} );
	},

	/**
	 * Gets the sections in our `Front Page` panel
	 *
	 * @since  1.0.6
	 * @return {Array}
	 */
	getPanelSections : function() {
		var self  = this,
		    panel = api.panel( self.v.panel ), sections = [], qty;

		api.section.each( function( section ) {
			if( section.panel.get() === panel.id ) {
				sections.push( section.id );
			}
		});

		// Whitout the custom drag & drop section.
		sections.shift();

		return sections;
	},

	/**
	 * Panel handle DOM element
	 *
	 * @return {DOMnode}
	 */
	panelHandle : function() {
		return api.panel( this.v.panel ).container.get( 0 );
	},

	/**
	 * Return all the sections in our Front Page panel
	 *
	 * @return {DOMnode}
	 */
	panelSections : function() {
		return api.panel( this.v.panel ).contentContainer;
	},

	/**
	 * Convert our sections name to a more friendly format
	 * and add them into an array
	 *
	 * @return {Array}
	 */
	sectionsArray : function() {
		var self  = this,
		    list  = self.panelSections();
		    items = $( list ).sortable( 'toArray' );

		for( var i = 0; i < items.length; i++ ) {
			items[ i ] = items[ i ].replace( 'accordion-section-', '' );
		}
		return items;
	},

	/**
	 * Sets the sections position so we can remember them. Adds them
	 * into a theme mode via ajax
	 *
	 * @param  {Array} sections An array of sections with their position updated
	 * @return {Void}
	 */
	setSectionsPosition : function( sections ) {
		var self = this,
		    list = $( self.panelSections() );

		// We're going to leave the prefix on each section
		// for backwards compatibility
		sections = JSON.stringify( sections ); // @since 1.0.6
		
		// Update the theme_mod
		api( self.v.mod ).set( sections );

		setTimeout( function() { 
			list.find( '.tu_drag_and_spinner' ).hide();
		}, 500 );
	},

	/**
	 * Backup sections and widgets position
	 * @return {Mixed}
	 */
	backup : function() {
		var self    = this,
		    actions = self.v.actions,
		    msgs    = self.v.msgs,
		    _doc    = $( document ),
		    save    = actions.find( '.save' );

		// Add backup button
		actions.prepend(
			'<a href="#" class="customize-controls-close tu-backup-sections"><span class="tu-backup-pulse"></span><span class="tu-backup-bubble">' + msgs.bk_bubble + '</span></a>'
		);

		// When the backup button is clicked do this action via ajax
		_doc.on( 'click', '.tu-backup-sections', function( e ) {
			e.preventDefault();

			if( save.is( ':disabled' ) === true ) {
				$.ajax({
					url      : ajaxurl,
					type     : 'post',
					dataType : 'json',
					data     : {
						action: 'tradeup_extensions_sections_bk',
						n_sections_bk: tuext_customizer_nonces.n_sections_bk,
					}
				})
				.done( function( data ) {
					$( '.tu-backup-pulse' ).hide();
					alert( msgs.bk_success );
					_doc.trigger( 'bx-backup-success' );
				});
			} else {
				alert( msgs.bk_fail );
			}
		});

		// When widgets are added or updated display pulse
		_doc.on( 'widget-added widget-updated', function( e ) {
			$( '.tu-backup-pulse' ).show();
		});

		// Restore backup when a button is clicked
		_doc.on( 'click', '.bx-restore-sections', function( e ) {
			e.preventDefault();

			if( save.is(':disabled') === true ) {
				$.ajax({
					url      : ajaxurl,
					type     : 'post',
					dataType : 'json',
					data     : {
						action: 'tradeup_extensions_sections_rt',
						n_sections_rt: tuext_customizer_nonces.n_sections_rt,
					}
				})
				.done( function( data ) {
					alert( msgs.bk_restore_success );
					location.reload(true);
				});
			} else {
				alert( msgs.bk_fail );
			}
		});
	},

	/**
	 * Setup for Front Page with cusom template
	 * 
	 * @since  1.0.6
	 * @return {Void|Boolean}
	 */
	initFirstViewModal : function() {
		// Check if the modal window is ready
		if( $( '#tradeup-frontpage-modal' ).length > 0 ) {
			$.magnificPopup.open( {
				items: {
					src  : '#tradeup-frontpage-modal',
					type : 'inline'
				},
				modal     : true,
				preloader : false,
				focus     : '#tuext-insert-frontpage'
			}, 0 );

			$( '#tuext-insert-frontpage' ).on( 'click', function( event ) {
				event.preventDefault();

				$.ajax({
					url      : ajaxurl,
					type     : 'post',
					dataType : 'json',
					data     : {
						action: 'tuext_create_frontpage',
						tuext_create_frontpage: tuext_customizer_nonces.tuext_create_frontpage,
					}
				})
				.done( function( data ) {
					$.magnificPopup.close();
					location.reload( true );
				});
			});
	
			$( '#tuext-dismiss-frontpage' ).on( 'click', function( event ) {
				event.preventDefault();

				$.ajax({
					url      : ajaxurl,
					type     : 'post',
					dataType : 'json',
					data     : {
						action: 'tuext_dismiss_create_frontpage',
						tuext_create_frontpage: tuext_customizer_nonces.tuext_dismiss_create_frontpage,
					}
				})
				.done( function( data ) {
					$.magnificPopup.close();
					location.reload( true );
				});
			});
		} else {
			return false;
		}
	}

}

/**
 * Let the magic begin
 */
$( document ).ready( function( $ ) {
	var bxextensions = window.BxExtensions;

	/**
	 * Init Tradeup Pro Customizer Class
	 */
	bxextensions.init();
});
