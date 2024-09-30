<?php

/**
 * Template Name: Content Only
 * 
 * This is a template for pages that only contain content. It will display 
 * the content of the page excluding the title.
 */

get_header();
?>

<main role="main">
  <?php the_content(); ?>
</main>

<?php get_footer(); ?>