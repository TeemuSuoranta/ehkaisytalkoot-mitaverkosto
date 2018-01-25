<?php
/**
 * Customize wp-login.php
 *
 * @package mita
 */

/**
 * Assets for login screen
 */
function mita_login_screen_assets() {

  wp_enqueue_style('mita-login-styles', get_stylesheet_directory_uri() . '/dist/styles/wp-login.css');

}
add_action('login_enqueue_scripts', 'mita_login_screen_assets');

/**
 * Logo title
 *
 * @param string $title login header title
 *
 * @return string site name
 */
function mita_login_logo_url_title($title) {

  return get_bloginfo('name');

}
add_filter('login_headertitle', 'mita_login_logo_url_title');


/**
 * Logo link
 *
 * @param string $url the url for logo link
 *
 * @return string site url
 */
function mita_login_logo_url($url) {

  return get_site_url();

}
add_filter('login_headerurl', 'mita_login_logo_url');
