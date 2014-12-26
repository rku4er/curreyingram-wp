<?php

/**
 * Clean up the_excerpt()
 */
add_filter('excerpt_more', 'roots_excerpt_more');

function roots_excerpt_more($more) {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'roots') . '</a>';
}


/**
 * Manage output of wp_title()
 */
add_filter('wp_title', 'roots_wp_title', 10);

function roots_wp_title($title) {
  if (is_feed()) {
    return $title;
  }

  $title .= get_bloginfo('name');

  return $title;
}


/**
 * Filtering the Wrapper: Custom Post Types
 */
add_filter('roots_wrap_base', 'roots_wrap_base_cpts');

function roots_wrap_base_cpts($templates) {
    $cpt = get_post_type();
    if ($cpt) {
       array_unshift($templates, 'base-' . $cpt . '.php');
    }
    return $templates;
}


/**
 * Search Filter
 */
add_action('pre_get_posts','search_filter');

function search_filter($query) {
  if ( !is_admin() && $query->is_main_query() ) {
    if ($query->is_search) {
      $query->set('post_type', 'post');
    }
  }
}


/**
 * Posts count Filter
 */
add_action( 'pre_get_posts', 'my_post_queries' );

function my_post_queries( $query ) {

  $home_posts = function_exists('get_field') ? get_field('posts_on_blog_page', 'options') : '';
  $category_posts = function_exists('get_field') ? get_field('posts_on_category_page', 'options') : '';

  // do not alter the query on wp-admin pages and only alter it if it's the main query
  if (!is_admin() && $query->is_main_query()){

    // alter the query for the home and category pages
    if(is_home()){
      $query->set('posts_per_page', $home_posts ? $home_posts : 4);
    }

    if(is_category()){
      $query->set('posts_per_page', $category_posts ? $category_posts : 4);
    }

  }
}


/**
 * Copyright shortcode
 */
add_shortcode('copyright', 'copyright_func');

function copyright_func($atts, $content = null) {
    extract( shortcode_atts( array(), $attr ) );

    $output = 'Copyright &copy; ' . date('Y') . ' ' . get_bloginfo('name') . '. All Rights Reserved Site by <a href="http://rippkedesign.com" target="_blank">Rippke Design</a>';

    return $output;
}


/**
 * Promo Tiles Shortcode
 */
add_shortcode('promo_tiles', 'promo_tiles_func');

function promo_tiles_func($atts, $content = null){
  extract( shortcode_atts( array(), $attr ) );

  $output = '';

  if(function_exists('get_field')){

    $size = 'promo';

    $promo_left_id = get_field('promo_left_image', 'options') ? get_field('promo_left_image', 'options') : '';
    $promo_left_img = wp_get_attachment_image_src($promo_left_id, $size, false);
    $promo_left_url = get_field('promo_left_url', 'options') ? get_field('promo_left_url', 'options') : '';

    $promo_right_id = get_field('promo_right_image', 'options') ? get_field('promo_right_image', 'options') : '';
    $promo_right_img = wp_get_attachment_image_src($promo_right_id, $size, false);
    $promo_right_url = get_field('promo_right_url', 'options') ? get_field('promo_right_url', 'options') : '';

    $output .= '<div class="tiles">';

    $output .= '<div class="tile visible-lg-block">';
    $output .= '<div class="inner">';
    $output .= '<a href="' . 'promo_left_url' . '" target="_blank"><img src="' . $promo_left_img[0] . '" alt=""></a>';
    $output .= '</div>';
    $output .= '</div>';

    $output .= '<div class="tile visible-lg-block">';
    $output .= '<div class="inner">';
    $output .= '<a href="' . 'promo_right_url' . '" target="_blank"><img src="' . $promo_right_img[0] . '" alt=""></a>';
    $output .= '</div>';
    $output .= '</div>';

    $output .= '</div>';
  }

  return $output;

}