<!-- This is the sidebar -->

<!doctype html>
<html <?php language_attributes(); ?> class="no-js">

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <title><?php wp_title(''); ?></title>

  <link href="//www.google-analytics.com" rel="dns-prefetch">
  <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.png" rel="shortcut icon">
  <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Epilogue&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Space+Mono&display=swap" rel="stylesheet">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
  <script>
    // conditionizr.com
    // configure environment tests
    conditionizr.config({
      assets: '<?php echo get_template_directory_uri(); ?>',
      tests: {}
    });
  </script>
</head>

<body <?php body_class('flex flex-space'); ?>>
  <header class="header clear" role="banner">
    <div class="main-header">
      <div class="left-menu">
        <div class="menu-hamburger">
          <img class="" src="/wp-content/uploads/2021/03/Meny.svg" alt="Menu icon">
        </div>
        <img class="header-logo" src="/wp-content/uploads/2021/03/logo-side.svg" alt="Black Archive Sweden Logo">
      </div>

      <nav class="nav" role="navigation">
        <div class="meny-cross">
          <img src="/wp-content/uploads/2021/03/Meny-kryss.svg" alt="Close menu cross">
        </div>

        <a href="<?php echo get_home_url(); ?>">
          <img class="menu-logo" src="/wp-content/uploads/2021/03/BAS-Logga.svg" alt="Black Archive Sweden Logo">
        </a>

        <?php html5blank_nav(); ?>

        <!-- search bar -->
        <div class="nav-footer flex flex-space vert-center" style="    margin-top: 15px;">
          <form class="search" method="get" action="<?php echo home_url(); ?>" role="search">
            <input class="search-input" type="search" name="s" placeholder="<?php _e('Search', 'html5blank'); ?>">
          </form>
          <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-area-2')) ?>
        </div>

        <!-- social media btns -->
        <div class="social-icons">
          <?php while (has_sub_field('social_media', 'option')): ?>
            <a href="<?php the_sub_field('url'); ?>" target="_blank"><?php the_sub_field('icons'); ?></a>
          <?php endwhile; ?>

          <?php while (has_sub_field('email', 'option')): ?>
            <a href="mailto:<?php the_sub_field('link'); ?>" target="_blank"><?php the_sub_field('icons'); ?></a>
          <?php endwhile; ?>
        </div>
      </nav>
    </div>

    <div class="mob-menu vert-center">
      <div>
        <img src="/wp-content/uploads/2021/03/BAS-Logga.svg" alt="Black Archive Sweden Logo" width="100">
      </div>
      <div class="menu-hamburger">
        <img class="" src="/wp-content/uploads/2021/03/Meny.svg" alt="Menu icon">
      </div>
    </div>
  </header>