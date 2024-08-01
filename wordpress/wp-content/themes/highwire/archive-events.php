<?php get_header(); ?>

<main class="events" style="background: #F0F0F0;">
	<section class="search-top">
		<div style="padding-left: 50px;">
			<h1><?php the_archive_title('', false) ?></h1>
			<div class="col-3-4 top-search-field">
				<p><?php the_field('event-text', 'option'); ?></p>
			</div>
		</div>
	</section>
	<section class="post-feed">
		
		<?php if (have_posts()): while (have_posts()) : the_post(); ?>
			<div class="flex row-reverse" style="border-bottom: 1px solid #000;">

				<div class="col-f-1-2">
					<?php the_post_thumbnail(); ?>
				</div>
				<div class="col-f-1-2 event-col">

					<div class="box-content pad" style="position: relative;">

						<div class="top">
							<p class="date flex flex-space"><span><?php the_field('day');?></span><span><?php the_field('time'); ?></span></p>
							<p class="heading"><?php the_field('date');?></p>


						</div>
						<div class="bottom">
							<div>
								<h2><?php the_title(); ?></h2>
								<?php custom_length_excerpt(40); ?>
							</div>
							<?php if(get_field('link')): ?>
								<p><a href="<?php the_field('link'); ?>" class="btn btn-primary" style="margin-top: 40px;"><?php the_field('link_text'); ?><img src="/wp-content/uploads/2021/03/Pil.svg" alt="Go to event arrow"></a></p>
							<?php endif; ?>
						</div>


					</div>
				</div>


			</div>
		<?php  endwhile; ?>

	<?php endif; ?>

</section>
</main>

<?php get_footer(); ?>
