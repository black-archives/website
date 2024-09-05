<!-- This is the search result page -->

<?php get_header(); ?>
<main role="main" class="search-results" style="background: #F0F0F0;">
  <section class="search-top">
    <div class="wrap-l">
      <h1><?php _e('Search Results', 'bas'); ?></h1>
      <div class="col-1-3 top-search-field">
        <p><?php _e('Enter your keywords', 'bas'); ?></p>
        <form class="search" method="get" action="<?php echo home_url(); ?>" role="search">
          <input class="search-input" type="search" name="s" placeholder="<?php _e('Search', 'html5blank'); ?>">
        </form>
        <p style="margin-top: 20px;">"<?php echo get_search_query(); ?>"" <?php echo sprintf(__('%s results ', 'html5blank'), $wp_query->found_posts); ?></p>
      </div>
    </div>
  </section>

  <section class="search-feed">
    <?php if (have_posts()): while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <div class="wrap-l">
            <div class="col-3-4">
              <span class="date"><?php the_time('j F Y'); ?></span>

              <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
              <p><?php if (get_field('short_about')): the_field('short_about');
                  else: html5wp_excerpt('html5wp_index');
                  endif; ?></p>

              <ul class="cat-list">
                <?php wp_list_categories(array(
                  'orderby' => 'name',
                  'title_li'           => __(''),
                  'exclude'  => 1
                )); ?>
              </ul>
            </div>
          </div>
        </article>
      <?php endwhile; ?>
    <?php endif; ?>

    <?php get_template_part('pagination'); ?>
  </section>
</main>
<?php get_footer(); ?>