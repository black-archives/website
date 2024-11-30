<?php

/**
 * This is the front page. It displays the latest posts and an open call.
 */

get_header();
?>

<main class="frontpage">
  <section class="front-heading">
    <div class="col-3-4">
      <?php the_content(); ?>
    </div>
  </section>
  <section class="post-feed">
    <div class="flex">
      <?php
      /*
      This snippet fetches the 'pinned_items' repeater field from the front page and
      displays the items in the archive page.
      */

      while (have_rows("pinned_items")) : the_row();
        $item_title = get_sub_field('title');
        $item_body = get_sub_field('body');
        $item_image = get_sub_field('image');
        $item_cta_link = get_sub_field('cta_link');
        $item_cta_text = get_sub_field('cta_text');

      ?>
        <div class="col-f-1-3 active">
          <div class="box-content hover-active">
            <a href="<?= $item_cta_link; ?>" style="height: 100%;">
              <img src="<?= $item_image; ?>" alt="">
              <div class="post-hover-box">
                <div class="top">
                  <h2><?= $item_title; ?></h2>
                </div>

                <div class="bottom tw-w-full">
                  <?php if ($item_body) : ?>
                    <p class="tw-h-fit">
                      <?php echo get_text_excerpt($item_body) ?>
                    </p>
                  <?php endif; ?>

                  <button class="btn btn-primary tw-w-full tw-flex">
                    <?= $item_cta_text; ?>
                    <img src="/wp-content/uploads/2021/03/Pil.svg" />
                  </button>
                </div>
              </div>
            </a>
          </div>
        </div>
      <?php endwhile; ?>

      <div class="col-f-1-3 ">
        <div class="box-content hover-active'">
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
          <div class="col-f-1-3">
            <div class="box-content <?php if (has_post_thumbnail()): echo 'hover-active';
                                    endif; ?> ">
              <a href="<?php the_permalink(); ?>" style="height: 100%;">
                <?php if (has_post_thumbnail()): ?>
                  <?php the_post_thumbnail(); ?>
                  <div class="post-hover-box">
                    <div class="top">
                      <h2><?php echo wp_trim_excerpt(get_the_title()); ?></h2>
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
                        $categories = get_the_category();
                        foreach ($categories as $category) {
                          if ($category->name != "All") {
                            echo "<li>" . $category->name . "</li>";
                          }
                        } ?>
                      </ul>
                    </div>
                  </div>

                <?php else: ?>
                  <div class="post-text-box">
                    <div class="top">
                      <h2><?php echo wp_trim_excerpt(get_the_title()); ?></h2>
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
                          echo "<li>" . $category->name . "</li>";
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