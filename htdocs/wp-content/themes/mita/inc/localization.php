<?php
/**
 * Localization functions
 *
 * @package mita
 */

/**
 * Theme strings
 *
 * [0]: Unique ID for string (context)
 * [1]: Default string
 *
 * @return array translatable strings
 */
function mita_strings() {

  return array(

    // organizaton
    'Organization: Name'                => 'Mitä-verkosto',

    // menu
    'Menu: Button label'                => 'Menu',
    'Menu: Primary Menu'                => 'Päävalikko',
    'Menu: Social Menu'                 => 'Sosiaalisen median kanavat',

    // 404
    '404: Page not found'               => 'Hakemaasi sivua ei löytynyt',
    '404: Page not found description'   => 'Sivu on saatettu poistaa tai siirtää eri osoitteeseen. Käytä alla olevaa hakua löytääksesi etsimäsi.',

    // search
    'Search: Title'                      => 'Haku: ',
    'Search: Nothing found'              => 'Ei hakutuloksia',
    'Search: Nothing found description'  => 'Hakutuloksia ei löytynyt. Kokeile eri hakusanoja.',
    'Search: Placeholder'                => 'Etsi sivustolta...',
    'Search: Screen reader label'        => 'Etsi sivustolta',
    'Search: Submit'                     => 'Hae',

    // accessibility
    'Accessibility: Skip to content'     => 'Siirry sisältöön',

    // navigation
    'Navigation: Previous'               => 'Edellinen',
    'Navigation: Next'                   => 'Seuraava',

    // social
    'Social share: Title'                => 'Jaa sosiaalisessa mediassa',
    'Social share: Facebook'             => 'Facebook',
    'Social share: Twitter'              => 'Twitter',
    'Social share: LinkedIn'             => 'LinkedIn',

    // taxonomies
    'Taxonomies: Keywords'               => 'Avainsanat',
    'Taxonomies: Categories'             => 'Kategoriat',

    // call to action
    'CTA: Title'                         => 'Jätä oma tarinasi. Nimettömästi.',
    'CTA: Button'                        => 'Siirry kirjoittamaan',
    'CTA: URL'                           => '/laheta-tarinasi/',

    // stories
    'Stories: Newest title'              => 'Uusimmat tarinat',

    // footer
    'Footer: Description'                => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam pretium at lorem eget faucibus. Vivamus nulla tortor, pulvinar et tempor porttitor, pretium at magna. Donec sagittis ante lorem, et fermentum libero porttitor dapibus. Mauris suscipit, metus id semper consectetur.',

  );

}

/**
 * String translations
 */
if (function_exists('pll_register_string')) {
  $strings = mita_strings();
  foreach ($strings as $key => $value) {
    pll_register_string($key, $value, 'Mita-verkosto');
  }
}

/**
 * Get localized string by key
 *
 * @example ask__('Social share: Title')
 *
 * @param string $key unique identifier of string
 * @param string $lang 2-character language code (defaults to current language)
 *
 * @return string translated value or key if not registered string
 */
function ask__($key, $lang = null) {

  $strings = mita_strings();
  if (isset($strings[$key])) {
    if ($lang === null) {
      return pll__($strings[$key]);
    } else {
      return pll_translate_string($strings[$key], $lang);
    }
  }

  // debug missing strings
  if (WP_DEBUG === true) {

    // init warning to get source
    $e = new Exception('Localization error - Missing string by key {' . $key . '}');

    // find file and line for problem
    $trace_line ='';
    foreach ($e->getTrace() as $trace) {
      if (in_array($trace['function'], array('ask__', 'ask_e'))) {
        $trace_line = ' in ' . $trace['file'] . ':' . $trace['line'];
      }
    }

    // compose error message
    $error_msg = $e->getMessage() . $trace_line . ' ==> add it to /inc/localization.php';

    // trigger errors
    trigger_error($error_msg, E_USER_WARNING);
    error_log($error_msg);

  }

  return $key;

}

/**
 * Echo localized string by key
 *
 * @param string $key unique identifier of string
 * @param string $lang 2 character language code (defaults to current language)
 */
function ask_e($key, $lang = null) {

  echo ask__($key, $lang);

}

/**
 * Get localized string by value
 *
 * @example asv__('Social share: Title')
 *
 * @param string $value default value for string
 * @param string $lang 2 character language code (defaults to current language)
 *
 * @return string translated value or key if not registered string
 */
function asv__($value, $lang = null) {

  // debug missing strings
  if (WP_DEBUG === true) {
    $strings = mita_strings();
    if (array_search($value, $strings) === false) {

      // init warning to get source
      $e = new Exception('Localization error - Missing string by value {' . $value . '}');

      // find file and line for problem
      $trace_line = '';
      foreach ($e->getTrace() as $trace) {
        if (in_array($trace['function'], array('asv__', 'asv_e'))) {
          $trace_line = ' in ' . $trace['file'] . ':' . $trace['line'];
        }
      }

      // compose error message
      $error_msg = $e->getMessage() . $trace_line . ' ==> add it to /inc/localization.php';

      // trigger errors
      trigger_error($error_msg, E_USER_WARNING);
      error_log($error_msg);

    }
  }

  if ($lang === null) {
    return pll__($value);
  } else {
    return pll_translate_string($value, $lang);
  }

}

/**
 * Echo localized string by value
 *
 * @param string $value default value for string
 * @param string $lang 2 character language code (defaults to current language)
 */
function asv_e($value, $lang = null) {

  echo asv__($value, $lang);

}

/**
 * Get site locale
 *
 * @return string locale 2 character language code
 */
function mita_get_site_locale() {

  if (function_exists('pll_current_language')) {
    return pll_current_language();
  }

  $locale = get_locale();
  if (strlen($locale) >= 2) {
    return substr($locale, 0, 2);
  }

  // invalid locale
  return '';

}

/**
 * Fallback Polylang (preserve functionality without the plugin)
 */
if (!function_exists('pll__')) :
  function pll__($s) {
    return $s;
  }
  function pll_e($s) {
    echo $s;
  }
  function pll_esc_html_e($s) {
    echo esc_html($s);
  }
  function pll_esc_html__($s) {
    return esc_html($s);
  }
  function pll_esc_attr_e($s) {
    echo esc_attr($s);
  }
  function pll_esc_attr__($s) {
    return esc_attr($s);
  }
  function pll_current_language() {
    return mita_get_site_locale();
  }
  function pll_get_post_language($id) {
    return mita_get_site_locale();
  }
  function pll_get_post($post_id, $slug = '') {
    return $post_id;
  }
  function pll_get_term($term_id, $slug = '') {
    return $term_id;
  }
  function pll_translate_string($str, $lang = '') {
    return $str;
  }
  function pll_home_url($slug = '') {
    return get_home_url();
  }
endif;
