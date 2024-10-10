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

// set option btn style
$option_btn_style = "tw-px-5 tw-py-2 tw-text-5xl tw-rounded-full tw-border tw-border-black tw-bg-white";
$menu_option_btn_style = "tw-px-2 tw-py-4 tw-rounded-full tw-border tw-border-black tw-bg-black tw-text-white hover:tw-bg-white hover:tw-text-black md:tw-px-5 md:tw-py-2";

// get map image
$map_image_url = get_field('map_image');

// get repeater field
$map_stories = get_field('map_stories');

// Create an array of 2 PHP objects with dummy data
$pointer_color = "red";
$map_pointers = [
  (object) [
    'id' => 1,
    'x' => '7746.912109375',
    'y' => '2287.798583984375',
    'color' => $pointer_color,
  ],
  (object) [
    'id' => 2,
    'x' => '7902.91552734375',
    'y' => '2220.940185546875',
    'color' => $pointer_color,
  ],
  (object) [
    'id' => 3,
    'x' => '8155.4921875',
    'y' => '2354.656982421875',
    'color' => $pointer_color,
  ],
  (object) [
    'id' => 4,
    'x' => '7709.7685546875',
    'y' => '2503.2314453125',
    'color' => $pointer_color,
  ],
  (object) [
    'id' => 5,
    'x' => '7932.63037109375',
    'y' => '2532.9462890625',
    'color' => $pointer_color,
  ],
  (object) [
    'id' => 6,
    'x' => '7405.19091796875',
    'y' => '3023.241943359375',
    'color' => $pointer_color,
  ],
  (object) [
    'id' => 7,
    'x' => '7486.9072265625',
    'y' => '3015.813232421875',
    'color' => $pointer_color,
  ],
  (object) [
    'id' => 8,
    'x' => '7761.76953125',
    'y' => '4620.4169921875',
    'color' => $pointer_color,
  ],
  (object) [
    'id' => 9,
    'x' => '7858.34326171875',
    'y' => '4627.845703125',
    'color' => $pointer_color,
  ],
  (object) [
    'id' => 10,
    'x' => '7264.04541015625',
    'y' => '3216.388671875',
    'color' => $pointer_color,
  ],
  (object) [
    'id' => 11,
    'x' => '7449.763671875',
    'y' => '4419.841796875',
    'color' => $pointer_color,
  ],
  (object) [
    'id' => 12,
    'x' => '7085.755859375',
    'y' => '3045.528076171875',
    'color' => $pointer_color,
  ],
  (object) [
    'id' => 13,
    'x' => '7197.18701171875',
    'y' => '3038.099365234375',
    'color' => $pointer_color,
  ],
  (object) [
    'id' => 14,
    'x' => '310.76214599609375',
    'y' => '5341.0029296875',
    'color' => $pointer_color,
  ],
  (object) [
    'id' => 15,
    'x' => '7769.1982421875',
    'y' => '3231.24609375',
    'color' => $pointer_color,
  ],
  (object) [
    'id' => 16,
    'x' => '7925.20166015625',
    'y' => '4523.84375',
    'color' => $pointer_color,
  ],
  (object) [
    'id' => 17,
    'x' => '7256.61669921875',
    'y' => '4018.690673828125',
    'color' => $pointer_color,
  ],
  (object) [
    'id' => 18,
    'x' => '7249.18798828125',
    'y' => '4115.26416015625',
    'color' => $pointer_color,
  ],
  (object) [
    'id' => 19,
    'x' => '4760.56640625',
    'y' => '5066.14013671875',
    'color' => $pointer_color,
  ],
  (object) [
    'id' => 20,
    'x' => '7940.05908203125',
    'y' => '3075.242919921875',
    'color' => $pointer_color,
  ],
  (object) [
    'id' => 21,
    'x' => '7249.18798828125',
    'y' => '4211.83740234375',
    'color' => $pointer_color,
  ],
  (object) [
    'id' => 22,
    'x' => '7732.0546875',
    'y' => '4085.549072265625',
    'color' => $pointer_color,
  ],
  (object) [
    'id' => 23,
    'x' => '7286.33154296875',
    'y' => '3104.9580078125',
    'color' => $pointer_color,
  ],
  (object) [
    'id' => 24,
    'x' => '7791.48486328125',
    'y' => '3535.82373046875',
    'color' => $pointer_color,
  ],
  (object) [
    'id' => 25,
    'x' => '0',
    'y' => '0',
    'color' => '#39ff14',
  ],
  (object) [
    'id' => 26,
    'x' => '7590.9091796875',
    'y' => '3877.544921875',
    'color' => $pointer_color,
  ],
  (object) [
    'id' => 27,
    'x' => '7204.61572265625',
    'y' => '2941.526123046875',
    'color' => $pointer_color,
  ],
  (object) [
    'id' => 28,
    'x' => '8816.6484375',
    'y' => '2733.521728515625',
    'color' => $pointer_color,
  ],
  (object) [
    'id' => 29,
    'x' => '8898.3642578125',
    'y' => '2674.092041015625',
    'color' => $pointer_color,
  ],
  (object) [
    'id' => 30,
    'x' => '7576.0517578125',
    'y' => '4360.41162109375',
    'color' => $pointer_color,
  ],
  (object) [
    'id' => 31,
    'x' => '9024.65234375',
    'y' => '2703.806884765625',
    'color' => $pointer_color,
  ],
  (object) [
    'id' => 32,
    'x' => '7776.626953125',
    'y' => '3929.5458984375',
    'color' => $pointer_color,
  ],
  (object) [
    'id' => 33,
    'x' => '6536.03076171875',
    'y' => '4033.548095703125',
    'color' => $pointer_color,
  ],
  (object) [
    'id' => 34,
    'x' => '6075.4501953125',
    'y' => '3877.544921875',
    'color' => $pointer_color,
  ],
  (object) [
    'id' => 35,
    'x' => '8110.91943359375',
    'y' => '2191.22509765625',
    'color' => $pointer_color,
  ],
  (object) [
    'id' => 36,
    'x' => '7278.90283203125',
    'y' => '2837.52392578125',
    'color' => $pointer_color,
  ],
  (object) [
    'id' => 37,
    'x' => '7821.19970703125',
    'y' => '4107.83544921875',
    'color' => $pointer_color,
  ],
  (object) [
    'id' => 38,
    'x' => '7888.05810546875',
    'y' => '4419.841796875',
    'color' => $pointer_color,
  ],
  (object) [
    'id' => 39,
    'x' => '7427.47705078125',
    'y' => '3268.389892578125',
    'color' => $pointer_color,
  ],
  (object) [
    'id' => 40,
    'x' => '7873.20068359375',
    'y' => '4196.97998046875',
    'color' => $pointer_color,
  ],
  (object) [
    'id' => 41,
    'x' => '8408.068359375',
    'y' => '2889.52490234375',
    'color' => $pointer_color,
  ],
  (object) [
    'id' => 42,
    'x' => '4337.12939453125',
    'y' => '4612.98828125',
    'color' => $pointer_color,
  ],
  (object) [
    'id' => 43,
    'x' => '7516.6220703125',
    'y' => '3231.24609375',
    'color' => $pointer_color,
  ],
  (object) [
    'id' => 44,
    'x' => '7784.05615234375',
    'y' => '3832.97265625',
    'color' => $pointer_color,
  ],
  (object) [
    'id' => 45,
    'x' => '7531.4794921875',
    'y' => '3104.9580078125',
    'color' => $pointer_color,
  ]
];

