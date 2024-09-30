<?php get_header(); ?>

<main role="main" class="archive-page">
  <section class="sub-page-menu">
    <div class="flex flex-space vert-center">
      <div class="col-f-3-4">
        <!-- <ul class="menu-list flex flex-space" style="padding-left: 5%;">
					<?php $categories = get_categories();
          foreach ($categories as $category) : ?>

						<?php $cat_url = esc_url(get_category_link($category->term_id)); ?>
						<li><a href="<?php echo $cat_url; ?>"><?php echo $category->name ?></a></li>

					<?php endforeach; ?>
				</ul> -->
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
      <?php if (have_posts()): while (have_posts()) : the_post(); ?>
          <div class="col-f-1-3">
            <div class="box-content <?php if (has_post_thumbnail()): echo 'hover-active';
                                    endif; ?> ">
              <?php if (has_post_thumbnail()):
                the_post_thumbnail(); ?>
                <div class="post-hover-box">
                  <div class="top">
                    <a href="<?php the_permalink(); ?>">
                      <h2><?php the_title(); ?></h2>
                    </a>
                  </div>
                  <div class="bottom">
                    <p class="show-desktop"><?php if (get_field('short_about')):  echo fredy_custom_excerpt(get_field('short_about'));
                                            else: custom_length_excerpt(20);
                                            endif;   ?></p>
                    <p class="show-ipad"><?php if (get_field('short_about')):  echo fredy_custom_excerpt(get_field('short_about'), 10);
                                          else: custom_length_excerpt(8);
                                          endif;   ?></p>

                    <ul class="cat-list">
                      <?php wp_list_categories(array(
                        'orderby' => 'name',
                        'title_li'           => __(''),
                        'exclude'  => 1
                      )); ?>
                    </ul>
                  </div>


                </div>
              <?php else: ?>
                <div class="post-text-box">
                  <div class="top">
                    <a href="<?php the_permalink(); ?>">
                      <h2><?php the_title(); ?></h2>
                    </a>
                  </div>
                  <div class="bottom">
                    <p class="show-desktop"><?php if (get_field('short_about')):  echo fredy_custom_excerpt(get_field('short_about'));
                                            else: custom_length_excerpt(20);
                                            endif;   ?></p>
                    <p class="show-ipad"><?php if (get_field('short_about')):  echo fredy_custom_excerpt(get_field('short_about'), 10);
                                          else: custom_length_excerpt(8);
                                          endif;   ?></p>
                    <ul class="cat-list">
                      <?php wp_list_categories(array(
                        'orderby' => 'name',
                        'title_li'           => __(''),
                        'exclude'  => 1
                      )); ?>
                    </ul>
                  </div>

                </div>
              <?php endif; ?>
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