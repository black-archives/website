<?php
function add_custom_taxonomies()
{
  // Add new "Locations" taxonomy to Posts
  register_taxonomy('archive-type', 'post', array(
    // Hierarchical taxonomy (like categories)
    'hierarchical' => true,
    // This array of options controls the labels displayed in the WordPress Admin UI
    'labels' => array(
      'name' => _x('Archive type', 'taxonomy general name'),
      'singular_name' => _x('Archive type', 'taxonomy singular name'),
      'search_items' =>  __('Search'),
      'all_items' => __('All '),
      'parent_item' => __('Parent '),
      'parent_item_colon' => __('Parent:'),
      'edit_item' => __('Edit'),
      'update_item' => __('Update'),
      'add_new_item' => __('Add New'),
      'new_item_name' => __('New Name'),
      'menu_name' => __('Archive type'),
    ),
    // Control the slugs used for this taxonomy
    'rewrite' => array(
      'slug' => 'archive-type', // This controls the base slug that will display before each term
      'with_front' => false, // Don't display the category base before "/locations/"
      'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
    ),
  ));
}

add_action('init', 'add_custom_taxonomies', 0);
