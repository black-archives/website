<?php

/**
 * Template Name: Contact Page
 * 
 * This is the contact page.
 */

get_header();
?>

<main class="contact-page">
  <div class="wrap-m">
    <h1><?php the_title(); ?></h1>
    <div class="ingress"><?php the_content(); ?></div>
  </div>
</main>

<?php get_footer(); ?>