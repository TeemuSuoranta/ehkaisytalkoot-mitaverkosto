<?php
/**
 * Functions and definitions
 *
 * @package mita
 */

/**
 * Include features
 */
require_once 'inc/cache.php';                  // cache hooks and functions
require_once 'inc/forms.php';                  // forms
require_once 'inc/hide-users.php';             // hide users' identities
require_once 'inc/localization.php';           // localization strings and functions
require_once 'inc/menus.php';                  // menus
require_once 'inc/reactions.php';              // reactions
require_once 'inc/remove-commenting.php';      // remove commenting
require_once 'inc/wp-login.php';               // login screen
require_once 'inc/wp-settings.php';            // WP settings and optimization

/**
 * Include template functions
 */
require_once 'template-tags/buttons.php';      // buttons & social
require_once 'template-tags/icons.php';        // icons & SVG
require_once 'template-tags/meta.php';         // meta & time
require_once 'template-tags/navigation.php';   // navigation & hierarchial pages
require_once 'template-tags/search.php';       // search

/**
 * Set up theme defaults and register support for various WordPress features
 */
function mita_setup() {

  // enable support for post thumbnails
  add_theme_support('post-thumbnails');

  // custom image sizes
  // add_image_size($name, $width, $height, $crop);

  // automatic document title
  add_theme_support('title-tag');

  // menu locations
  register_nav_menus(array(
    'primary' => ask__('Menu: Primary Menu'),
    'social'  => ask__('Menu: Social Menu'),
  ));

  // use HTML5 markup
  add_theme_support('html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
  ));

}
add_action('after_setup_theme', 'mita_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet
 *
 * @global int $content_width the max width of content in pixels
 */
function mita_content_width() {

  $GLOBALS['content_width'] = apply_filters('mita_content_width', 640);

}
add_action('after_setup_theme', 'mita_content_width', 0);

/**
 * Register widget area
 */
function mita_widgets_init() {

  // register_sidebar(array(
  //   'name'          => esc_html__('Sidebar', 'mita'),
  //   'id'            => 'sidebar-1',
  //   'description'   => '',
  //   'before_widget' => '<section id="%1$s" class="widget %2$s">',
  //   'after_widget'  => '</section>',
  //   'before_title'  => '<h2 class="widget-title">',
  //   'after_title'   => '</h2>',
  // ));

}
add_action('widgets_init', 'mita_widgets_init');

/**
 * TinyMCE formats
 *
 * @link https://codex.wordpress.org/TinyMCE_Custom_Styles
 *
 * @param array $init TinyMCE settings
 *
 * @return array TinyMCE settings
 */
function mita_tinymce_formats($init) {

  // text formats
  $init['block_formats'] = 'Paragraph=p; Alaotsikko 2=h2; Alaotsikko 3=h3; Alaotsikko 4=h4';

  // cache busting
  $init['cache_suffix'] = mita_last_edited('css');

  return $init;

}
add_filter('tiny_mce_before_init', 'mita_tinymce_formats');

/**
 * Enqueue scripts and styles
 */
function mita_scripts() {

  // main css
  wp_enqueue_style('mita-style', get_template_directory_uri() . '/dist/styles/main.css', false, mita_last_edited('css'));

  // dependencies for js, if you need jQuery => array('jquery')
  $js_dependencies = array();

  // main js
  wp_enqueue_script('mita-js', get_template_directory_uri() . '/dist/scripts/main.js', $js_dependencies, mita_last_edited('js'), true);

  // comments
  if (is_singular() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

}
add_action('wp_enqueue_scripts', 'mita_scripts');

/**
 * Enqueue scripts and styles for admin
 */
function mita_admin_scripts() {

  wp_enqueue_style('mita_admin_css', get_template_directory_uri() . '/dist/styles/admin.css', false, mita_last_edited('css'));

}
add_action('admin_enqueue_scripts', 'mita_admin_scripts');

/**
 * Enqueue scripts and styles for TinyMCE
 */
function mita_tinymce_styles() {

  add_editor_style('dist/styles/editor.css');

}
add_action('admin_init', 'mita_tinymce_styles');

/**
 * Append to <head>
 */
function mita_append_to_head() {

  // replace class no-js with js in html tag
  echo "<script>(function(d){d.className = d.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";

}
add_action('wp_head', 'mita_append_to_head');

/**
 * Append to footer
 */
function mita_append_to_footer() {

}
add_action('wp_footer', 'mita_append_to_footer');

/**
 * Favicons
 *
 * Add favicons' <link> and <meta> tags here
 */
function mita_favicons() {

}
add_action('wp_head',    'mita_favicons');
add_action('admin_head', 'mita_favicons');
add_action('login_head', 'mita_favicons');


