<?php
/**
 * Team items
 */
add_action( 'tu_ext_item__team', 'tu_ext_item__team_thumbnail',    10, 1 );
add_action( 'tu_ext_item__team', 'tu_ext_item__team_title',        20, 1 );
add_action( 'tu_ext_item__team', 'tu_ext_item__team_position',     30, 1 );
add_action( 'tu_ext_item__team', 'tu_ext_item__team_description',  40, 1 );
add_action( 'tu_ext_item__team', 'tu_ext_item__team_social',       50, 1 );


/**
 * About items
 */
add_action( 'tu_ext_item__about', 'tu_ext_item__about_title',   10, 1 );
add_action( 'tu_ext_item__about', 'tu_ext_item__about_excerpt', 20, 1 );

/**
 * Testimonial items
 */
add_action( 'tu_ext_item__testimonials', 'tu_ext_item__testimonials_avatar',   10, 1 );
add_action( 'tu_ext_item__testimonials', 'tu_ext_item__testimonials_contents', 20, 1 );

add_action( 'tu_ext_item__testimonials_contents', 'tu_ext_item__testimonials_contents_start',        10, 1 );
add_action( 'tu_ext_item__testimonials_contents', 'tu_ext_item__testimonials_contents_title',        20, 1 );
add_action( 'tu_ext_item__testimonials_contents', 'tu_ext_item__testimonials_contents_testimonial',  30, 1 );
add_action( 'tu_ext_item__testimonials_contents', 'tu_ext_item__testimonials_contents_button',       40, 1 );
add_action( 'tu_ext_item__testimonials_contents', 'tu_ext_item__testimonials_contents_end',         999, 1 );

/**
 * Actions items
 */
add_action( 'tu_ext_item__actions', 'tu_ext_item__actions_overlay',   10, 1 );
add_action( 'tu_ext_item__actions', 'tu_ext_item__actions_container', 20, 1 );

add_action( 'tu_ext_item__actions_container', 'tu_ext_item__actions_container_start',   10, 1 );
add_action( 'tu_ext_item__actions_container', 'tu_ext_item__actions_container_image',   20, 1 );
add_action( 'tu_ext_item__actions_container', 'tu_ext_item__actions_container_meta',    30, 1 );
add_action( 'tu_ext_item__actions_container', 'tu_ext_item__actions_container_end',    999, 1 );

add_action( 'tu_ext_item__actions_container_meta', 'tu_ext_item__actions_container_meta_start',     10, 1 );
add_action( 'tu_ext_item__actions_container_meta', 'tu_ext_item__actions_container_meta_title',     20, 1 );
add_action( 'tu_ext_item__actions_container_meta', 'tu_ext_item__actions_container_meta_excerpt',   30, 1 );
add_action( 'tu_ext_item__actions_container_meta', 'tu_ext_item__actions_container_meta_buttons',   40, 1 );
add_action( 'tu_ext_item__actions_container_meta', 'tu_ext_item__actions_container_meta_end',      999, 1 );

/**
 * Features items
 */
add_action( 'tu_ext_item__features', 'tu_ext_item__features_figure',   10, 1 );
add_action( 'tu_ext_item__features', 'tu_ext_item__features_contents', 20, 1 );

add_action( 'tu_ext_item__features_contents', 'tu_ext_item__features_contents_start',    10, 1 );
add_action( 'tu_ext_item__features_contents', 'tu_ext_item__features_contents_title',    20, 1 );
add_action( 'tu_ext_item__features_contents', 'tu_ext_item__features_contents_excerpt',  30, 1 );
add_action( 'tu_ext_item__features_contents', 'tu_ext_item__features_contents_button',   40, 1 );
add_action( 'tu_ext_item__features_contents', 'tu_ext_item__features_contents_end',     999, 1 );

/**
 * Slider items
 */
add_action( 'tu_ext_item__slider', 'tu_ext_item__slider_overlay', 10, 1 );

add_action( 'tu_ext_item__slider_overlay', 'tu_ext_item__slider_overlay_start',   10, 1 );
add_action( 'tu_ext_item__slider_overlay', 'tu_ext_item__slider_elements',        20, 1 );
add_action( 'tu_ext_item__slider_overlay', 'tu_ext_item__slider_overlay_end',    999, 1 );

add_action( 'tu_ext_item__slider_elements', 'tu_ext_item__slider_elements_start',      10, 1 );
add_action( 'tu_ext_item__slider_elements', 'tu_ext_item__slider_elements_title',      20, 1 );
add_action( 'tu_ext_item__slider_elements', 'tu_ext_item__slider_elements_paragraph',  30, 1 );
add_action( 'tu_ext_item__slider_elements', 'tu_ext_item__slider_elements_buttons',    40, 1 );
add_action( 'tu_ext_item__slider_elements', 'tu_ext_item__slider_elements_end',       999, 1 );