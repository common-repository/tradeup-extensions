<?php

/**
 * Blog Section
 */
add_action( 'tu_ext_part__blog', 'tu_ext_part__blog_wrap_start', 10 );
add_action( 'tu_ext_part__blog', 'tu_ext_part__blog_overlay',    20 );
add_action( 'tu_ext_part__blog', 'tu_ext_part__blog_container',  30 );
add_action( 'tu_ext_part__blog', 'tu_ext_part__blog_wrap_end',  999 );

add_action( 'tu_ext_part__blog_container', 'tu_ext_part__blog_container_start', 10 );
add_action( 'tu_ext_part__blog_container', 'tu_ext_part__blog_items',           20 );
add_action( 'tu_ext_part__blog_container', 'tu_ext_part__blog_container_end',  999 );

add_action( 'tu_ext_part__blog_items', 'tu_ext_part__blog_items_header', 10 );
add_action( 'tu_ext_part__blog_items', 'tu_ext_part__blog_items_posts',  20 );

add_action( 'tu_ext_part__blog_items_header', 'tu_ext_part__blog_items_header_start',          10 );
add_action( 'tu_ext_part__blog_items_header', 'tu_ext_part__blog_items_header_title',          20 );
add_action( 'tu_ext_part__blog_items_header', 'tu_ext_part__blog_items_header_description',    30 );
add_action( 'tu_ext_part__blog_items_header', 'tu_ext_part__blog_items_header_end',           999 );

add_action( 'tu_ext_part__blog_items_posts', 'tu_ext_part__blog_items_posts_start',    10 );
add_action( 'tu_ext_part__blog_items_posts', 'tu_ext_part__blog_items_posts_sizers',   20 );
add_action( 'tu_ext_part__blog_items_posts', 'tu_ext_part__blog_items_posts_loop',     30 );
add_action( 'tu_ext_part__blog_items_posts', 'tu_ext_part__blog_items_posts_end',     999 );
//add_action( 'tu_ext_part__blog_items_posts', 'tu_ext_part__blog_items_posts_js',     1010 );
add_action( 'tu_ext_part__blog_items_posts', 'tu_ext_part__blog_items_posts_action', 1020 );

add_action( 'tu_ext_part__blog_items_posts_loop_post', 'tu_ext_part__blog_items_posts_loop_post_start',   10 );
add_action( 'tu_ext_part__blog_items_posts_loop_post', 'tu_ext_part__blog_items_posts_loop_post_thumb',   20 );
add_action( 'tu_ext_part__blog_items_posts_loop_post', 'tu_ext_part__blog_items_posts_loop_post_title',   30 );
/*add_action( 'tu_ext_part__blog_items_posts_loop_post', 'tu_ext_part__blog_items_posts_loop_post_excerpt', 40 );*/
add_action( 'tu_ext_part__blog_items_posts_loop_post', 'tu_ext_part__blog_items_posts_loop_post_meta',    50 );
add_action( 'tu_ext_part__blog_items_posts_loop_post', 'tu_ext_part__blog_items_posts_loop_post_end',    999 );


/**
 * Team Section
 */
add_action( 'tu_ext_part__team', 'tu_ext_part__team_wrap_start', 10 );
add_action( 'tu_ext_part__team', 'tu_ext_part__team_overlay',    20 );
add_action( 'tu_ext_part__team', 'tu_ext_part__team_container',  30 );
add_action( 'tu_ext_part__team', 'tu_ext_part__team_wrap_end',  999 );

add_action( 'tu_ext_part__team_container', 'tu_ext_part__team_container_start', 10 );
add_action( 'tu_ext_part__team_container', 'tu_ext_part__team_items',           20 );
add_action( 'tu_ext_part__team_container', 'tu_ext_part__team_container_end',  999 );

add_action( 'tu_ext_part__team_items', 'tu_ext_part__team_items_header',  10 );
add_action( 'tu_ext_part__team_items', 'tu_ext_part__team_items_members', 20 );

add_action( 'tu_ext_part__team_items_header', 'tu_ext_part__team_items_header_start',          10 );
add_action( 'tu_ext_part__team_items_header', 'tu_ext_part__team_items_header_title',          20 );
add_action( 'tu_ext_part__team_items_header', 'tu_ext_part__team_items_header_description',    30 );
add_action( 'tu_ext_part__team_items_header', 'tu_ext_part__team_items_header_end',           999 );

add_action( 'tu_ext_part__team_items_members', 'tu_ext_part__team_items_members_start',     10 );
add_action( 'tu_ext_part__team_items_members', 'tu_ext_part__team_items_members_display',   20 );
add_action( 'tu_ext_part__team_items_members', 'tu_ext_part__team_items_members_end',      999 );



