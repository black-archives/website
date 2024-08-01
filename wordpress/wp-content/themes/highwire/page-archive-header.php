<?php /* Template Name: Arkivheader */ ?>

<?php get_header(); ?>



<main role="main" class="archive-page">
	<section class="front-heading">
		<div class="col-3-4">
			<h1><?= get_the_title(); ?></h1>
			<p>
				<?= get_the_content(); ?>
			</p>
		</div>
	</section>
	
	<section class="post-feed post-feed--single">
		<div class="flex">
			<?php 

			global $post;

			$args = array(
			    'post_parent' => $post->ID,
			    'posts_per_page' => -1,
			    'post_type' => 'page', //you can use also 'any'
			    );


			$the_query = new WP_Query( $args );


			if( $the_query->have_posts() ):
				while( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<div class="col-f-1-3" style="background-image: url('<?= get_the_post_thumbnail_url(); ?>');">
						<div class="">
							<a href="<?php the_permalink(); ?>">
								
									<div class="post-hover-box">
										<div class="top">
											
											<h2><?php the_title();?></h2>

										</div>
										<div class="bottom">
											<p>
												<?= get_field('short_about'); ?>
											</p>							
											            <button class="btn btn-primary"><?= _e('Submit', ' bas'); ?> <img src="/wp-content/uploads/2021/03/Pil.svg" /></button>

										</div>


									</div>
									
								</a>
							</div>
						</div>



					<?php	endwhile; 
				else :

				endif; 
				?>
			</div>
		</section>	
	</main>

<?php get_footer(); ?>