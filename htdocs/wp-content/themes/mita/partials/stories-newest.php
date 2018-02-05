<?php
/**
 * Template part: Stories (newest)
 *
 * @package mita
 */

?>

<div class="stories-newest">

  <span class="h2 stories-newest-title"><?php echo ask_e('Stories: Newest title'); ?></span>

  <div class="stories-container">

    <?php

      $args = array(
        'post_type' => 'post',
        'posts_per_page' => 6,
        'update_post_term_cache' => false,
      );

      // show all languages for fi locale
      if (mita_get_site_locale() === 'fi') {
        $args['lang'] = '';
      }

      $stories = new WP_Query($args);
      while ($stories->have_posts()) : $stories->the_post();
        get_template_part('partials/teaser-story');
      endwhile;

    ?>

    <span class="flex-filler story-teaser"></span>
    <span class="flex-filler story-teaser"></span>

  </div>

</div>