/**
 * Portfolio Section
 */
add_action( 'tu_ext_part__portfolio', 'tu_ext_part__portfolio_wrap_start', 10 );
add_action( 'tu_ext_part__portfolio', 'tu_ext_part__portfolio_overlay',    20 );
add_action( 'tu_ext_part__portfolio', 'tu_ext_part__portfolio_container',  30 );
add_action( 'tu_ext_part__portfolio', 'tu_ext_part__portfolio_wrap_end',  999 );

add_action( 'tu_ext_part__portfolio_container', 'tu_ext_part__portfolio_container_start', 10 );
add_action( 'tu_ext_part__portfolio_container', 'tu_ext_part__portfolio_items',           20 );
add_action( 'tu_ext_part__portfolio_container', 'tu_ext_part__portfolio_container_end',  999 );

add_action( 'tu_ext_part__portfolio_items', 'tu_ext_part__portfolio_items_header',   10 );
add_action( 'tu_ext_part__portfolio_items', 'tu_ext_part__portfolio_items_projects', 20 );
add_action( 'tu_ext_part__portfolio_items', 'tu_ext_part__portfolio_items_action',   30 );
//add_action( 'tu_ext_part__portfolio_items', 'tu_ext_part__portfolio_items_js',       40 );

add_action( 'tu_ext_part__portfolio_items_header', 'tu_ext_part__portfolio_items_header_start',          10 );
add_action( 'tu_ext_part__portfolio_items_header', 'tu_ext_part__portfolio_items_header_title',          20 );
add_action( 'tu_ext_part__portfolio_items_header', 'tu_ext_part__portfolio_items_header_description',    30 );
add_action( 'tu_ext_part__portfolio_items_header', 'tu_ext_part__portfolio_items_header_end',           999 );

add_action( 'tu_ext_part__portfolio_items_projects', 'tu_ext_part__portfolio_items_projects_start',     10 );
add_action( 'tu_ext_part__portfolio_items_projects', 'tu_ext_part__portfolio_items_projects_sizers',    20 );
add_action( 'tu_ext_part__portfolio_items_projects', 'tu_ext_part__portfolio_items_projects_display',   30 );
add_action( 'tu_ext_part__portfolio_items_projects', 'tu_ext_part__portfolio_items_projects_end',      999 );


/**
 * Testimonials Section
 */
add_action( 'tu_ext_part__testimonials', 'tu_ext_part__testimonials_wrap_start', 10 );
add_action( 'tu_ext_part__testimonials', 'tu_ext_part__testimonials_overlay',    20 );
add_action( 'tu_ext_part__testimonials', 'tu_ext_part__testimonials_container',  30 );
add_action( 'tu_ext_part__testimonials', 'tu_ext_part__testimonials_helper',     40 );
add_action( 'tu_ext_part__testimonials', 'tu_ext_part__testimonials_items',      50 );
add_action( 'tu_ext_part__testimonials', 'tu_ext_part__testimonials_nav',        60 );
add_action( 'tu_ext_part__testimonials', 'tu_ext_part__testimonials_js',         70 );
add_action( 'tu_ext_part__testimonials', 'tu_ext_part__testimonials_wrap_end',  999 );

add_action( 'tu_ext_part__testimonials_container', 'tu_ext_part__testimonials_container_start', 10 );
add_action( 'tu_ext_part__testimonials_container', 'tu_ext_part__testimonials_header',          20 );
add_action( 'tu_ext_part__testimonials_container', 'tu_ext_part__testimonials_container_end',  999 );

add_action( 'tu_ext_part__testimonials_header', 'tu_ext_part__testimonials_header_start',  10 );
add_action( 'tu_ext_part__testimonials_header', 'tu_ext_part__testimonials_header_title',  20 );
add_action( 'tu_ext_part__testimonials_header', 'tu_ext_part__testimonials_header_end',   999 );

add_action( 'tu_ext_part__testimonials_items', 'tu_ext_part__testimonials_items_start',    10 );
add_action( 'tu_ext_part__testimonials_items', 'tu_ext_part__testimonials_items_display',  20 );
add_action( 'tu_ext_part__testimonials_items', 'tu_ext_part__testimonials_items_end',     999 );

add_action( 'tu_ext_part__testimonials_nav', 'tu_ext_part__testimonials_nav_start',    10 );
add_action( 'tu_ext_part__testimonials_nav', 'tu_ext_part__testimonials_nav_prev',     20 );
add_action( 'tu_ext_part__testimonials_nav', 'tu_ext_part__testimonials_nav_next',     30 );
add_action( 'tu_ext_part__testimonials_nav', 'tu_ext_part__testimonials_nav_end',     999 );

