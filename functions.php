<?php
function svitas_theme_setup(){
    load_theme_textdomain('svitas', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'svitas_theme_setup');


add_theme_support('post-thumbnails');

add_theme_support( 'menus' );
if (function_exists('register_nav_menus'))
	register_nav_menus(array('menu' => 'Menu'));

function body_classes($classes) {
	global $post;

	foreach((get_the_category($post->ID)) as $category)
		$classes [] = 'cat-' . $category->cat_ID . '-id';

	if(has_post_thumbnail($post->ID))
		$classes[] = 'has_thumb';

	return $classes;
}
add_filter('post_class', 'body_classes');
add_filter('body_class', 'body_classes');