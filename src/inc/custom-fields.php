<?php
function my_acf_init_block_types()
{
  // Check function exists.
  if (function_exists('acf_register_block_type')) {

    // register a testimonial block.
    acf_register_block_type(array(
      'name'              => 'cards',
      'title'             => __('Cards'),
      'description'       => __('A custom testimonial block.'),
      'render_template'   => 'block-cards.php',
      'category'          => 'formatting',
      'icon'              => 'admin-comments',
      'keywords'          => array('card'),
    ));

    acf_register_block_type(array(
      'name'              => 'newsletter',
      'title'             => __('Newsletter'),
      'description'       => __('A custom testimonial block.'),
      'render_template'   => 'block-newsletter.php',
      'category'          => 'formatting',
      'icon'              => 'admin-comments',
      'keywords'          => array('card'),
    ));
  }
}
add_action('acf/init', 'my_acf_init_block_types');

if (function_exists('acf_add_options_page')) {

  acf_add_options_page(array(
    'page_title'    => 'Options',
    'menu_title'    => 'Options',
    'menu_slug'     => 'options',
    'capability'    => 'edit_posts',
    'redirect'      => false
  ));

  acf_add_options_sub_page(array(
    'page_title'    => 'Social Media',
    'menu_title'    => 'Social Media',
    'parent_slug'   => 'options',
  ));

  // acf_add_options_sub_page(array(
  //  'page_title'    => 'Footer',
  //  'menu_title'    => 'Footer',
  //  'parent_slug'   => 'options',
  // ));

}
