<?php /* Template Name: Parent Page */ ?>

<?php get_header(); ?>
<main role="main" class="parent-page">
  <section class="front-heading">
    <div class="col-3-4">
      <h1><?= get_the_title(); ?></h1>
      <p>
        <?= get_the_content(); ?>
      </p>
    </div>
  </section>

  <section class="post-feed post-feed--single">
    <div class="flex">
      <?php
      // get all child pages
      $args = array(
        'post_parent' => $post->ID,
        'posts_per_page' => -1,
        'post_type' => 'page', //you can use also 'any'
      );

      $the_query = new WP_Query($args);

      if ($the_query->have_posts()):
        while ($the_query->have_posts()) : $the_query->the_post();
          $title = get_the_title();
          $subtitle = get_field('page_summary') ?: get_the_excerpt();
          $background_image_url = get_the_post_thumbnail_url(get_the_ID(), 'full') ?: '/wp-content/uploads/2021/03/Michael-Bild-2-700x687.jpg'; // Fallback image
      ?>
          <div class="col-f-1-3" style="background-image: url('<?php echo esc_url($background_image_url); ?>');">
            <a href="<?php echo get_permalink($page->ID); ?>">
              <div class="post-hover-box">
                <div class="top">
                  <h2><?php echo esc_html($title); ?></h2>
                </div>

                <div class="bottom">
                  <p><?php echo esc_html($subtitle); ?></p>
                  <button class="btn btn-primary"><?= _e('Support', ' bas'); ?> <img src="/wp-content/uploads/2021/03/Pil.svg" /></button>
                </div>
              </div>
            </a>
          </div>
      <?php endwhile;
      else: endif ?>
    </div>
  </section>
</main>

<?php get_footer(); ?>