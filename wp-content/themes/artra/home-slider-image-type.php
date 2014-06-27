<?php

add_theme_support('post-thumbnails', array('homeslider-image'));

function create_home_slider() {
	register_post_type( 'homeslider-image',
		array(
			'labels' => array(
				'name' => __( 'Home Slider Images' ),
				'singular_name' => __( 'Home Slider Image' )
			),
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post', 
        'hierarchical' => false, 
        'rewrite' => true, 
        'supports' => array('title', 'editor', 'thumbnail')
		)
	);
}

add_action( 'init', 'create_home_slider' );


?>