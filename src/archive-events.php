<?php

/**
 * This is the template for the events page. It displays all the events in the
 * website.
 */

get_header();
?>

<main class="events" style="background: #F0F0F0;">
  <section class="search-top">
    <div style="padding-left: 50px;">
      <h1><?php the_archive_title('', false) ?></h1>
      <div class="col-3-4 top-search-field">
        <p><?php the_field('event-text', 'option'); ?></p>
      </div>
    </div>
  </section>

  <section class="post-feed">
    <?php if (have_posts()): while (have_posts()) : the_post(); ?>
        <div class="tw-flex tw-flex-row-reverse" style="border-bottom: 1px solid #000;">
          <div class="tw-basis-1/2">
            <?php the_post_thumbnail(); ?>
          </div>

          <div class="event-info tw-basis-1/2 tw-flex tw-flex-col tw-place-content-between tw-p-5">
            <div class="top tw-flex-col">
              <p class="date flex flex-space">
                <span><?php the_field('day'); ?></span>
                <span><?php the_field('time'); ?></span>
              </p>
              <p class="heading"><?php the_field('date'); ?></p>
            </div>

            <div class="bottom tw-flex-col">
              <div>
                <h2><?php the_title(); ?></h2>
                <?php custom_length_excerpt(40); ?>
              </div>
              <?php if (get_field('link')): ?>
                <p><a href="<?php the_field('link'); ?>" class="btn btn-primary" style="margin-top: 40px;"><?php the_field('link_text'); ?><img src="/wp-content/uploads/2021/03/Pil.svg" alt="Go to event arrow"></a></p>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    <?php endif; ?>
  </section>
</main>
<?php get_footer(); ?>