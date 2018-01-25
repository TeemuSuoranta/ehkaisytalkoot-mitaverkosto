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
