<?php
/**
 * Template part: Teaser story
 *
 * @package mita
 */
?>

<a href="<?php the_permalink(); ?>" class="story-teaser">

 <div class="story-meta">
    <span class="author"><?php the_title(); ?></span>
  </div>

  <div class="excerpt"><?php the_excerpt(); ?></div>

  <?php mita_teaser_reactions(); ?>

</a>
