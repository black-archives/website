<?php
/*
 *  Author: Todd Motto | @toddmotto
 *  URL: html5blank.com | @html5blank
 *  Custom functions, support, custom post types and more.
 */

/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

// Load any external files you have here

/*------------------------------------*\
	Theme Support
\*------------------------------------*/

if (!isset($content_width)) {
  $content_width = 900;
}

if (function_exists('add_theme_support')) {
  // Add Menu Support
  add_theme_support('menus');

  // Add Thumbnail Theme Support
  add_theme_support('post-thumbnails');
  add_image_size('large', 700, '', true); // Large Thumbnail
  add_image_size('medium', 250, '', true); // Medium Thumbnail
  add_image_size('small', 120, '', true); // Small Thumbnail
  add_image_size('custom-size', 800, 450, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');
  add_image_size('square-size', 700, 700, true);


  // Enables post and comment RSS feed links to head
  add_theme_support('automatic-feed-links');

  // Localisation Support
  load_theme_textdomain('html5blank', get_template_directory() . '/languages');
}

/*------------------------------------*\
	Functions
\*------------------------------------*/

// HTML5 Blank navigation
function html5blank_nav()
{
  wp_nav_menu(
    array(
      'theme_location'  => 'header-menu',
      'menu'            => '',
      'container'       => 'div',
      'container_class' => 'menu-{menu slug}-container',
      'container_id'    => '',
      'menu_class'      => 'menu',
      'menu_id'         => '',
      'echo'            => true,
      'fallback_cb'     => 'wp_page_menu',
      'before'          => '',
      'after'           => '',
      'link_before'     => '',
      'link_after'      => '',
      'items_wrap'      => '<ul>%3$s</ul>',
      'depth'           => 0,
      'walker'          => ''
    )
  );
}

// Load HTML5 Blank scripts (header.php)
function html5blank_header_scripts()
{
  if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

    wp_register_script('conditionizr', get_template_directory_uri() . '/assets/js/lib/conditionizr-4.3.0.min.js', array(), '4.3.0'); // Conditionizr
    wp_enqueue_script('conditionizr'); // Enqueue it!

    wp_register_script('modernizr', get_template_directory_uri() . '/assets/js/lib/modernizr-2.7.1.min.js', array(), '2.7.1'); // Modernizr
    wp_enqueue_script('modernizr'); // Enqueue it!

    wp_register_script('owlscript', get_template_directory_uri() . '/assets/js/lib/owl.carousel.min.js', array('jquery')); // Conditionizr
    wp_enqueue_script('owlscript'); // Enqueue it!

    wp_register_script('html5blankscripts', get_template_directory_uri() . '/assets/js/scripts.js', array('jquery'), '1.6.0'); // Custom scripts
    wp_enqueue_script('html5blankscripts'); // Enqueue it!
  }
}

// Load HTML5 Blank styles
function html5blank_styles()
{
  wp_register_style('normalize', get_template_directory_uri() . '/assets/css/normalize.min.css', array(), '1.0', 'all');
  wp_enqueue_style('normalize'); // Enqueue it!

  wp_register_style('owlcarousel', get_template_directory_uri() . '/assets/css/owl.carousel.min.css', array(), '', 'all');
  wp_enqueue_style('owlcarousel'); // Enqueue it!

  wp_register_style('owltheme', get_template_directory_uri() . '/assets/css/owl.theme.default.min.css', array(), '', 'all');
  wp_enqueue_style('owltheme'); // Enqueue it!

  wp_register_style('icons', get_template_directory_uri() . '/assets/css/icons.css', array(), '1.0', 'all');
  wp_enqueue_style('icons'); // Enqueue it!

  wp_register_style('style', get_template_directory_uri() . '/style.css', array(), '2.6', 'all');
  wp_enqueue_style('style'); // Enqueue it!

  wp_register_style('menu', get_template_directory_uri() . '/assets/css/menu.css', array(), '1.1', 'all');
  wp_enqueue_style('menu'); // Enqueue it!
}


