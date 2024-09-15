<?php /* Template Name: Support Root Page */ ?>

<?php get_header(); ?>
<main role="main" class="support-page">
  <section class="front-heading">
    <div class="col-3-4">
      <h1><?= get_the_title(); ?></h1>
      <p>
        <?= get_the_content(); ?>
      </p>
    </div>
  </section>

  <section class="post-feed post-feed--single">
    <?php
    // get all child pages
    $args = array(
      'post_parent' => $post->ID,
      'posts_per_page' => -1,
      'post_type' => 'page', //you can use also 'any'
    );

    $the_query = new WP_Query($args);

    if ($the_query->have_posts()):
    ?>
      <div class="flex">
        <?php
        while ($the_query->have_posts()) : $the_query->the_post();
          $title = get_the_title();
          $subtitle = get_field('page_summary') ?: get_the_excerpt();
          $background_image_url = get_the_post_thumbnail_url(get_the_ID(), 'full') ?: '/wp-content/uploads/2021/03/Michael-Bild-2-700x687.jpg'; // Fallback image
        ?>
          <div class="col-f-1-3" style="background-image: url('<?php echo esc_url($background_image_url); ?>');">
            <div class="">
              <a href="<?php echo get_permalink($page->ID); ?>">
                <div class="post-hover-box">
                  <div class="top">
                    <h2><?php echo esc_html($title); ?></h2>
                    <p><?php echo esc_html($subtitle); ?></p>
                  </div>
                </div>
              </a>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>
  </section>
</main>

<?php get_footer(); ?>