<?php

/**
 * Template Name: Exhibition JB Section
 * 
 * This template is meant for one of the three James Barnor exhibition pages
 * (i.e. exhibition, biography and poem).
 */

get_header();
$current_page = get_post();
?>

<main role="main" class="tw-w-full tw-h-full tw-min-h-svh">
  <div class="tw-mt-10 tw-mx-auto tw-pb-32 tw-flex tw-flex-col tw-gap-2 tw-w-10/12 md:tw-justify-center">
    <div id="exhibition-header" class="tw-grid tw-grid-cols-2 md:tw-flex md:tw-justify-center">
      <div id="exhibition-action" class="tw-w-full tw-p-2 tw-flex md:tw-order-1 md:tw-mx-2 md:tw-basis-2/12 md:tw-justify-start">
        <?php
        // get the current page's parent page
        $parent_page = get_post($post->post_parent);
        $parent_page_link = get_permalink($parent_page);
        ?>

        <a href=" <?= $parent_page_link; ?>">
          <img src="<?= get_parent_theme_file_uri('assets/img/icons/arrow-left.svg'); ?>" alt="Back arrow" class="tw-w-14" />
        </a>
      </div>

      <div id="exhbition-language" class="tw-w-full tw-px-5 tw-py-2 tw-flex tw-gap-4 tw-justify-end tw-items-center md:tw-order-3 md:tw-mx-2 md:tw-p-2 md:tw-text-lg md:tw-basis-2/12 md:tw-justify-end md:tw-items-start">
        <?php
        // if current full path has '/sv/' then set the language to 'sv' otherwise set it to 'en'
        $language = (strpos($_SERVER['REQUEST_URI'], '/sv/') !== false) ? 'sv' : 'en';

        // get origin
        $current_origin = $_SERVER['HTTP_ORIGIN'];
        $current_path = $_SERVER['REQUEST_URI'];

        // remove '/sv' from path if it exists
        $current_path = str_replace('/sv', '', $current_path);

        // set base languages
        $lang_en = $current_origin . $current_path;
        $lang_sv = $current_origin . '/sv' . $current_path;
        ?>

        <a
          id="btn-lang-en"
          href="<?= $lang_en; ?>"
          class="<?= ($language === 'en') ? 'tw-underline' : ''; ?> hover:tw-text-black">
          ENG
        </a>

        <a
          id="btn-lang-sv"
          href="<?= $lang_sv; ?>"
          class="<?= ($language === 'sv') ? 'tw-underline' : ''; ?> hover:tw-text-black">
          SV
        </a>
      </div>

      <div id="exhibition-title" class="tw-col-span-2 tw-tw-flex tw-flex-col tw-justify-center md:tw-order-2 md:tw-grow">
        <div id="exhibition-text" class="tw-full tw-mt-5 tw-flex tw-flex-col tw-gap-2 tw-justify-center">
          <div class="tw-font-mono tw-text-center">
            <p>
              <?php
              $language = (strpos($_SERVER['REQUEST_URI'], '/sv/') !== false) ? 'sv' : 'en';
              echo ($language === 'sv') ? '1 December 2024-19 Januari 2025' : '1 December 2024-19 January 2025';
              ?>
            </p>
          </div>

          <h1 class="tw-mt-2 tw-flex tw-flex-col tw-text-5xl tw-text-center md:tw-text-7xl">
            <span>James Barnor:</span>
            <span class="tw-italic">Transmissions</span>
          </h1>
        </div>

        <div id="exhibition-nav" class="tw-mt-5 tw-font-mono tw-flex tw-flex-col md:tw-flex-row md:tw-justify-center md:tw-gap-5">
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

              <a href="<?= $post_link; ?>" class="tw-flex tw-gap-4 tw-place-items-center md:tw-gap-2">
                <span class="tw-pb-2 tw-text-5xl tw-flex tw-center md:tw-pb-1 md:tw-text-3xl">
                  <?php if ($post_active) : ?>
                    &#9679;
                  <?php else : ?>
                    &#9675;
                  <?php endif; ?>
                </span>

                <span>
                  <?= $post_title; ?>
                </span>
              </a>
          <?php
            endwhile;
          endif;
          // clear the previous query
          wp_reset_postdata();
          ?>
        </div>
      </div>
    </div>

    <div id="exhibition-body" class="tw-mt-10 md:tw-w-6/12 md:tw-mx-auto">
      <?= get_the_content(); ?>
    </div>
  </div>
</main>