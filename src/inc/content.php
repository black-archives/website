<?php

/**
 * Change queries
 */
add_action('pre_get_posts', function ( $query ) {
    if ($query->is_main_query() && ! is_admin()) {
          $query->set('post_status', 'publish');
    }
});


/**
 * Remove protected and private prefix from titles
 */
add_filter('the_title', function ($title) {
    if (is_admin()) {
      return $title;
    }

    $title = esc_attr($title);

    $findthese = array(
      '#Protected:#',
      '#Private:#',
      '#Skyddad:#',
      '#Privat:#',
    );

    $replacewith = array(
      '',
      '',
      ''
    );

    $title = preg_replace($findthese, $replacewith, $title);

    return $title;
}, 10, 2);
