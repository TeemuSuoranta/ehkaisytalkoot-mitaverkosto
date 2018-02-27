<?php
/**
 * Forms
 *
 * @package mita
 */

/**
 * Create a pending post from submission
 *
 * @todo target specific form instead of all forms
 *
 * @param object $return a generic status class
 */
function mita_form_submission_to_post($return) {

  if ($return->ok) {

    $age          = '';
    $gender       = '';
    $orientation  = '';
    $story        = '';
    $country      = '';
    $language     = '';

    if (isset($_POST['age'])) {
      $age = sanitize_text_field($_POST['age']);
    }

    if (isset($_POST['gender'])) {
      $gender = sanitize_text_field($_POST['gender']);
    }

    if (isset($_POST['orientation'])) {
      $orientation = sanitize_text_field($_POST['orientation']);
    }

    if (isset($_POST['location'])) {
      $country = sanitize_text_field($_POST['location']);
    }

    if (isset($_POST['language'])) {
      $language = sanitize_text_field($_POST['language']);
    }

    if (isset($_POST['story'])) {
      // can't do sanitize_text_field for story as it may have line breaks
      $story = wpautop(esc_html($_POST['story']));
    }

    // title should be "gender, age"
    $title = trim(esc_html($gender)) . ', ' . trim(esc_html($age));

    $args = array(
      'post_title'   => $title,
      'post_content' => $story,
      'post_status'  => 'pending',
    );

    $post_id = wp_insert_post($args);

    if (is_numeric($post_id)) {

      // save meta
      update_post_meta($post_id, 'age', trim($age));
      update_post_meta($post_id, 'gender', trim($gender));
      update_post_meta($post_id, 'orientation', trim($orientation));
      update_post_meta($post_id, 'country', trim($country));

      // set language
      if (function_exists('pll_set_post_language')) {
        pll_set_post_language($post_id, $language);
      }

    }

  }

}
add_action('wplf_post_validate_submission', 'mita_form_submission_to_post');


/**
 * Honeypot email field
 *
 * Field "email" is honeypot and if it's not empty, it's dem robots.
 *
 * @todo target specific form instead of all forms
 *
 * @param object $return a generic status class
 *
 * @return object $return a generic status class
 */
function mita_form_honeypot_validation($return) {

  if (isset($_POST['email']) && !empty($_POST['email'])) {
    $return->ok = 0;
    $return->error = 'You seem to be a spammer. Pls stop.';
  }

  return $return;

}
add_filter('wplf_validate_submission', 'mita_form_honeypot_validation', 100);

/**
 * Filter success message for translations
 *
 * @param string $success the message for succesful submit
 *
 * @return string $success the message for succesful submit
 */
function mita_success_message($success) {

  return ask__('Form: Success');

}
add_filter('wplf_success_message', 'mita_success_message');

