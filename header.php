<!DOCTYPE html>
<html lang="en">

<head>
  <title><?php bloginfo('name'); ?></title>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>

<body>

<nav class="attention-background">
  <div class="navbar container unpadded">
    <a href="/">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.svg" class="logo" alt="Logo">
    </a>
    <a href="/" class="brand">Website Name</a>
    <a
      id="navbar-button"
      href="#"
      class="navbar-menu-button turn-to-x"
      data-collapsed="true"
    ><span></span></a>
    <?php
    wp_nav_menu( array(
        'menu'              => 'primary',
        'theme_location'    => 'primary',
        'depth'             => 1,
        'container'         => false,
        'menu_id'           => 'navbar-collapse'
      )
    );
    ?>
  </div>
</nav>

<div class="content">
  <div class="container">
