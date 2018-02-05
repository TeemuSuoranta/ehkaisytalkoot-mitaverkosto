<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package mita
 */

get_header(); ?>

  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

    <?php while (have_posts()) : the_post(); ?>

      <?php get_template_part('partials/content'); ?>



    <?php endwhile; ?>

    <div class="posts-navigation">
      <div class="next">
        <?php next_post_link('%link', mita_get_svg('caret-right') . ask__('Navigation: Next')); ?>
      </div>
      <div class="prev">
        <?php previous_post_link('%link', ask__('Navigation: Previous') . mita_get_svg('caret-right')); ?>
      </div>
    </div>

    </main><!-- #main -->
  </div><!-- #primary -->

<?php
get_footer();
