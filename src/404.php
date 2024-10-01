<?php

/**
 * This is the 404 page that viewers see when they try to access a page that 
 * does not exist or is not accessible to them.
 */

get_header();

$error_message = "Ooops! We can't seem to find what you're looking for. ";
$contact_message = "Unfortunately, we couldn't find what you were looking for, but please contact us and we'll help with your questions and concerns: <a href='mailto:info@blackarchivessweden.com'>info@blackarchivessweden.com</a>.";
$contact_button = "Contact us";
$home_button = "Back to home";
?>

<main role="main">
  <div class="wrap pad">
    <article id="post-404">
      <span class="four-o-four">404</span>
      <h1>
        <?php _e($error_message, 'html5blank'); ?>
      </h1>

      <p>
        <?php _e($contact_message, 'bas'); ?>
      </p>

      <a class="btn btn-primary" href="/kontakt/"><?php _e($contact_button, 'bas'); ?></a>
      <a class="btn btn-secondary" href="<?php echo home_url(); ?>"><?php _e($home_button, 'bas'); ?></a>

      <!--<?php get_template_part('searchform'); ?>-->
      <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('four-o-four-widget')) ?>
    </article>
  </div>
</main>
<?php get_footer(); ?>