<?php

/**
 * Block Name: Cards
 * 
 * This is the template that displays the a grid of cards.
 */

// set key to null
$key = null;

// check which repeater field has rows of data
if (have_rows('puffar')) {
  $key = 'puffar';
} else if (have_rows('cards')) {
  $key = 'cards';
}

if ($key !== null):
?>
  <div class="tw-grid tw-grid-cols-2">
    <?php

    // loop through the rows of data
    while (have_rows($key)) : the_row();
      // set variables
      if ($key === 'puffar') {
        $card_image_url = get_sub_field('bild')['url'];
        $card_image_alt = get_sub_field('bild')['alt'];
        $card_title = get_sub_field('rubrik');
        $card_summary = get_sub_field('kort_om');
        $card_call_to_action = get_sub_field('lank')['title'];
        $card_link = get_sub_field('lank')['url'];
      } else if ($key === 'cards') {
        $card_image_url = get_sub_field('image')['url'];
        $card_image_alt = get_sub_field('image')['alt'];
        $card_title = get_sub_field('title');
        $card_summary = get_sub_field('summary');
        $card_call_to_action = get_sub_field('call_to_action');
        $card_link = get_sub_field('link');
      }
    ?>
      <div class="tw-mx-2 tw-flex tw-flex-col">
        <img src="<?= $card_image_url ?>" alt="<?= $card_image_alt ?>" class="tw-w-full tw-h-full tw-object-cover" />

        <div class="tw-px-2 tw-flex tw-flex-col">
          <p class="tw-mt-2 tw-text-5xl tw-text-clip" style="font-family: HappyTimes, helvetica !important;">
            <?= $card_title ?>
          </p>

          <p>
            <?= $card_summary ?>
          </p>

          <a href="<?= $card_link ?>" class="btn btn-primary tw-m-2 tw-w-fit tw-flex tw-items-center tw-justify-center">
            <?= $card_call_to_action ?> <img src="/wp-content/uploads/2021/03/Pil.svg" />
          </a>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
<?php endif; ?>