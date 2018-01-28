<?php
/**
 * Reactions
 *
 * @package mita
 */

/**
 * Reaction buttons
 */

function mita_reactions($content) {
  if (is_singular('post') && function_exists('reaction_buttons_html')) {
    $content .= '<div class="reactions"><span class="title h3">' . ask__('Reactions: Title') . '</span>' . reaction_buttons_html() . '</div>';
  }
  return $content;
}
add_filter('the_content', 'mita_reactions');

/**
 * Teaser reactions
 *
 * Show emojis that have gotten at least one vote.
 *
 * @see /plugins/reaction-buttons/reaction_buttons.php
 */

function mita_teaser_reactions() {

  // get the buttons and strip whitespaces
  $buttons = array();
  $buttons_regex = explode(',', preg_replace('/,\s+/', ',', get_option('reaction_buttons_button_names')));

  foreach ($buttons_regex as $id => $button) {

    $count = intval(get_post_meta(get_the_ID(), '_reaction_buttons_' . $id, true));

    if ($count > 0) {
      $buttons[$id] = array(
        'name' => $button,
        'count' => $count
      );
    }

  }

  if (empty($buttons)) {
    return;
  }

  // sort reactions by count
  usort($buttons, function ($a, $b) {
    return $b['count'] - $a['count'];
  });

  ?>

  <ul class="reactions-teaser">

    <?php foreach ($buttons as $key => $button) : ?>

      <li>
        <span class="label"><?php echo esc_html($button['name']); ?></span>
        <span class="count"><?php echo absint($button['count']); ?></span>
      </li>

    <?php endforeach; ?>

  </ul>

  <?php

}
