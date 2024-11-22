<?php

/**
 * Template Name: Exhibition JB Start
 * 
 * This template is meant for the James Barnor exhibition start page.
 */

get_header();
?>

<main role="main" class="tw-bg-black tw-text-white">
  <div class="tw-min-h-svh tw-mt-10 tw-flex tw-flex-col tw-gap-5 md:tw-mt-0 md:tw-justify-center">

    <div id="exhibition-header" class="tw-mt-5 tw-grid tw-grid-cols-2 md:tw-flex md:tw-justify-center">
      <div id="exhibition-action" class="tw-w-full tw-p-2 tw-flex md:tw-order-1 md:tw-basis-3/12 md:tw-justify-center">
        <?php

        /**
         * Query wordpress for a page that is a child of the current page
         * which also has the lowest 'order' value.
         */
        $exhibition_page = new WP_Query([
          'post_type' => 'page',
          'post_parent' => get_the_ID(),
          'posts_per_page' => 1,
          'orderby' => 'menu_order',
          'order' => 'ASC'
        ]);

        $exhibition_page_link = get_permalink($exhibition_page->posts[0]->ID);
        ?>

        <a href=" <?= $exhibition_page_link; ?>">
          <div class="tw-font-mono tw-px-2 tw-py-1 tw-w-5/6 tw-border tw-border-white tw-text-center md:tw-py-3 md:tw-px-10 md:tw-w-fit hover:tw-text-white">
            <?php
            // set language to 'sv' if the url path contains '/sv/'
            $language = (strpos($_SERVER['REQUEST_URI'], '/sv/') !== false) ? 'sv' : 'en';

            // if language is 'sv' then set text to 'Om utställningen'
            // otherwise set text to 'About the exhibition'
            echo ($language === 'sv') ? 'Om utställningen' : 'About the exhibition';
            ?>
          </div>
        </a>
      </div>

      <div id="exhbition-language" class="tw-w-full tw-p-2 tw-flex tw-gap-4 tw-justify-center tw-items-center hover:tw-text-white md:tw-text-lg md:tw-order-3 md:tw-basis-3/12 md:tw-justify-center md:tw-items-start">
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
          class="<?= ($language === 'en') ? 'tw-underline' : ''; ?>">
          ENG
        </a>

        <a
          id="btn-lang-sv"
          href="<?= $lang_sv; ?>"
          class="<?= ($language === 'sv') ? 'tw-underline' : ''; ?>">
          SV
        </a>
      </div>

      <div id="exhibition-title" class="tw-col-span-2 tw-full tw-mt-5 tw-flex tw-flex-col tw-gap-2 tw-justify-center md:tw-order-2 md:tw-grow">
        <div class="tw-font-mono tw-text-center">
          <p>1 December 2024-19 January 2025</p>
        </div>

        <h1 class="tw-mt-2 tw-flex tw-flex-col tw-text-5xl tw-text-center md:tw-text-7xl">
          <span>James Barnor:</span>
          <span class="tw-italic">Transmissions</span>
        </h1>
      </div>
    </div>

    <div id="exhibition-body" class="tw-text-center tw-w-10/12 tw-mx-auto md:tw-w-6/12">
      <?= get_the_content(); ?>
    </div>

    <div id="exhibition-thumbnails" class="tw-w-10/12 tw-mx-auto tw-flex tw-flex-col tw-gap-10 md:tw-grow md:tw-w-6/12 md:tw-mx-auto md:tw-flex-row md:tw-justify-center">
      <?php if (have_rows('images')) :
        while (have_rows('images')) : the_row();
          $image = get_sub_field('image');
          $image_source = $image['url'];
          $image_alt = $image['alt'];
      ?>
          <img src="<?= $image_source; ?>" alt="<?= $image_alt; ?>" class="md:tw-w-6/12">
        <?php endwhile; ?>
      <?php endif; ?>
    </div>

    <div id="exhibition-sponsors" class="tw-mt-10 tw-mb-5 tw-w-11/12 tw-mx-auto tw-flex tw-flex-col tw-gap-5 md:tw-px-10 md:tw-w-full md:tw-flex-row md:tw-justify-between">
      <?php if (have_rows('sponsors_secondary')): ?>
        <div class="tw-grid tw-grid-cols-2 tw-gap-4 tw-place-items-center md:tw-flex md:tw-gap-7">
          <?php while (have_rows('sponsors_secondary')) : the_row();
            $image = get_sub_field('image');
            $image_source = $image['url'];
            $image_alt = $image['alt'];
          ?>
            <div>
              <img src="<?= $image_source; ?>" alt="<?= $image_alt; ?>" class="tw-max-w-40 tw-max-h-16 md:tw-max-w-32 md:tw-max-h-16">
            </div>
          <?php endwhile; ?>
        </div>
      <?php endif; ?>

      <?php if (have_rows('sponsors_primary')): ?>
        <div class="tw-flex tw-gap-2 tw-place-items-end">
          <div class="tw-w-fit tw-text-xs md:tw-text-md">Med stöd av</div>
          <?php while (have_rows('sponsors_primary')) : the_row();
            $image = get_sub_field('image');
            $image_source = $image['url'];
            $image_alt = $image['alt'];
          ?>
            <div>
              <img src="<?= $image_source; ?>" alt="<?= $image_alt; ?>" class="tw-max-w-40 tw-max-h-16 md:tw-max-w-32 md:tw-max-h-16">
            </div>
          <?php endwhile; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</main>