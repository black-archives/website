<?php

/**
 * Template Name: Exhibition JB Section
 * 
 * This template is meant for one of the three James Barnor exhibition pages
 * (i.e. exhibition, biography and poem).
 */

get_header();
$current_page = get_post();

// load javascript for map page
wp_enqueue_script('help-js', get_template_directory_uri() . '/scripts/helper.js', array(), '1.0.0', true);
?>

<main role="main" class="tw-w-full tw-h-full tw-min-h-svh">
  <div class="tw-flex tw-flex-col tw-gap-5 tw-w-10/12 tw-mx-auto tw-mt-10 tw-pb-32">
    <div id="exhibition-header" class="tw-grid tw-grid-cols-2 tw-mt-10 tw-text-lg">
      <div id="exhibition-action" class="md:tw-items-start">
        <?php
        // get the current page's parent page
        $parent_page = get_post($post->post_parent);
        $parent_page_link = get_permalink($parent_page);
        ?>

        <a href=" <?= $parent_page_link; ?>">
          <div class="tw-px-2 tw-py-1 tw-border tw-border-black tw-text-center md:tw-p-3 md:tw-w-fit">
            Back
          </div>
        </a>
      </div>

      <div id="exhbition-language" class="tw-flex tw-gap-4 tw-justify-end md:tw-items-start">
        <button id="btn-lang-en" class="language-link">EN</button>
        <button id="btn-lang-sv" class="language-link">SV</button>
      </div>

      <div id="exhibition-title" class="tw-col-span-2 tw-flex tw-flex-col tw-justify-center md:tw-w-6/12 md:tw-mx-auto">
        <div id="exhibition-date" class="tw-w-full tw-mt-10 tw-text-center">
          <p>1 December 2024-19 January 2025</p>
        </div>

        <h1 class="tw-flex tw-flex-col tw-text-5xl md:tw-text-center md:tw-text-7xl">
          <span>James Barnor:</span>
          <span class="tw-italic">Transmissions</span>
        </h1>
      </div>
    </div>

    <!-- child page radios -->
    <div id="exhibition-nav" class="tw-flex tw-flex-col md:tw-flex-row md:tw-justify-evenly md:tw-gap-4 md:tw-w-6/12 md:tw-mx-auto">
      <?php
      $siblings = new WP_Query(array(
        'post_type' => 'page',
        'post_parent' => $post->post_parent,
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC'
      ));

      if ($siblings->have_posts()) :
        while ($siblings->have_posts()) : $siblings->the_post();
          $post_id = get_the_ID();
          $post_title = get_the_title();
          $post_link = get_permalink();
          $post_active = $post_id === $current_page->ID;
      ?>

          <div class="tw-my-1 tw-flex tw-gap-4">
            <a href="<?= $post_link; ?>">
              <span class="md:tw-text-xl">
                <?php if ($post_active) : ?>
                  <span class="tw-font-extrabold">-> <?= $post_title; ?></span>
                <?php else : ?>
                  -> <?= $post_title; ?>
                <?php endif; ?>
              </span>

            </a>
          </div>
      <?php
        endwhile;
      endif;
      // clear the previous query
      wp_reset_postdata();
      ?>
    </div>

    <div id="exhibition-body" class="md:tw-w-6/12 md:tw-mx-auto">
      <?= get_the_content(); ?>
    </div>
  </div>
</main>