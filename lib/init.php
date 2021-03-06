<?php
/**
 * Roots initial setup and constants
 */
function roots_setup() {
  // Make theme available for translation
  // Community translations can be found at https://github.com/roots/roots-translations
  load_theme_textdomain('roots', get_template_directory() . '/lang');

  // Register wp_nav_menu() menus
  // http://codex.wordpress.org/Function_Reference/register_nav_menus
  register_nav_menus(array(
    'primary_navigation' => __('Primary Navigation', 'roots')
  ));

  // Add post thumbnails
  // http://codex.wordpress.org/Post_Thumbnails
  // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
  // http://codex.wordpress.org/Function_Reference/add_image_size
  add_theme_support('post-thumbnails');
  add_image_size('slider', 916, 419, true);
  add_image_size('promo', 419, 419, true);

  // Add post formats
  // http://codex.wordpress.org/Post_Formats
  //add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio'));

  // Add HTML5 markup for captions
  // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
  add_theme_support('html5', array('caption'));

  // Tell the TinyMCE editor to use a custom stylesheet
  add_editor_style('/assets/css/editor-style.css');

  // Runing shortcodes in text widgets
  add_filter('widget_text', 'do_shortcode');
}
add_action('after_setup_theme', 'roots_setup');

/**
 * Register sidebars
 */
add_action('widgets_init', 'roots_widgets_init');

function roots_widgets_init() {
  register_sidebar(array(
    'name'          => __('Primary', 'roots'),
    'id'            => 'sidebar-primary',
    'before_widget' => '<section class="well widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>',
  ));

  register_sidebar(array(
    'name'          => __('Footer', 'roots'),
    'id'            => 'sidebar-footer',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>',
  ));
}


/**
 * Custom post type
 */
add_action( 'init', 'create_tax' );

function create_tax() {
  register_taxonomy(
    'category_camps',
    'camps',
    array(
      'label' => __( 'Camps Category' ),
      'rewrite' => array( 'slug' => 'category-camps' ),
      'hierarchical' => true,
    )
  );
}

add_action( 'init', 'create_post_type' );

function create_post_type() {

  register_post_type( 'camps',
    array(
      'labels' => array(
        'name' => __( 'Camps' ),
        'singular_name' => __( 'Camp' ),
        'add_new' => __( 'Add Camp' ),
        'add_new_item' => __( 'Add New Camp' ),
      ),
      'rewrite' => array('slug' => 'camps'),
      'menu_icon' => 'dashicons-flag',
      'public' => true,
      'hierarchical' => true,
      'has_archive' => true,
      'menu_position' => 5,
      'supports' => array(
        'title',
        'editor',
        'excerpt',
        'thumbnail'
      ),
      'can_export' => true
    )
  );

}
