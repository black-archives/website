<?php get_header(); ?>

<main role="main" class="single-page">
	<div class="breadcrumbs">

		<?php
		if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
		}
		?>
	</div>
	<div class="wrap-s">
		<?php if (have_posts()): while (have_posts()) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<ul class="cat-list">
					<?php wp_list_categories( array(
						'orderby' => 'name',
						'title_li'           => __( '' ),
						'exclude'	=> 1
					) ); ?> 
				</ul>

				<h1><?php the_title(); ?></h1>
				<div class="ingress"><?php the_field('short_about'); ?></div>
				<div class="info">
					<span><?php _e('Words by:' , 'bas'); ?> <?php if(get_field('author')): the_field('author'); else: the_author(); endif;?></span> <span><?php _e('Published on:' , 'bas');?> <?php the_date(); ?></span>
				</div>
				<div class="main-content">
					<?php the_content(); ?>
				</div>


			</article>


		<?php endwhile; ?>

	<?php endif; ?>
</div>
</main>

<?php get_footer(); ?>
