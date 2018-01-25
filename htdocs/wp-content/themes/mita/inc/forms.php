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

    if (isset($_POST['age'])) {
      $age = sanitize_text_field($_POST['age']);
    }

    if (isset($_POST['gender'])) {
      $gender = sanitize_text_field($_POST['gender']);
    }

    if (isset($_POST['orientation'])) {
      $orientation = sanitize_text_field($_POST['orientation']);
    }

    if (isset($_POST['story'])) {
      $story = sanitize_text_field($_POST['story']);
    }

    // title should be "gender, age"
    $title = trim(esc_html($gender)) . ', ' . trim(esc_html($age));

    $args = array(
      'post_title'   => $title,
      'post_content' => $story,
      'post_status'  => 'pending',
    );

    $post_id = wp_insert_post($args);

    // save meta
    if (is_numeric($post_id)) {

      update_post_meta($post_id, 'age', trim($age));
      update_post_meta($post_id, 'gender', trim($gender));
      update_post_meta($post_id, 'orientation', trim($orientation));

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
  }

  return $retrun;

}
//add_action('wplf_validate_submission', 'mita_form_honeypot_validation');



