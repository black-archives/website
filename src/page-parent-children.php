<?php

/**
 * Template Name: Parent Children Page
 * 
 * This template displays the contents of the current page and lists all child
 * pages of the current page in a grid layout.
 */

get_header();
?>

<main role="main" class="parent-children-page">
  <section class="front-heading">
    <div class="col-3-4">
      <h1><?= get_the_title(); ?></h1>
      <p><?= get_the_content(); ?></p>
    </div>
  </section>

  <section class="post-feed post-feed--single">
    <div class="flex owl-carousel">
      <?php
      // get all child pages
      $args = array(
        'post_parent' => $post->ID,
        'posts_per_page' => -1,
        'post_type' => 'page',
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
                  <p><?php echo get_text_excerpt(esc_html($subtitle)); ?></p>

                  <button class="btn btn-primary tw-w-full tw-flex md:tw-w-auto">
                    <img src="/wp-content/uploads/2021/03/Pil.svg" />
                  </button>
                </div>
              </div>
            </a>
          </div>
      <?php endwhile;
      endif; ?>

      <?php
      // Reset Post Data
      wp_reset_postdata();

      // Display cards from ACF repeater fieldm, if available
      while (have_rows('cards')) : the_row();
        $card_image = get_sub_field('image')['url'];
        $card_title = get_sub_field('title');
        $card_summary = get_sub_field('summary');
        $card_call_to_action = get_sub_field('call_to_action');
        $card_link = get_sub_field('link');
        $card_show_button = get_sub_field('show_button');
      ?>
        <?php if (!empty($card_link)): ?>
          <a href="<?= $card_link ?>">
          <?php endif; ?>
          <div class="col-f-1-3" style="background-image: url('<?= $card_image ?>');">
            <div class="post-hover-box">
              <div class="top">
                <h2><?= $card_title ?></h2>
              </div>

              <div class="bottom">
                <p><?php echo get_text_excerpt($card_summary); ?></p>

                <?php if ($card_show_button): ?>
                  <button class="btn btn-primary tw-w-full tw-flex md:tw-w-auto">
                    <?= $card_call_to_action ?>
                    <img src="/wp-content/uploads/2021/03/Pil.svg" />
                  </button>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <?php if (!empty($card_link)): ?>
          </a>
        <?php endif; ?>
      <?php endwhile; ?>
    </div>
  </section>
</main>

<?php get_footer(); ?>