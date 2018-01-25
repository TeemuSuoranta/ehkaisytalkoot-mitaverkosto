<?php
/**
 * The template for displaying the footer.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package mita
 */

?>

  </div><!-- #content -->

  <div class="cta-section">
    <div class="cta-bg">
    </div>
    <div class="cta-content">
      <span class="h2"><?php ask_e('CTA: Title'); ?></span>
      <a class="btn btn-cta" href="<?php echo esc_attr(ask__('CTA: URL')); ?>"><?php ask_e('CTA: Button'); ?></a>
    </div>
  </div>
  <div class="site-footer-wrap">
    <footer id="colophon" class="site-footer" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">
      <p><b><?php ask_e('Organization: Name'); ?></b></p>
      <p><?php ask_e('Footer: Description'); ?></p>
      <?php get_template_part('partials/menu-social'); ?>
    </footer><!-- #colophon -->
  </div>
  <div class="copyright">
    <div class="copyright-content">
      <span>Plan International Suomi | <?php ask_e('Organization: Name'); ?> | <?php echo date('Y'); ?></span>
    </div>
  </div>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
