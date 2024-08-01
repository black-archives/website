<?php get_header(); ?>

	<main role="main">
			<div class="wrap pad">
			<article id="post-404">
				<span class="four-o-four">404</span>
				<h1><?php _e( 'Ooops! Vi kan tyvärr inte hitta det du sökte efter. ', 'html5blank' ); ?></h1>
				<p><?php _e('Tyvärr kunde vi inte hitta det du letade efter, men kontakta oss gärna så hjälper vi till med dina frågor och funderingar: <a href="mailto:info@blackarchivessweden.com">info@blackarchivessweden.com</a>.', 'bas'); ?></p>
				<a class="btn btn-primary" href="/kontakt/">Kontakta oss</a>
				<a class="btn btn-secondary" href="<?php echo home_url(); ?>"><?php _e('Till startsidan', 'bas'); ?></a>
				<?php //get_template_part('searchform'); ?>
				<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('four-o-four-widget')) ?>
			</article>
			</div>
	</main>

<?php get_footer(); ?>
