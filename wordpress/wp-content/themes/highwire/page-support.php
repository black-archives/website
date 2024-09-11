<?php /* Template Name: Support Page */ ?>

<?php get_header(); ?>
<main role="main" class="archive-page">
  <section class="front-heading">
    <div class="col-3-4">
      <h1><?= get_the_title(); ?></h1>
      <p>
        <?= get_the_content(); ?>
      </p>
    </div>
  </section>

  <section class="post-feed post-feed--single">
    <div class="flex">
      <div class="col-f-1-3" style="background-image: url('/wp-content/uploads/2021/03/Michael-Bild-2-700x687.jpg);">
        <div class="">
          <a href="<?php the_permalink(); ?>">
            <div class="post-hover-box">
              <div class="top">
                <h2>Donate to utilities</h2>
              </div>

              <div class="bottom">
                <p>By donating to utilities, you help us pay rent, electricity and other fixed costs that come with running a physical space.</p>
                <a href="https://buy.stripe.com/test_eVa9D7dep0XSabu8ww">
                  <button class="btn btn-primary"><?= _e('Donate', ' bas'); ?> <img src="/wp-content/uploads/2021/03/Pil.svg" /></button>
                </a>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>