<?php

/**
 * Template Name: Map Page
 * 
 * This template is used to display a page with a map.
 */

get_header();

// if screen is less than 768px
if (wp_is_mobile()) {
  $title_font_size = "font-size: 2.5em !important;";
} else {
  $title_font_size = "font-size: 6.5em !important;";
}

?>

<main id="map-page" role="main">
  <div id="map-main" class="tw-flex-col">

    <button id="map-open-modal" class="tw-mt-5 tw-mx-auto tw-px-2 tw-py-1 tw-border tw-border-black tw-bg-white">
      Info
    </button>

  </div>

  <div id="map-modal" class="modal">
    <div class="modal-content tw-flex-col">
      <span class="modal-close ">
        <img class="tw-ml-auto tw-mr-3 tw-my-3 tw-cursor-pointer" src="/wp-content/uploads/2021/03/Meny-kryss.svg" alt="Button to close modal">
      </span>
      <section id="project-info" class="tw-flex-col tw-justify-center">
        <div class="tw-w-2/6 tw-mx-auto tw-text-center">
          <h1 style="<?= $title_font_size; ?>">
            <?= get_the_title(); ?>
          </h1>
        </div>

        <div class="tw-mt-5 tw-w-1/2 tw-mx-auto">
          <?= get_the_content(); ?>
        </div>
      </section>
    </div>
  </div>
</main>

<?php get_footer(); ?>