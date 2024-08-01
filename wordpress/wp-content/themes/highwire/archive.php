<?php get_header(); ?>

<main class="exhibitions" style="background: #F0F0F0;">
	
	<section class="search-top">
		<div class="wrap-l">
			<h1><?php the_archive_title('', false) ?></h1>
			<div class="col-3-4 top-search-field">
				<?php the_field('exhibitions-text', 'option'); ?>
			</div>
		</div>
	</section>
	<section class="post-feed">
		<div class="flex">
			
			<?php if (have_posts()): while (have_posts()) : the_post(); ?>

				<div class="col-f-1-3">
					<div class="box-content <?php if(has_post_thumbnail()): echo 'hover-active'; endif; ?> ">
						<a href="<?php the_permalink(); ?>">
							<?php if(has_post_thumbnail()): 
								the_post_thumbnail(); ?>
								<div class="post-hover-box">
									<div class="top">

										<h2><?php the_title();?></h2>
										<div class="info">
											<span>By: <?php if(get_field('author')): the_field('author'); else: the_author(); endif;?>
										</div>

									</div>
									<div class="bottom">
										<p><?php  custom_length_excerpt(10);  ?></p>

									</div>


								</div>
							</a>
						</div>
					</div>


				<?php endif; endwhile; ?>

			<?php endif; ?>
		</div>
	</section>
</main>

<?php get_footer(); ?>
