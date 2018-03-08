<?php

/* Custom Posts Types for Homepage Slider
============================================*/

add_action( 'init', 'slideshow_register' );

function slideshow_register() {
	$labels = array(
		'name'               => _x( 'Slideshow', 'post type general name', 'wpzoom' ),
		'singular_name'      => _x( 'Slideshow Item', 'post type singular name', 'wpzoom' ),
		'add_new'            => _x( 'Add New', 'slideshow item', 'wpzoom' ),
		'add_new_item'       => __( 'Add New Slideshow Item', 'wpzoom' ),
		'edit_item'          => __( 'Edit Slideshow Item', 'wpzoom' ),
		'new_item'           => __( 'New Slideshow Item', 'wpzoom' ),
		'view_item'          => __( 'View Slideshow Item', 'wpzoom' ),
		'search_items'       => __( 'Search Slideshow', 'wpzoom' ),
		'not_found'          => __( 'Nothing found', 'wpzoom' ),
		'not_found_in_trash' => __( 'Nothing found in Trash', 'wpzoom' ),
		'parent_item_colon'  => ''
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'hierarchical'       => false,
		'menu_position'      => 20,
		'menu_icon'          => 'dashicons-slides',
		'supports'           => array( 'title', 'editor', 'thumbnail' )
	);

	register_post_type( 'slider', $args );
}