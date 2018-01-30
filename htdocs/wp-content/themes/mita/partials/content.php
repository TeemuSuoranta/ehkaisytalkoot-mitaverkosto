<?php
/**
 * Template part: Generic content template
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package mita
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <header class="entry-header">

    <?php the_title('<h1 class="entry-title">', '</h1>'); ?>

    <?php
      // fetching meta without ACF functions because this is really the only place it's used
      $orientation = get_post_meta(get_the_ID(), 'orientation', true);
      if (!empty($orientation)) :
     ?>
    <span class="h3"><?php echo esc_html($orientation); ?></span>
    <?php endif; ?>

    <div class="entry-meta">
    </div><!-- .entry-meta -->

  </header><!-- .entry-header -->

  <div class="entry-content">
    <?php the_content(); ?>
  </div><!-- .entry-content -->

  <footer class="entry-footer">
  </footer><!-- .entry-footer -->
</article><!-- #post-## -->
