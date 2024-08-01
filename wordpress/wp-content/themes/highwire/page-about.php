<?php /* Template Name: About Page */ ?>

<?php get_header(); ?>
<?php $site_title = get_bloginfo('name'); ?>
<main role="main">
  <div class="sub-page-menu">

    <ul class="menu-list flex" style="justify-content: space-evenly; ">
      <li><a href="#about"><?php _e('About Black Archives Sweden', 'bas'); ?></a></li>
      <li><a href="#team"><?php _e('The Team', 'bas'); ?></a></li>
      <!--<li>Others</li>-->
      <!--<li>Partners</li>-->
    </ul>

  </div>
  <section class="about-page" id="about">
    <div class="wrap-m">
      <h1><?php the_title();
          echo ' ' . $site_title; ?></h1>
      <?php the_content(); ?>
    </div>
  </section>

  <section class="team" id="team">
    <div class="wrap-m">
      <h2 class="heading"><?php _e('The team', 'bas'); ?></h2>
      <?php if (get_field('team-text')) : ?>
        <p>
          <?php the_field('team-text'); ?>
        </p>
      <?php endif; ?>
    </div>

    <?php if (have_rows('team_members')) : ?>
      <div class="wrap-l flex flex-space">
        <?php while (have_rows('team_members')) : the_row();
          $image = get_sub_field('image');
          $name = get_sub_field('name');
          $about = get_sub_field('about');
        ?>
          <div class="col-1-3">
            <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
            <h4><?php echo $name;  ?></h4>
            <p><?php echo $about; ?></p>
          </div>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>

    <div class="wrap-m" style="margin-top: 40px;">
      <h4><?php _e('Contributors to Black Archives Sweden', 'bas'); ?></h4>
      <p><?php the_field('text-contributors'); ?></p>
      <p><?php the_field('contributors'); ?></p>

    </div>
  </section>

  <?php
  if (have_rows('partners')) : ?>
    <section class="partners">
      <div class="wrap-m">
        <h2 class="heading"><?php _e('Supported by', 'bas'); ?></h2>
        <div class="partners-row flex">

          <?php while (have_rows('partners')) : the_row();

            $partnerLogo = get_sub_field('image');   ?>


            <img class="partner-logo" src="<?php echo $partnerLogo['url']; ?>" alt="<?php echo $partnerLogo['alt']; ?>" style="margin-right:20px;">
          <?php endwhile; ?>
        </div>
      </div>

    </section>
  <?php endif; ?>
</main>

<?php get_footer(); ?>