<?php get_header(); ?>

<main role="main">
  <section>
    <h1><?php _e('Tag Archive: ', 'html5blank');
        echo single_tag_title('', false); ?></h1>
    <?php get_template_part('loop'); ?>
    <?php get_template_part('pagination'); ?>
  </section>
</main>
<?php get_footer(); ?>