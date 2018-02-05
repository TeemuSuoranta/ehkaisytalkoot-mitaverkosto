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
      // fetching meta without ACF functions because this is almost the only place it's used
      $orientation = get_post_meta(get_the_ID(), 'orientation', true);
      if (!empty($orientation)) :
    ?>
      <span class="h3 entry-header-meta"><?php echo esc_html($orientation); ?></span>
    <?php endif; ?>

    <?php
      $country = get_post_meta(get_the_ID(), 'country', true);
      if (!empty($country)) :
    ?>
      <span class="h3 entry-header-meta"><?php echo esc_html($country); ?></span>
    <?php endif; ?>

  </header><!-- .entry-header -->

  <div class="entry-content">
    <?php the_content(); ?>
  </div><!-- .entry-content -->

  <footer class="entry-footer">
  </footer><!-- .entry-footer -->
</article><!-- #post-## -->
