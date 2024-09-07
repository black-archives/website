<aside class="sidebar" role="complementary">

  <?php get_template_part('searchform'); ?>
  <?php get_sidebar(); ?>

  <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('top-header')) ?>
  <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-area-1')) ?>
  <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-area-2')) ?>
  <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-area-3')) ?>
  <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('four-o-four-widget')) ?>
</aside>