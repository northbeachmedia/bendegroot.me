<?php

/************* enqueuing ****************/

// css
function theme_styles() {
	// enable bootstrap
	wp_enqueue_style( 'bootstrap_flex_css', get_template_directory_uri() . '/css/bootstrap-flex.css' );
	wp_enqueue_style( 'bootstrap_grid_css', get_template_directory_uri() . '/css/bootstrap-grid.css' );
	wp_enqueue_style( 'bootstrap_reboot_css', get_template_directory_uri() . '/css/bootstrap-reboot.css' );
	wp_enqueue_style( 'bootstrap_css', get_template_directory_uri() . '/css/bootstrap.css' );
	// main (filemtime function ensures the latest version is loaded)
	wp_enqueue_style( 'main_css', get_stylesheet_directory_uri() . '/css/main.css', array(), filemtime( get_stylesheet_directory() . '/css/main.css' ) );
}
add_action( 'wp_enqueue_scripts', 'theme_styles' );

// javascript
function theme_js() {
	// jquery 3.2.1
	wp_enqueue_script( 'jquery_scripts', get_template_directory_uri() . '/js/jquery.min.js', array(), '', true );
	// tether
	wp_enqueue_script( 'tether', get_template_directory_uri() . '/js/bootstrap/tether.min.js', array(), '', true );
	// bootstrap
	wp_enqueue_script( 'bootstrap_js', get_template_directory_uri() . '/js/bootstrap/bootstrap.min.js', array(), '', true );
	// ie10 viewport hack for Surface/desktop Windows 8 bug
	wp_enqueue_script( 'viewport_hack', get_template_directory_uri() . '/js/bootstrap/ie10-viewport-bug-workaround.min.js', array(), '', true );
	// smooth scroll
	wp_enqueue_script( 'smooth_scroll', get_template_directory_uri() . '/js/smooth-scroll.js', array(), '', true );
	// custom javascript file not in use
	// wp_enqueue_script( 'custom_javascript', get_template_directory_uri() . '/js/custom-jquery.js', array(), '', true );
}
add_action( 'wp_enqueue_scripts', 'theme_js' );


/************* adding theme support ****************/

// thumbnails
add_theme_support( 'post-thumbnails');


/************* clean up wordpress excess  ****************/

function clean_up_excess() {
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10) ;

	// remove the extra rss feed from single posts
	remove_action( 'wp_head', 'feed_links_extra', 3 );

	// remove oembed discovery links from single posts
	remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);

	add_filter( 'show_admin_bar','__return_false' );
	add_filter( 'the_generator', '__return_false' );

	// remove dns prefetch
	add_filter( 'emoji_svg_url', '__return_false' );

	// remove emoji styles and css
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );

	// remove rest api link tag
	remove_action('wp_head', 'rest_output_link_wp_head', 10);
}
add_action('after_setup_theme', 'clean_up_excess');

// remove wp-embed.min.js
function deactivation_script() {
	wp_dequeue_script( 'wp-embed' );
}
add_action( 'wp_footer', 'deactivation_script');

?>
