<?php

/**
 * This is the front page. It displays the latest posts and an open call.
 */

get_header();
?>

<main class="frontpage home tw-flex tw-flex-col">
  <section id="header" class="tw-p-10">
    <?php the_content(); ?>
  </section>

  <section id="content" class="tw-grid tw-grid-cols-1 md:tw-grid-cols-3">
    <?php
    $website_origin = get_site_url();
    $website_origin = $website_origin ? $website_origin : null;
    $map_image = $website_origin . '/wp-content/uploads/2024/10/karta-thumbnail-cropped.png';
    $map_title = 'The Swinging Town';

    // get website path
    $current_language = apply_filters('wpml_current_language', NULL);

    if ($current_language == 'sv') {
      $map_cta = 'Öppna kartan';
      $map_url = $website_origin . '/sv/the-swinging-town/';
    } else {
      $map_cta = 'Enter the map';
      $map_url = $website_origin . '/the-swinging-town/';
    }
    ?>

    <!-- custom map card -->
    <a href="<?= $map_url; ?>" class="tw-relative">
      <img class="tw-w-full" src="<?= $map_image; ?>" alt="thumbnail for map project">

      <div
        class="tw-absolute tw-inset-1 tw-m-5 tw-p-2 tw-flex tw-flex-col tw-justify-between"
        style="background: rgba(53, 162, 112, 0.95);">
        <div id="card-header">
          <h2><?= $map_title; ?></h2>
        </div>

        <div id="card-body" class="tw-mt-auto tw-w-full">
          <button class="btn btn-primary tw-w-full tw-flex">
            <?= $map_cta ?>
            <img src="/wp-content/uploads/2021/03/Pil.svg" />
          </button>
        </div>
      </div>
    </a>

    <!-- custom archive card -->
    <a href="https://www.blackarchivessweden.com/index-of-archival-projects-sites/">
      <img
        class="tw-w-full"
        src="https://www.blackarchivessweden.com/wp-content/uploads/2023/06/BAS_index_ig_1.jpg"
        alt="thumbnail for archive event">
    </a>

    <?php
    $args = array(
      'posts_per_page'    => -1,
      'post_type'     => 'post'
    );
    // query
    $the_query = new WP_Query($args);
    if ($the_query->have_posts()):
      while ($the_query->have_posts()) :
        $the_query->the_post();
    ?>
        <!-- post cards -->
        <a href="<?php the_permalink(); ?>" class="tw-relative md:tw-h-96">
          <?php if (has_post_thumbnail()): ?>
            <?php the_post_thumbnail(); ?>
          <?php endif; ?>

          <div
            class="tw-absolute tw-inset-1 tw-m-5 tw-p-2 tw-flex tw-flex-col tw-justify-between"
            style="background: rgba(53, 162, 112, 0.95);">
            <div id="card-header">
              <h2><?php echo wp_trim_excerpt(get_the_title()); ?></h2>
            </div>

            <div id="card-body" class="tw-mt-auto tw-w-full">
              <p class="show-desktop"><?php if (get_field('short_about')):  echo get_text_excerpt(get_field('short_about'));
                                      else: custom_length_excerpt(20);
                                      endif;   ?></p>
              <p class="show-ipad"><?php if (get_field('short_about')):  echo get_text_excerpt(get_field('short_about'), 10);
                                    else: custom_length_excerpt(8);
                                    endif;   ?></p>
              <ul class="cat-list">
                <?php
                $args = array(
                  'exclude' => '1'
                );
                $categories = get_the_category();
                foreach ($categories as $category) {
                  if ($category->name != "All") {
                    echo "<li>" . $category->name . "</li>";
                  }
                } ?>
              </ul>
            </div>
          </div>
        </a>
    <?php endwhile;
    endif;
    ?>
  </section>
</main>

<?php get_footer(); ?>