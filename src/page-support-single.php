<!--
This template is meant for support pages (i.e. dontations, volunteering...)
-->

<?php /* Template Name: Support */ ?>

<?php get_header(); ?>
<main role="main" class="support-single-page">
  <section class="front-heading">
    <div class="col-3-4 wrap-m">
      <h1><?= get_the_title(); ?></h1>

      <p style="margin-top: 20px;">
        <?= get_the_content(); ?>
      </p>

      <?php if (have_rows('links')) : ?>
        <div class="flex-stack" style="margin-top: 50px;">
          <?php while (have_rows('links')) : the_row();
            $button_text = get_sub_field('content');
            $button_link = get_sub_field('link');
          ?>

            <a href="<?= $button_link; ?>" class="btn btn-primary" style="margin: 20px 20px 0 0; width:fit-content;">
              <?= $button_text; ?>&nbsp;
              <img src="/wp-content/uploads/2021/03/Pil.svg" />
            </a>
          <?php endwhile; ?>
        </div>
      <?php endif; ?>

      <?php if (have_rows('images')) : ?>
        <div class="flex flex-space" style="margin-top: 50px;">
          <?php while (have_rows('images')) : the_row();
            $image = get_sub_field('image');
            $image_source = $image['url'];
            $image_alt = $image['alt'];
          ?>
            <img src="<?= $image_source; ?>" alt="<?= $image_alt; ?>" style="max-width: 100%; max-height: 500px;">
          <?php endwhile; ?>
        </div>
      <?php endif; ?>
    </div>
  </section>
</main>

<?php get_footer(); ?>