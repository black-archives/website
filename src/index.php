<?php

/**
 * Name: Archive Page
 * 
 * This is the archive page. It displays all posts.
 */

get_header();
?>
<main role="main" class="archive-page">
  <section class="front-heading">
    <div class="col-3-4">
      <h1>
        <?php _e('Archive', 'bas'); ?>
      </h1>
      <p>
        <?php _e('The archive consists of interviews, texts, images, sound and video clips. Eventually, you will also be able to find selections from our physical collections here.', 'bas'); ?>
      </p>
    </div>
  </section>

  <section class="sub-page-menu" style="position: relative;">
    <div class="flex flex-space vert-center">
      <div class="col-f-1-4 cat-dropdown">
        <div class="relative" style="position: relative;">
          <button class="open-dd"><?php _e('Full archive'); ?></button>
          <ul class="hide main-dd">
            <?php if (!is_home()): ?>
              <li><?php _e('Full archive'); ?></li>
            <?php endif; ?>
            <?php
            foreach (get_terms('archive-type', array('hide_empty' => false, 'parent' => 0)) as $parent_term) : ?>
              <li><a href="<?= get_term_link($parent_term); ?>"><?= $parent_term->name; ?></a>
                <?php if (get_terms('archive-type', array('hide_empty' => false, 'parent' => $parent_term->term_id))):
                  foreach (get_terms('archive-type', array('hide_empty' => false, 'parent' => $parent_term->term_id)) as $child_term): ?>
                    <ul class="child-dd">
                      <li><a href="<?= get_term_link($child_term); ?>"><?= $child_term->name; ?></a></li>
                    </ul>
                <?php endforeach;
                endif; ?>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>

      <div class="col-f-1-2">
        <ul class="menu-list flex flex-space">
          <?php $categories = get_categories();
          foreach ($categories as $category) : ?>
            <?php $cat_url = esc_url(get_category_link($category->term_id)); ?>
            <li id="<?= $category->slug; ?>" class="filter-tags <?php if ($category->slug === 'all'): echo 'active';
                                                                endif; ?>"><?php echo $category->name ?></li>
          <?php endforeach; ?>
        </ul>
      </div>

      <div class="col-f-1-4">
        <form class="search" method="get" action="<?php echo home_url(); ?>" role="search">
          <input class="archive-search" type="search" name="s" placeholder="<?php _e('Search', 'html5blank'); ?>">
        </form>
      </div>
    </div>
  </section>

  <section class="post-feed">
    <div class="flex">
      <?php
      $website_origin = get_site_url();
      $website_origin = $website_origin ? $website_origin : null;
      $map_image = $website_origin . '/wp-content/uploads/2024/10/karta-thumbnail.png';
      $map_title = 'The Swinging Town';

      // get website path
      $current_language = apply_filters('wpml_current_language', NULL);

      if ($current_language == 'sv') {
        $map_cta = 'Öppna kartan';
        $map_url = $website_origin . '/sv/the-swinging-town/';
      } else {
        $map_cta = 'Enter the map';
        $map_url = $website_origin . '/the-swinging-town/';
      }
      ?>
      <div class="col-f-1-3 active">
        <div class="box-content hover-active">
          <a href="<?= $map_url; ?>" style="height: 100%;">
            <img src="<?= $map_image; ?>" alt="">
            <div class="post-hover-box">
              <div class="top">
                <h2><?= $map_title; ?></h2>
              </div>

              <div class="bottom tw-mt-auto tw-w-full">
                <button class="btn btn-primary tw-w-full tw-flex">
                  <?= $map_cta ?>
                  <img src="/wp-content/uploads/2021/03/Pil.svg" />
                </button>
              </div>
            </div>
          </a>
        </div>
      </div>

      <div class="col-f-1-3 ">
        <div class="box-content hover-active">
          <a href="https://www.blackarchivessweden.com/index-of-archival-projects-sites/">
            <img src="https://www.blackarchivessweden.com/wp-content/uploads/2023/06/BAS_index_ig_1.jpg" alt="">
          </a>
        </div>
      </div>

      <?php
      $args = array(
        'posts_per_page'    => -1,
        'post_type'     => 'post'
      );
      // query
      $the_query = new WP_Query($args);


      if ($the_query->have_posts()):
        while ($the_query->have_posts()) : $the_query->the_post(); ?>
          <?php $args = array(
            'exclude' => '1'
          );
          $categories = get_the_category();
          ?>
          <div class="col-f-1-3 post-boxes active <?php
                                                  foreach ($categories as $category) {
                                                    echo $category->slug . " ";
                                                  } ?> ">
            <div class="box-content <?php if (has_post_thumbnail()): echo 'hover-active';
                                    endif; ?> ">
              <a href="<?php the_permalink(); ?>" style="height: 100%;">
                <?php if (has_post_thumbnail()):
                  the_post_thumbnail(); ?>
                  <div class="post-hover-box">
                    <div class="top">
                      <h2><?php the_title(); ?></h2>
                    </div>

                    <div class="bottom">
                      <p class="show-desktop"><?php if (get_field('short_about')):  echo get_text_excerpt(get_field('short_about'));
                                              else: custom_length_excerpt(20);
                                              endif;   ?></p>
                      <p class="show-ipad"><?php if (get_field('short_about')):  echo get_text_excerpt(get_field('short_about'), 10);
                                            else: custom_length_excerpt(8);
                                            endif;   ?></p>
                      <ul class="cat-list">
                        <?php

                        foreach ($categories as $category) {
                          if ($category->name !== 'All') {
                            echo "<li>" . $category->name . "</li>";
                          }
                        } ?>
                      </ul>
                    </div>
                  </div>
                <?php else: ?>
                  <div class="post-text-box">
                    <div class="top">
                      <h2><?php the_title(); ?></h2>
                    </div>
                    <div class="bottom">
                      <p class="show-desktop"><?php if (get_field('short_about')):  echo get_text_excerpt(get_field('short_about'));
                                              else: custom_length_excerpt(20);
                                              endif;   ?></p>
                      <p class="show-ipad"><?php if (get_field('short_about')):  echo get_text_excerpt(get_field('short_about'), 10);
                                            else: custom_length_excerpt(8);
                                            endif;   ?></p>
                      <ul class="cat-list">
                        <?php
                        $args = array(
                          'exclude' => '1'
                        );
                        $categories = get_categories($args);
                        foreach ($categories as $category) {
                          if ($category->name !== 'All') {
                            echo "<li>" . $category->name . "</li>";
                          }
                        } ?>
                      </ul>
                    </div>

                  </div>
                <?php endif; ?>
              </a>
            </div>
          </div>
      <?php endwhile;
      else :
      endif;
      ?>
    </div>
  </section>
</main>

<?php get_footer(); ?>