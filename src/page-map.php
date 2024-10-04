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
  $title_font_size = "font-size: 2.5em !important;";
} else {
  $title_font_size = "font-size: 6.5em !important;";
}

// get svg image
$svg_image_url = get_field('svg_image');

// Create an array of 2 PHP objects with dummy data
$map_objects = [
  (object) [
    'id' => 1,
    'x' => 100,
    'y' => 200,
    'color' => '#ff0000',
  ],
  (object) [
    'id' => 2,
    'x' => 400,
    'y' => 200,
    'color' => '#00ff00',
  ],
];

$map_cards = [
  (object) [
    'id' => 1,
    'title' => 'Title 1',
    'content' => 'Content 1',
  ],
  (object) [
    'id' => 2,
    'title' => 'Title 2',
    'content' => 'Content 2',
  ],
];

// get a map object by id
function get_map_object_by_id($id)
{
  global $map_cards;
  foreach ($map_cards as $object) {
    if ($object->id == $id) {
      return $object;
    }
  }
  return null;
}

?>

<main id="map-page" role="main">
  <div id="map-main" class="tw-h-svh tw-flex-col">
    <!-- map -->
    <div id="map-container" class="tw-grow">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid meet">
        <g id="map-box">
          <!-- background -->
          <image href="<?= $svg_image_url; ?>" width="100%" height="100%" />

          <!--  pointers -->
          <g id="map-objects">
            <?php
            foreach ($map_objects as $object) :

              $title = '';
              $body = '';

              // set the selected object
              $obj = get_map_object_by_id($object->id);

              if ($obj) {
                $title = $obj->title;
                $content = $obj->content;
              }
            ?>
              <circle
                id="<?= $object->id; ?>"
                class="map-object"
                cx="<?= $object->x; ?>"
                cy="<?= $object->y; ?>"
                fill="<?= $object->color; ?>"
                r="5"
                onclick="setCard(<?= $object->id; ?>, '<?= $title; ?>', '<?= $content; ?>')" />
            <?php endforeach; ?>
          </g>
        </g>
      </svg>
    </div>

    <!-- options -->
    <div id="map-options" class="tw-grow-0 tw-my-2 tw-flex md:tw-justify-between md:tw-mx-10">
      <!-- interaction options -->
      <div class="tw-flex tw-space-x-2">
        <button id="btn-zoom-in" class="tw-px-2 tw-py-1 tw-border tw-border-black tw-bg-white hover:tw-bg-slate-800 hover:tw-text-white">
          zoom in
        </button>
        <button id="btn-zoom-out" class="tw-px-2 tw-py-1 tw-border tw-border-black tw-bg-white hover:tw-bg-slate-800 hover:tw-text-white">
          zoom out
        </button>
      </div>

      <!-- language options -->
      <div class="tw-flex tw-space-x-2">
        <button class="tw-px-2 tw-py-1 tw-border tw-border-black tw-bg-white hover:tw-bg-slate-800 hover:tw-text-white">
          En
        </button>
        <button class="tw-px-2 tw-py-1 tw-border tw-border-black tw-bg-white hover:tw-bg-slate-800 hover:tw-text-white">
          Sv
        </button>
        <button id="map-open-modal" class="tw-px-2 tw-py-1 tw-border tw-border-black tw-bg-white hover:tw-bg-slate-800 hover:tw-text-white">
          Info
        </button>
      </div>
    </div>
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