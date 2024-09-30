<?php

/**
 * Name: Front Page
 * 
 * This is the landing page.
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
      <div class="col-f-1-3 active">
        <div class="box-content">
          <a href="https://www.blackarchivessweden.com/submit/family-archive/">
            <div class="post-text-box">
              <div class="top">
                <h2>Open call</h2>
              </div>
              <div class="bottom">
                <p><?= get_field('archive_text', 'options'); ?></p>
                <button class="btn btn-primary"><?= _e('Submit', ' bas'); ?> <img src="/wp-content/uploads/2021/03/Pil.svg" /></button>
              </div>
            </div>
          </a>
        </div>
      </div>

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
              <a href="<?php the_permalink(); ?>">
                <?php if (has_post_thumbnail()): ?>
                  <?php the_post_thumbnail(); ?>
                  <div class="post-hover-box">
                    <div class="top">
                      <h2><?php echo wp_trim_excerpt(get_the_title()); ?></h2>
                    </div>

                    <div class="bottom">
                      <p class="show-desktop"><?php if (get_field('short_about')):  echo fredy_custom_excerpt(get_field('short_about'));
                                              else: custom_length_excerpt(20);
                                              endif;   ?></p>
                      <p class="show-ipad"><?php if (get_field('short_about')):  echo fredy_10_custom_excerpt(get_field('short_about'));
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
                      <p class="show-desktop"><?php if (get_field('short_about')):  echo fredy_custom_excerpt(get_field('short_about'));
                                              else: custom_length_excerpt(20);
                                              endif;   ?></p>
                      <p class="show-ipad"><?php if (get_field('short_about')):  echo fredy_10_custom_excerpt(get_field('short_about'));
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