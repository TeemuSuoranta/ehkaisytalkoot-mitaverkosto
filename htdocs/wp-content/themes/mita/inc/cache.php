<?php
/**
 * Cache hooks and functions
 *
 * @package mita
 */

/**
 * Get last-edited timestamp
 *
 * @global array $mita_timestamps cached timestamp values
 *
 * @param string $asset ID of asset type
 *
 * @return int UNIX timestamp
 */
function mita_last_edited($asset = 'css') {

  global $mita_timestamps;

  // save timestamps to cache in global variable for this request
  if (empty($mita_timestamps)) {

    $filepath = get_template_directory() . '/assets/last-edited.json';

    if (file_exists($filepath)) {
      $json = file_get_contents($filepath);
      $mita_timestamps = json_decode($json, true);
    }

  }

  // use cached value from global variable
  if (isset($mita_timestamps[$asset])) {
    return absint($mita_timestamps[$asset]);
  }

  return 0;

}

/**
 * Clear WPP cache on reaction save
 *
 * Reaction Buttons plugin can't do this and won't give us proper hook.
 * Empty the whole WPP cache when vote is given.
 *
 * @param int    $meta_id the ID of meta row
 * @param int    $object_id the ID of post
 * @param string $meta_key the meta name
 * @param string $_meta_value the meta value
 */
function mita_flush_reaction_cache($meta_id, $object_id, $meta_key, $_meta_value) {

  if (strstr($meta_key, '_reaction_buttons_') && function_exists('_seravo_purge_cache')) {
    _seravo_purge_cache();
  }

}
add_action('updated_post_meta', 'mita_flush_reaction_cache', 10, 4);


/**
 * Save post metadata when a post is saved.
 *
 * @param int     $post_id The post ID.
 * @param WP_Post $post The post object.
 * @param bool    $update Whether this is an existing post being updated or not.
 */
function mita_flush_pending_cache($post_id, $post, $update) {

  $post_type = get_post_type($post_id);

  if ($post_type === 'post') {
    delete_transient('posts_pending');
  }

}
add_action('save_post', 'mita_flush_pending_cache', 10, 3);
