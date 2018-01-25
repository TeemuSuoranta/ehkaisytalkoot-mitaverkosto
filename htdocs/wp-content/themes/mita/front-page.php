<?php
/**
 * Template: Front page
 *
 * @package mita
 */

get_header(); ?>

  <div id="primary" class="content-area">

    <main id="main" class="site-main" role="main">
      <div class="main-content">
      <?php while (have_posts()) : the_post(); ?>
        <?php the_content(); ?>
      <?php endwhile; ?>
      </div>
    </main><!-- #main -->

    <aside>
      <?php get_template_part('partials/stories-newest'); ?>
    </aside>

  </div><!-- #primary -->

<?php
get_footer();
