<?php

/**
 * This is a default template for page templates. You can copy it to create a new
 * page template. For example, if you want to create a new page called "About", 
 * you can create a new file in the same directory and name it page-about.php.
 */

get_header();
?>

<main role="main">
  <section class="front-heading">
    <div class="col-3-4">
      <h1><?= get_the_title(); ?></h1>
    </div>
  </section>

  <?php if (have_posts()): while (have_posts()) : the_post(); ?>
      <?php the_content(); ?>
    <?php endwhile; ?>
  <?php endif; ?>
</main>

<?php get_footer(); ?>