// Register HTML5 Blank Navigation
function register_html5_menu()
{
  register_nav_menus(array( // Using array to specify more menus if needed
    'header-menu' => __('Header Menu', 'html5blank'), // Main Navigation
    'sidebar-menu' => __('Sidebar Menu', 'html5blank'), // Sidebar Navigation
    'extra-menu' => __('Extra Menu', 'html5blank') // Extra Navigation if needed (duplicate as many as you need!)
  ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
  $args['container'] = false;
  return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
  return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
  return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
  global $post;
  if (is_home()) {
    $key = array_search('blog', $classes);
    if ($key > -1) {
      unset($classes[$key]);
    }
  } elseif (is_page()) {
    $classes[] = sanitize_html_class($post->post_name);
  } elseif (is_singular()) {
    $classes[] = sanitize_html_class($post->post_name);
  }

  return $classes;
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar')) {
  register_sidebar(array(
    'name' => __('Top header', 'html5blank'),
    'description' => __('Description for this widget-area...', 'html5blank'),
    'id' => 'top-header',
    'before_widget' => '<div id="%1$s" class="%2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>'
  ));

  register_sidebar(array(
    'name' => __('Sidfot 1', 'html5blank'),
    'description' => __('Description for this widget-area...', 'html5blank'),
    'id' => 'footer-area-1',
    'before_widget' => '<div id="%1$s" class="%2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>'
  ));

  register_sidebar(array(
    'name' => __('Sidfot 2', 'html5blank'),
    'description' => __('Description for this widget-area...', 'html5blank'),
    'id' => 'footer-area-2',
    'before_widget' => '<div id="%1$s" class="%2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>'
  ));

  register_sidebar(array(
    'name' => __('Sidfot 3', 'html5blank'),
    'description' => __('Description for this widget-area...', 'html5blank'),
    'id' => 'footer-area-3',
    'before_widget' => '<div id="%1$s" class="%2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>'
  ));

  register_sidebar(array(
    'name' => __('404', 'html5blank'),
    'description' => __('Description for this widget-area...', 'html5blank'),
    'id' => 'four-o-four-widget',
    'before_widget' => '<div id="%1$s" class="%2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>'
  ));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
  global $wp_widget_factory;
  remove_action('wp_head', array(
    $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
    'recent_comments_style'
  ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination()
{
  global $wp_query;
  $big = 999999999;
  echo paginate_links(array(
    'base' => str_replace($big, '%#%', get_pagenum_link($big)),
    'format' => '?paged=%#%',
    'current' => max(1, get_query_var('paged')),
    'total' => $wp_query->max_num_pages
  ));
}

/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */


// Custom Excerpts
function html5wp_index($length) // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
{
  return 15;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post($length)
{
  return 40;
}

// Create the Custom Excerpts callback
function html5wp_excerpt($length_callback = '', $more_callback = '')
{
  global $post;
  if (function_exists($length_callback)) {
    add_filter('excerpt_length', $length_callback);
  }
  if (function_exists($more_callback)) {
    add_filter('excerpt_more', $more_callback);
  }
  $output = get_the_excerpt();
  $output = apply_filters('wptexturize', $output);
  $output = apply_filters('convert_chars', $output);
  $output = '<p>' . $output . '</p>';
  echo $output;
}

function custom_length_excerpt($word_count_limit)
{
  $content = wp_strip_all_tags(get_the_content(), true);
  echo wp_trim_words($content, $word_count_limit);
}

// Custom View Article link to Post
function html5_blank_view_article($more)
{
  global $post;
  return '... ';
}


// add something like this to functions.php
function fredy_custom_excerpt($text)
{
  $text = strip_shortcodes($text);
  $text = apply_filters('the_content', $text);
  $text = str_replace(']]>', ']]>', $text);
  $excerpt_length = apply_filters('excerpt_length', 20);
  $excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
  return wp_trim_words($text, $excerpt_length, $excerpt_more);
}

function fredy_10_custom_excerpt($text)
{
  $text = strip_shortcodes($text);
  $text = apply_filters('the_content', $text);
  $text = str_replace(']]>', ']]>', $text);
  $excerpt_length = apply_filters('excerpt_length', 10);
  $excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
  return wp_trim_words($text, $excerpt_length, $excerpt_more);
}


// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
  return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions($html)
{
  $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
  return $html;
}

// Custom Gravatar in Settings > Discussion
function html5blankgravatar($avatar_defaults)
{
  $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
  $avatar_defaults[$myavatar] = "Custom Gravatar";
  return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments()
{
  if (!is_admin()) {
    if (is_singular() and comments_open() and (get_option('thread_comments') == 1)) {
      wp_enqueue_script('comment-reply');
    }
  }
}

// Custom Comments Callback
function html5blankcomments($comment, $args, $depth)
{
  $GLOBALS['comment'] = $comment;
  extract($args, EXTR_SKIP);

  if ('div' == $args['style']) {
    $tag = 'div';
    $add_below = 'comment';
  } else {
    $tag = 'li';
    $add_below = 'div-comment';
  }
?>
  <!-- heads up: starting < for the html tag (li or div) in the next line: -->
  <<?php echo $tag ?> <?php comment_class(empty($args['has_children']) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
    <?php if ('div' != $args['style']) : ?>
      <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
      <?php endif; ?>
      <div class="comment-author vcard">
        <?php if ($args['avatar_size'] != 0) echo get_avatar($comment, $args['180']); ?>
        <?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
      </div>
      <?php if ($comment->comment_approved == '0') : ?>
        <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
        <br />
      <?php endif; ?>

      <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)) ?>">
          <?php
          printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'), '  ', '');
                                                                                    ?>
      </div>

      <?php comment_text() ?>

      <div class="reply">
        <?php comment_reply_link(array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      </div>
      <?php if ('div' != $args['style']) : ?>
      </div>
    <?php endif; ?>
  <?php }

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'html5blank_header_scripts'); // Add Custom Scripts to wp_head
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'html5blank_styles'); // Add Theme Stylesheet
add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('avatar_defaults', 'html5blankgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'html5_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)


// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// Shortcodes
add_shortcode('html5_shortcode_demo', 'html5_shortcode_demo'); // You can place [html5_shortcode_demo] in Pages, Posts now.
add_shortcode('html5_shortcode_demo_2', 'html5_shortcode_demo_2'); // Place [html5_shortcode_demo_2] in Pages, Posts now.

// Shortcodes above would be nested like this -
// [html5_shortcode_demo] [html5_shortcode_demo_2] Here's the page title! [/html5_shortcode_demo_2] [/html5_shortcode_demo]

/*------------------------------------*\
	Custom Post Types
\*------------------------------------*/


function create_posttype_produkter()
{

  register_post_type(
    'exhibitions',
    array(
      'labels' => array(
        'name' => __('Exhibitions'),
        'singular_name' => __('Exhibition'),
        'add_new' => __('Add  new'),
        'add_new_item' => __('Create  new'),
        'edit_item' => __('edit')
      ),
      'public' => true,
      //'rewrite' => array( 'slug' => 'produkter/%produktkategori%', 'with_front' => false ),
      'has_archive' => 'exhibitions',
      'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
      'show_in_rest' => true,

    )
  );
}

function create_my_taxonomies_produkter()
{
  register_taxonomy(
    'exhibition-category',
    'exhibitions',
    array(
      'labels' => array(
        'name' => 'Categories',
        'add_new_item' => 'Add new category',
        'new_item_name' => "New category"
      ),
      'show_ui' => true,
      'show_in_rest' => true,
      //'rewrite' => array('slug' => 'produkter', 'with_front' => false),
      'show_tagcloud' => false,
      'hierarchical' => true,
      'show_admin_column' => true
    )
  );
}

function create_posttype_events()
{

  register_post_type(
    'events',
    array(
      'labels' => array(
        'name' => __('Events'),
        'singular_name' => __('Event'),
        'add_new' => __('Add  new'),
        'add_new_item' => __('Create  new'),
        'edit_item' => __('edit')
      ),
      'public' => true,
      //'rewrite' => array( 'slug' => 'produkter/%produktkategori%', 'with_front' => false ),
      'has_archive' => 'events',
      'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
      'show_in_rest' => true,

    )
  );
}

function create_my_taxonomies_events()
{
  register_taxonomy(
    'events-category',
    'events',
    array(
      'labels' => array(
        'name' => 'Categories',
        'add_new_item' => 'Add new category',
        'new_item_name' => "New category"
      ),
      'show_ui' => true,
      'show_in_rest' => true,
      //'rewrite' => array('slug' => 'produkter', 'with_front' => false),
      'show_tagcloud' => false,
      'hierarchical' => true,
      'show_admin_column' => true
    )
  );
}

// function wpa_show_permalinks( $post_link, $post ){
//     if ( is_object( $post ) && $post->post_type == 'produkter' ){
//         $terms = wp_get_object_terms( $post->ID, 'produktkategori' );
//         if( $terms ){
//             return str_replace( '%produktkategori%' , $terms[0]->slug , $post_link );
//         }
//     }
//     return $post_link;
// }

/**
 * Remove archive labels.
 * 
 * @param  string $title Current archive title to be displayed.
 * @return string        Modified archive title to be displayed.
 */
function my_theme_archive_title($title)
{
  if (is_category()) {
    $title = single_cat_title('', false);
  } elseif (is_tag()) {
    $title = single_tag_title('', false);
  } elseif (is_author()) {
    $title = '<span class="vcard">' . get_the_author() . '</span>';
  } elseif (is_post_type_archive()) {
    $title = post_type_archive_title('', false);
  } elseif (is_tax()) {
    $title = single_term_title('', false);
  }

  return $title;
}

add_action('init', 'create_posttype_produkter');
add_action('init', 'create_my_taxonomies_produkter', 0);
add_action('init', 'create_posttype_events');
add_action('init', 'create_my_taxonomies_events', 0);
add_filter('get_the_archive_title', 'my_theme_archive_title');
// add_filter( 'post_type_link', 'wpa_show_permalinks', 1, 2 );

/*------------------------------------*\
	ShortCode Functions
\*------------------------------------*/

// Shortcode Demo with Nested Capability
function html5_shortcode_demo($atts, $content = null)
{
  return '<div class="shortcode-demo">' . do_shortcode($content) . '</div>'; // do_shortcode allows for nested Shortcodes
}

// Shortcode Demo with simple <h2> tag
function html5_shortcode_demo_2($atts, $content = null) // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
{
  return '<h2>' . $content . '</h2>';
}

/*------------------------------------*\
    Egna funktioner
\*------------------------------------*/


// Allow SVG

function cc_mime_types($mimes)
{
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}

// ACF Options page
//felicia

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

function cspd_call_after_for_submit($contact_data)
{

  $contact_form = WPCF7_ContactForm::get_current();
  $contact_form_id = $contact_form->id;

  if ($contact_form_id == 592 || $contact_form_id == 678) {
    $relation = $_POST["relation"];
    $represent = $_POST["represent"];
    $people = $_POST["people"];
    $meaning = $_POST["meaning"];
    $description = $_POST["description"];
    $year = $_POST["yearCreate"];
    $month = $_POST["monthCreate"];
    $day = $_POST["dayCreate"];
    $photographers = $_POST["photographers"];
    $fornamn = $_POST["fornamn"];
    $efternamn = $_POST["efternamn"];
    $epost = $_POST["epost"];
    $contactways = $_POST["otherways"];
    $about = $_POST["aboutself"];
    $post_title = 'The interview series';
    $categoryID = 51;
    $content = '
        <!-- wp:heading {"level":2} -->
        <h2>Hur ser din relation till ditt familjearkiv: fotografier, filmklipp, ljudinspelningar, minnen, muntliga berättelser?</h2>
        <!-- /wp:heading -->
        <!-- wp:paragraph -->
        <p>' . $relation . '</p>
        <!-- /wp:paragraph -->
        <!-- wp:heading {"level":2} -->
        <h2>Du delar med dig av visuellt material som berör din familj. Vad representerar detta material för dig?</h2>
        <!-- /wp:heading -->
        <!-- wp:paragraph -->
        <p>' . $represent . '</p>
        <!-- /wp:paragraph -->
        <!-- wp:heading {"level":2} -->
        <h2>Beskriv kort personerna i bildmaterialet och situationen som avbildas, om möjligt</h2>
        <!-- /wp:heading -->
        <!-- wp:paragraph -->
        <p>' . $people . '</p>
        <!-- /wp:paragraph -->
        <!-- wp:heading {"level":2} -->
        <h2>Vad innebär ett Svart arkiv/Black archive för dig?</h2>
        <!-- /wp:heading -->
        <!-- wp:paragraph -->
        <p>' . $meaning . '</p>
        <!-- /wp:paragraph -->';
  } elseif ($contact_form_id == 637 || $contact_form_id == 679) {
    $description = $_POST["description"];
    $year = $_POST["yearCreate"];
    $month = $_POST["monthCreate"];
    $day = $_POST["dayCreate"];
    $photographers = $_POST["photographers"];
    $fornamn = $_POST["fornamn"];
    $efternamn = $_POST["efternamn"];
    $epost = $_POST["epost"];
    $contactways = $_POST["otherways"];
    $about = $_POST["aboutself"];
    $content = '<!-- wp:heading {"level":2} -->
        <h2>Om fotografierna</h2>
        <!-- /wp:heading -->
        <!-- wp:paragraph -->
        <p>' . $description . '</p>
        <!-- /wp:paragraph -->
        ';
    $post_title = 'Family Photo album';
    $categoryID = 49;
  }

  $name = $fornamn . " " . $efternamn;
  $date = $year . " " . $month . " " . $day;
  // create new CPT

  $submission = WPCF7_Submission::get_instance();
  if (!$submission) {
    return;
  }
  $posted_data = $submission->get_posted_data();

  $new_post = array();
  $new_post['post_title'] = $post_title . " - submitted by: " . $fornamn . " " . $efternamn;
  $new_post['post_type'] = 'post';
  $new_post['post_content'] = $content;
  $new_post['post_status'] = 'draft';

  //When everything is prepared, insert the post into your WordPress Database
  $post_id = wp_insert_post($new_post);


  update_field('field_6041d8dc93430', $name, $post_id); // author
  update_field('field_633dc189232bf', $epost, $post_id); // e-post
  update_field('field_633dc1a8232c1', $contactways, $post_id); // annan kontaktväg
  update_field('field_633dc1bd232c2', $about, $post_id); // about
  update_field('field_633dce2712b47', $photographers, $post_id); // fotografer
  update_field('field_633dd06a6da81', $date, $post_id); // date
  return;
}

function suppress_wpcf7_filter($value, $sub = "")
{
  $out    =   !empty($sub) ? $sub : $value;
  $out    =   strip_tags($out);
  $out    =   wptexturize($out);
  return $out;
}

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

add_filter('upload_mimes', 'cc_mime_types');
add_filter("wpcf7_mail_tag_replaced", "suppress_wpcf7_filter");
add_action('init', 'add_custom_taxonomies', 0);
add_action('wpcf7_before_send_mail', 'cspd_call_after_for_submit');
add_action('acf/init', 'my_acf_init_block_types');
  ?>