// get a map object by id
function get_map_story_by_id($id)
{
  global $map_stories;
  foreach ($map_stories as $key => $map_story) {
    $index = $key + 1;

    // the map stories are in a repeater custom field and their order of
    // position is binded to the pointer id passed
    if ($index == $id) {
      return $map_story;
    }
  }
  return null;
}

// get map object radius
function get_map_object_radius()
{
  if (wp_is_mobile()) {
    return 50;
  } else {
    return 50;
  }
}

// sanitize text for map card
function sanitize_text($text)
{
  // escape new lines
  $text = str_replace(array("\r\n", "\r", "\n"), "<br>", $text);

  // escape quotes
  $text = str_replace('"', "'", $text);

  // escape html
  $text = htmlspecialchars($text);

  return $text;
}

?>

<main id="map-page" role="main">
  <div id="map-main" class="tw-flex-col">
    <!-- map -->
    <div
      id="map-container"
      class="tw-h-screen-90vh tw-border-black tw-border-2 md:tw-grow md:tw-h-svh md:tw-border-0">
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
          foreach ($map_pointers as $pointer) :
            // set the selected object
            $map_story = get_map_story_by_id($pointer->id);

            // set content
            $title = '';
            $body = '';

            if ($map_story) {
              $title = $map_story['title'];
              $body = $map_story['body'];
            }

            // single digit numbers are un-centered on top
            // of the circle so the padding tries to fix that
            if ($pointer->id < 10) {
              $pointer_text_padding = -10;
            } else {
              $pointer_text_padding = 0;
            }

          ?>
            <g
              class="map-pointer tw-cursor-pointer"
              ontouchend="setCard(<?= sanitize_text($pointer->id); ?>, '<?= sanitize_text($title); ?>', '<?= sanitize_text($body); ?>')"
              onmouseup="setCard(<?= sanitize_text($pointer->id); ?>, '<?= sanitize_text($title); ?>', '<?= sanitize_text($body); ?>')">
              <circle
                id="<?= $pointer->id; ?>"
                cx="<?= $pointer->x; ?>"
                cy="<?= $pointer->y; ?>"
                r="<?= get_map_object_radius(); ?>" />

              <!-- add text element with id -->
              <text
                x="<?= $pointer->x - 25 - $pointer_text_padding; ?>"
                y="<?= $pointer->y + 15; ?>"
                style="font-size: 3em;"
                fill="white">
                <?= $pointer->id; ?>
              </text>
            </g>
          <?php endforeach; ?>
        </g>
      </svg>
    </div>

    <!-- options -->
    <div
      id="map-options"
      class="tw-absolute tw-bottom-0 tw-inset-x-0 tw-mb-5 tw-mx-2 tw-flex tw-flex-col tw-space-y-2 tw-justify-between tw-text-xl md:tw-pl-10 md:tw-mx-10 md:tw-flex-row md:tw-space-y-0 lg:tw-pl-20">
      <!-- interaction options -->
      <div class="tw-flex md:tw-justify-start tw-space-x-2">
        <button id="btn-zoom-in" class="<?= $option_btn_style; ?>">
          +
        </button>
        <button id="btn-zoom-out" class="<?= $option_btn_style; ?>">
          -
        </button>
      </div>

      <!-- menu options -->
      <div class="tw-flex tw-w-full md:tw-w-auto md:tw-justify-end tw-space-x-2">
        <button id="btn-lang-en" class="tw-basis-1/4 <?= $menu_option_btn_style; ?>">
          En
        </button>
        <button id="btn-lang-sv" class="tw-basis-1/4 <?= $menu_option_btn_style; ?>">
          Sv
        </button>
        <button id="map-open-modal" class="tw-basis-2/4 <?= $menu_option_btn_style; ?>">
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