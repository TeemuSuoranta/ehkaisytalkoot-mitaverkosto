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

  ?>

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-11502833-12"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-11502833-12');
  </script>

  <!-- Facebook Pixel Code -->
  <script>
  !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
  n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
  document,'script','https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '740858182762703'); // Insert your pixel ID here.
  fbq('track', 'PageView');
  </script>
  <noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=740858182762703&ev=PageView&noscript=1"
  /></noscript>
  <!-- DO NOT MODIFY -->
  <!-- End Facebook Pixel Code -->

  <?php

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
  ?>
  <link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/assets/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/assets/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/assets/favicon/favicon-16x16.png">
  <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/assets/favicon/site.webmanifest">
  <link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/assets/favicon/safari-pinned-tab.svg" color="#e1e621">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="theme-color" content="#ffffff">
  <?php
}
add_action('wp_head',    'mita_favicons');
add_action('admin_head', 'mita_favicons');
add_action('login_head', 'mita_favicons');

/**
 * Add count to pending posts
 *
 * @param object $menu a WP menu object
 *
 * @return object $menu a WP menu object
 */
function mita_show_pending_number($menu) {

  $type = 'post';
  $status = 'pending';

  $num_posts = get_transient('posts_pending');
  if (empty($num_posts)) {
    $num_posts = wp_count_posts($type, 'readable');
    set_transient('posts_pending', $num_posts, HOUR_IN_SECONDS);
  }

  $pending_count = 0;
  if (!empty($num_posts->$status)) {
    $pending_count = $num_posts->$status;
  }

  // build string to match in $menu array
  $menu_str = 'edit.php';

  // loop through $menu items, find match, add indicator
  foreach ($menu as $menu_key => $menu_data) {
    if ($menu_str === $menu_data[2]) {
      $menu[$menu_key][0] .= " <span class='update-plugins count-$pending_count'><span class='plugin-count'>" . number_format_i18n($pending_count) . '</span></span>';
    }
  }
  return $menu;

}
add_filter('add_menu_classes', 'mita_show_pending_number');

/**
 * Show all languages on fi locale
 *
 * Needs to be on parse_query so that 'lang' parameter can be in action
 *
 * @param WP_Query $wp_query the instance of WP_Query
 */
function mita_show_all_locales_in_fi($wp_query) {

  if ($wp_query->is_main_query() && $wp_query->is_home() && !is_admin() && mita_get_site_locale() === 'fi') {

    // resetting the tax_query works when 'lang' paramteter won't
    $wp_query->set('tax_query', '');

  }

}
add_action('parse_query', 'mita_show_all_locales_in_fi', 10);

