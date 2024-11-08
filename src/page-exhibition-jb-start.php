<?php

/**
 * Template Name: Exhibition JB Start
 * 
 * This template is meant for the James Barnor exhibition start page.
 */

get_header();
?>

<main role="main" class="tw-bg-black tw-text-white tw-w-full tw-h-full tw-min-h-svh">
  <div class="tw-flex tw-flex-col tw-gap-5 tw-w-10/12 tw-mx-auto tw-mt-10 tw-pb-32">
    <div id="exhibition-header" class="tw-grid tw-grid-cols-2 tw-mt-10 tw-text-lg md:tw-flex">
      <div id="exhibition-action" class="md:tw-order-1 md:tw-items-start">
        <?php
        // get link to child page with the title 'Exhibition'
        $exhibition_page = new WP_Query(array(
          'post_type' => 'page',
          'post_parent' => get_the_ID(),
          'posts_per_page' => 1,
          's' => 'Exhibition'
        ));
        $exhibition_page_link = get_permalink($exhibition_page->posts[0]->ID);
        ?>

        <a href=" <?= $exhibition_page_link; ?>">
          <div class="tw-font-mono tw-px-2 tw-py-1 tw-w-2/3 tw-border tw-border-white tw-text-center md:tw-py-3 md:tw-px-10 md:tw-w-full hover:tw-text-white">
            About the exhibition
          </div>
        </a>
      </div>

      <div id="exhbition-language" class="tw-flex tw-gap-4 tw-justify-end md:tw-items-start hover:tw-text-white">
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
    </div>

      <div id="exhibition-title" class="tw-col-span-2 tw-flex tw-flex-col tw-justify-center md:tw-order-2 md:tw-items-start md:tw-w-6/12 md:tw-mx-auto">
      <div id="exhibition-date" class="tw-font-mono tw-w-full tw-text-center">
        <p>1 December 2024-19 January 2025</p>
      </div>

        <h1 class="tw-flex tw-flex-col tw-text-5xl md:tw-text-8xl">
          <span>James Barnor:</span>
          <span class="tw-italic">Transmissions</span>
        </h1>
      </div>
    </div>

    <div id="exhibition-body" class="tw-text-center md:tw-w-6/12 md:tw-mx-auto">
      <?= get_the_content(); ?>
    </div>

    <div id="exhibition-thumbnails" class="tw-flex tw-flex-col tw-gap-10 md:tw-flex-row md:justify-center md:tw-w-9/12 md:tw-mx-auto">
      <?php if (have_rows('images')) :
        while (have_rows('images')) : the_row();
          $image = get_sub_field('image');
          $image_source = $image['url'];
          $image_alt = $image['alt'];
      ?>
          <img src="<?= $image_source; ?>" alt="<?= $image_alt; ?>" class="md:tw-w-5/12">
        <?php endwhile; ?>
      <?php endif; ?>
    </div>

    <div id="exhibition-sponsors" class="tw-mt-10 tw-mb-5 tw-flex tw-gap-5">
      <?php if (have_rows('sponsors')) :
        while (have_rows('sponsors')) : the_row();
          $image = get_sub_field('image');
          $image_source = $image['url'];
          $image_alt = $image['alt'];
      ?>
          <img src="<?= $image_source; ?>" alt="<?= $image_alt; ?>" class="tw-w-1/4 md:tw-w-1/12">
        <?php endwhile; ?>
      <?php endif; ?>
    </div>
  </div>
</main>