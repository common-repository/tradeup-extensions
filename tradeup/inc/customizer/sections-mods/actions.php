<?php
/* ------------------------------------------------------------------------- *
 *  ______
 *
 *  Actions
 *  ________________
 *
 *	Panel, settings and controls options
 *	_____________________________
 *
 *	All the "tradeup_controller_*" are located in the theme:
 *	../tradeup-controls/customizer/customizer.php
 *
 *	They use $wp_customize->add_setting and $wp_customize->add_control to
 *	add settings and controls, all sanitized.
 *
/* ------------------------------------------------------------------------- */



	/*  Add section
	/* ------------------------------------ */
	$wp_customize->add_section( new TUEXT_Section_FrontPage( $wp_customize, 'tradeup_section__actions', array(
		'title'				=> esc_html__( 'Call to Action', 'tradeup-extensions' ),
		'panel'				=> 'tradeup_panel__sections',
		'priority'			=> absint( tradeup_extensions_sec_prio( 'tradeup_section__actions' ) ),
	) ) );



		/*  Call to Action options
		/* ------------------------------------ */
		$wp_customize->add_setting( 'actions-addedititems', array() );

		$wp_customize->add_control( new TUEXT_Control_AddEditItems( $wp_customize, 'actions-addedititems', array(
			'section'      => 'tradeup_section__actions',
			'type'         => 'add-edit-items',
			'section_type' => 'actions',
			'item_type'    => __( 'Add or edit actions', 'tradeup-extensions' )
		) ) );

		// Hide section
		tradeup_controller_checkbox(
			'actions_section_hide',
			'tradeup_section__actions',
			esc_html__( 'Hide this section', 'tradeup-extensions' ) );
		/*=====*/
