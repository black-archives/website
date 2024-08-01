<?php if (have_posts()): while (have_posts()) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php if ( has_post_thumbnail()) : ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php the_post_thumbnail('square-size'); ?>
			</a>
		<?php endif; ?>
		
		<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
		
		<span class="date"><?php the_time('j F Y'); ?></span>
		
		<?php html5wp_excerpt('html5wp_index'); ?>

	</article>

<?php endwhile; ?>

<?php endif; ?>
