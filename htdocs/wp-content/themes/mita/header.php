<?php
/**
 * Header
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package mita
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

<div id="page" class="site">
  <a class="skip-to-content screen-reader-text" href="#main"><?php ask_e('Accessibility: Skip to content'); ?></a>

  <header id="masthead" class="site-header" role="banner" itemscope itemtype="http://schema.org/WPHeader">

    <div class="site-branding">

      <span class="site-title">
        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" itemprop="headline">
          <span class="screen-reader-text"><?php bloginfo('name'); ?></span>
          <img class="site-logo" alt="" src="<?php echo get_template_directory_uri(); ?>/dist/images/mita-verkosto.png" />
        </a>
      </span>

      <?php mita_menu_toggle_btn('menu-toggle'); ?>

    </div><!-- .site-branding -->

    <?php get_template_part('partials/menu-primary'); ?>

  </header><!-- #masthead -->

  <?php get_template_part('partials/hero'); ?>

  <div id="content" class="site-content" itemscope itemprop="mainContentOfPage">
