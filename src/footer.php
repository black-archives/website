<?php

/**
 * This is the footer of the website. It contains the newsletter form and the
 * copy right information.
 */
?>

<div class="bottom-footer tw-flex tw-justify-between">
  <p>&copy; <?php echo date('Y'); ?> All rights reserved </p>

  <div>
    <?php if (ICL_LANGUAGE_CODE == 'en'): ?>
      <?= do_shortcode("[cm_form form_id='cm_64833d96cf335']"); ?>
    <?php elseif (ICL_LANGUAGE_CODE == 'sv'): ?>
      <?= do_shortcode("[cm_form form_id='cm_648f5255a0f3d']"); ?>
    <?php endif; ?>
  </div>
</div>
<?php wp_footer(); ?>