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
      $stories = new WP_Query($args);
    while ($stories->have_posts()) : $stories->the_post();
    ?>
      <a href="<?php the_permalink(); ?>" class="story-teaser">

       <div class="story-meta">
          <span class="author"><?php echo esc_html(get_field('gender')); ?>, <?php echo esc_html(get_field('age')); ?></span>
        </div>

        <div class="excerpt"><?php the_excerpt(); ?></div>

        <?php
        //dw_reactions($post_id = false, $button = false);
        mita_teaser_reactions();
        ?>

      </a>
    <?php endwhile; ?>

    <span class="flex-filler story-teaser"></span>
    <span class="flex-filler story-teaser"></span>

  </div>

</div>