/**
 * Slider Section
 */
add_action( 'tu_ext_part__slider', 'tu_ext_part__slider_wrap_start',   10 );
add_action( 'tu_ext_part__slider', 'tu_ext_part__slider_arrows',       20 );
add_action( 'tu_ext_part__slider', 'tu_ext_part__slider_items',        30 );
add_action( 'tu_ext_part__slider', 'tu_ext_part__slider_js',           40 );
add_action( 'tu_ext_part__slider', 'tu_ext_part__slider_wrap_end',    999 );

add_action( 'tu_ext_part__slider_items', 'tu_ext_part__slider_items_start',    10 );
add_action( 'tu_ext_part__slider_items', 'tu_ext_part__slider_items_display',  20 );
add_action( 'tu_ext_part__slider_items', 'tu_ext_part__slider_items_helper',   30 );
add_action( 'tu_ext_part__slider_items', 'tu_ext_part__slider_items_end',     999 );


/**
 * Call to Action
 */
add_action( 'tu_ext_part__actions', 'tu_ext_part__actions_display', 10 );
add_action( 'tu_ext_part__actions', 'tu_ext_part__actions_helper',  20 );


/**
 * About Section
 */
add_action( 'tu_ext_part__about', 'tu_ext_part__about_wrap_start', 10 );
add_action( 'tu_ext_part__about', 'tu_ext_part__about_overlay',    20 );
add_action( 'tu_ext_part__about', 'tu_ext_part__about_container',  30 );
add_action( 'tu_ext_part__about', 'tu_ext_part__about_wrap_end',  999 );

add_action( 'tu_ext_part__about_container', 'tu_ext_part__about_container_start',  10 );
add_action( 'tu_ext_part__about_container', 'tu_ext_part__about_header',           20 );
add_action( 'tu_ext_part__about_container', 'tu_ext_part__about_items',            30 );
add_action( 'tu_ext_part__about_container', 'tu_ext_part__about_button',           40 );
add_action( 'tu_ext_part__about_container', 'tu_ext_part__about_container_end',   999 );

add_action( 'tu_ext_part__about_header', 'tu_ext_part__about_header_start',        10 );
add_action( 'tu_ext_part__about_header', 'tu_ext_part__about_header_title',        20 );
add_action( 'tu_ext_part__about_header', 'tu_ext_part__about_header_description',  30 );
add_action( 'tu_ext_part__about_header', 'tu_ext_part__about_header_end',         999 );

add_action( 'tu_ext_part__about_items', 'tu_ext_part__about_items_start',    10 );
add_action( 'tu_ext_part__about_items', 'tu_ext_part__about_items_display',  20 );
add_action( 'tu_ext_part__about_items', 'tu_ext_part__about_items_helper',   30 );
add_action( 'tu_ext_part__about_items', 'tu_ext_part__about_items_end',     999 );



/**
 * Features Section
 */
add_action( 'tu_ext_part__features', 'tu_ext_part__features_wrap_start',  10 );
add_action( 'tu_ext_part__features', 'tu_ext_part__features_overlay',     20 );
add_action( 'tu_ext_part__features', 'tu_ext_part__features_container',   30 );
add_action( 'tu_ext_part__features', 'tu_ext_part__features_wrap_end',   999 );

add_action( 'tu_ext_part__features_container', 'tu_ext_part__features_container_start',  10 );
add_action( 'tu_ext_part__features_container', 'tu_ext_part__features_header',           20 );
add_action( 'tu_ext_part__features_container', 'tu_ext_part__features_items',            30 );
add_action( 'tu_ext_part__features_container', 'tu_ext_part__features_container_end',   999 );

add_action( 'tu_ext_part__features_header', 'tu_ext_part__features_header_start',        10 );
add_action( 'tu_ext_part__features_header', 'tu_ext_part__features_header_title',        20 );
add_action( 'tu_ext_part__features_header', 'tu_ext_part__features_header_description',  30 );
add_action( 'tu_ext_part__features_header', 'tu_ext_part__features_header_end',         999 );

add_action( 'tu_ext_part__features_items', 'tu_ext_part__features_items_start',    10 );
add_action( 'tu_ext_part__features_items', 'tu_ext_part__features_items_display',  20 );
add_action( 'tu_ext_part__features_items', 'tu_ext_part__features_helper',         30 );
add_action( 'tu_ext_part__features_items', 'tu_ext_part__features_items_end',     999 );