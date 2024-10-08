<?php

/**
 * Template Name: Map Page
 * 
 * This template is used to display a page with a map.
 */

get_header();

// load javascript for map page
wp_enqueue_script('map-js', get_template_directory_uri() . '/scripts/map.js', array('jquery'), '1.0.0', true);

// if screen is less than 768px
if (wp_is_mobile()) {
  $title_font_size = "font-size: 4em !important;";
} else {
  $title_font_size = "font-size: 6.5em !important;";
}

// get map image
$map_image_url = get_field('map_image');

// get repeater field
$map_stories = get_field('map_stories');

// Create an array of 2 PHP objects with dummy data
$map_objects = [
  (object) [
    'id' => 1,
    'x' => "10",
    'y' => "20",
    'color' => '#ff0000',
  ],
  (object) [
    'id' => 2,
    'x' => "40%",
    'y' => "20%",
    'color' => '#00ff00',
  ],
];

// get a map object by id
function get_map_story_by_id($id)
{
  global $map_stories;
  foreach ($map_stories as $map_story) {

    if ($map_story['id'] == $id) {
      return $map_story;
    }
  }
  return null;
}

?>

<main id="map-page" role="main">
  <div id="map-main" class="tw-min-h-svh md:tw-h-svh tw-flex-col">
    <!-- map -->
    <div
      id="map-container"
      class="tw-h-svh md:tw-h-screen-90vh md:tw-grow tw-border-black tw-border-2 md:tw-border-0">
      <!-- 10004px × 7087px (scaled to 1146px × 811px) -->
      <svg
        id="map-svg"
        class="tw-w-full tw-h-full"
        xmlns="http://www.w3.org/2000/svg">
        <g id="map-svg-group">
          <!-- background -->
          <image href="<?= $map_image_url; ?>" />

          <!--  pointers -->
          <?php
          foreach ($map_objects as $object) :
            // set the selected object
            $map_story = get_map_story_by_id($object->id);

            // set content
            $title = '';
            $body = '';

            if ($map_story) {
              $title = $map_story['title'];
              $body = $map_story['body'];
            }
          ?>
            <circle
              id="<?= $object->id; ?>"
              class="map-pointer tw-cursor-pointer"
              cx="<?= $object->x; ?>"
              cy="<?= $object->y; ?>"
              fill="<?= $object->color; ?>"
              r="5"
              onclick="setCard(<?= $object->id; ?>, '<?= $title; ?>', '<?= $body; ?>')" />
          <?php endforeach; ?>
        </g>
      </svg>
    </div>

    <!-- options -->
    <div
      id="map-options" class="tw-absolute tw-bottom-0 tw-inset-x-0 tw-w-full md:tw-w-auto md:tw-relative md:tw-grow-0 tw-my-2 tw-mx-1 md:tw-mx-10 tw-space-y-2 md:tw-space-y-0 tw-flex tw-flex-col md:tw-flex-row tw-justify-between">
      <!-- interaction options -->
      <div class="tw-flex md:tw-justify-start tw-space-x-2">
        <button id="btn-zoom-in" class="tw-px-2 tw-py-1 tw-border tw-border-black tw-bg-white hover:tw-bg-slate-800 hover:tw-text-white">
          zoom in
        </button>
        <button id="btn-zoom-out" class="tw-px-2 tw-py-1 tw-border tw-border-black tw-bg-white hover:tw-bg-slate-800 hover:tw-text-white">
          zoom out
        </button>
      </div>

      <!-- extra options -->
      <div class="tw-flex md:tw-justify-end tw-space-x-2">
        <button class="tw-grow-0 tw-px-2 tw-py-1 tw-border tw-border-black tw-bg-white hover:tw-bg-slate-800 hover:tw-text-white">
          En
        </button>
        <button class="tw-grow-0 tw-px-2 tw-py-1 tw-border tw-border-black tw-bg-white hover:tw-bg-slate-800 hover:tw-text-white">
          Sv
        </button>
        <button id="map-open-modal" class="tw-grow md:tw-grow-0 tw-px-2 tw-py-1 tw-border tw-border-black tw-bg-white hover:tw-bg-slate-800 hover:tw-text-white">
          Info
        </button>
      </div>
    </div>

    <div id="map-modal" class="modal">
      <div class="modal-content tw-flex-col">
        <span class="modal-close ">
          <img class="tw-ml-auto tw-mr-3 tw-my-3 tw-cursor-pointer" src="/wp-content/uploads/2021/03/Meny-kryss.svg" alt="Button to close modal">
        </span>
        <section id="project-info" class="tw-flex-col tw-justify-center">
          <div class="md:tw-w-2/6 md:tw-mx-auto tw-text-center">
            <h1 style="<?= $title_font_size; ?>">
              <?= get_the_title(); ?>
            </h1>
          </div>

          <div class="tw-mt-5 md:tw-w-1/2 md:tw-mx-auto">
            <?= get_the_content(); ?>
          </div>
        </section>
      </div>
    </div>
</main>

<?php get_footer(); ?>