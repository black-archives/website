<?php
/* Template Name: Parent Children Page */

//This template is for parent pages. It will display all child pages of the parent page in a grid layout.

//Pre-requisites:
//- Create a new page in WordPress and assign this template to it.
//- Create child pages for the parent page.
//- Add a featured image to each child page. If no featured image is added, a fallback image will be used.
//- Add a summary to each child page in the 'Page Summary' field of the Custom Fields section. If no summary is added, the excerpt will be used.
?>

<?php get_header(); ?>
<main role="main" class="parent-children-page">
  <section class="front-heading">
    <div class="col-3-4">
      <h1><?= get_the_title(); ?></h1>
      <p><?= get_the_content(); ?></p>
    </div>
  </section>

  <section class="post-feed post-feed--single">
    <div class="flex">
      <?php
      // get all child pages
      $args = array(
        'post_parent' => $post->ID,
        'posts_per_page' => -1,
        'post_type' => 'page',
      );

      $the_query = new WP_Query($args);

      if ($the_query->have_posts()):
        // set call to actions (if in /support path, then set it to 'support', if in /submit path, then set it to 'submit' otherwise set it to 'view')
        $call_to_action = 'View';
        if (strpos($_SERVER['REQUEST_URI'], '/support') !== false) {
          $call_to_action = 'Support';
        } elseif (strpos($_SERVER['REQUEST_URI'], '/submit') !== false) {
          $call_to_action = 'Submit';
        }

        while ($the_query->have_posts()) : $the_query->the_post();
          $title = get_the_title();
          $subtitle = get_field('page_summary') ?: get_the_excerpt();
          $background_image_url = get_the_post_thumbnail_url(get_the_ID(), 'full') ?: '/wp-content/uploads/2021/03/Michael-Bild-2-700x687.jpg'; // Fallback image
      ?>
          <div class="col-f-1-3" style="background-image: url('<?php echo esc_url($background_image_url); ?>');">
            <a href="<?php echo get_permalink($page->ID); ?>">
              <div class="post-hover-box">
                <div class="top">
                  <h2><?php echo esc_html($title); ?></h2>
                </div>

                <div class="bottom">
                  <p><?php echo esc_html($subtitle); ?></p>
                  <button class="btn btn-primary" style="padding-bottom: 15px;"><?php echo esc_html($call_to_action); ?> <img src="/wp-content/uploads/2021/03/Pil.svg" /></button>
                </div>
              </div>
            </a>
          </div>
      <?php endwhile;
      else: endif ?>
    </div>
  </section>
</main>

<?php get_footer(); ?>