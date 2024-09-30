<?php

/**
 * Name: Page
 * Description: This is a template for page templates. Simply 
 * copy the contents to a new file in the same directory and
 * name it something like page-about.php. Then you can edit
 * the content as you see fit.
 */

get_header();
?>

<main role="main">
  <?php if (have_posts()): while (have_posts()) : the_post(); ?>
      <?php the_content(); ?>
    <?php endwhile; ?>
  <?php endif; ?>
</main>

<?php get_footer(); ?>