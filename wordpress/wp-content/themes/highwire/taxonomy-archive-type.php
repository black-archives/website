<?php get_header(); ?>

<main role="main" class="archive-page">
	<section class="front-heading">
		<div class="col-3-4">
			
<?php $term = get_queried_object();  
		$archiveType = $term->taxonomy;
?>
 
<h1 class="category-title"><?php echo $term->name; ?></h1>

<p><?php echo $term->description; ?></p>
		</div>
	</section>
	<section class="sub-page-menu" style="position: relative;">
		<div class="flex flex-space vert-center">
			<div class="col-f-1-4 cat-dropdown">
				<div class="relative" style="position: relative;">
					<button class="open-dd"><?php echo $term->name; ?></button>
					<ul class="hidden main-dd">
							<?php if(!is_home()): ?>
							<li><a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>"><?php _e('Full archive'); ?></a></li>
							<?php endif; ?>
							<?php 
						foreach( get_terms( 'archive-type', array( 'hide_empty' => false, 'parent' => 0 ) ) as $parent_term ) : ?>
						<li><a href="<?= get_term_link($parent_term); ?>"><?= $parent_term->name ; ?></a>
							<?php if( get_terms( 'archive-type', array( 'hide_empty' => false, 'parent' => $parent_term->term_id ) )): 
								foreach( get_terms( 'archive-type', array( 'hide_empty' => false, 'parent' => $parent_term->term_id ) ) as $child_term ): ?>
							<ul class="child-dd">
								<li><a href="<?= get_term_link($child_term); ?>"><?= $child_term->name ; ?></a></li>
							</ul>
						<?php endforeach; endif; ?>
						</li>
					<?php endforeach; ?>
			
					</ul>
				</div>
			</div>
			<div class="col-f-1-2">
				<ul class="menu-list flex flex-space">

					<?php $categories = get_categories();
					foreach($categories as $category) : ?>

						<?php $cat_url = esc_url( get_category_link( $category->term_id )) ;?>
						<li id="<?= $category->slug; ?>" class="filter-tags <?php if($category->slug === 'all'): echo 'active'; endif;?>"><?php echo $category->name ?></li>

					<?php endforeach; ?>
				</ul> 
			</div>
			<div class="col-f-1-4">
				<form class="search" method="get" action="<?php echo home_url(); ?>" role="search">
					<input class="archive-search" type="search" name="s" placeholder="<?php _e( 'Search', 'html5blank' ); ?>">
				</form>
			</div>
		</div>
	</section>
	<section class="post-feed">
		<div class="flex">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<div class="col-f-1-3 post-boxes active <?php 
												
												foreach($categories as $category) {
													echo $category->slug ." ";
												} ?> ">
						<div class="box-content <?php if(has_post_thumbnail()): echo 'hover-active'; endif; ?> ">
							<a href="<?php the_permalink(); ?>">
								<?php if(has_post_thumbnail()): 
									the_post_thumbnail(); ?>
									<div class="post-hover-box">
										<div class="top">
											
											<h2><?php the_title();?></h2>

										</div>
										<div class="bottom">
											<p class="show-desktop"><?php if(get_field('short_about')):  echo fredy_custom_excerpt(get_field('short_about')); else: custom_length_excerpt(20);endif;   ?></p>
											<p class="show-ipad"><?php if(get_field('short_about')):  echo fredy_10_custom_excerpt(get_field('short_about')); else: custom_length_excerpt(8);endif;   ?></p>								
											<ul class="cat-list">
												<?php 
												$args = array(
													'exclude' => '1'
												);
												$categories = get_categories( $args );
												foreach($categories as $category) {
													echo "<li>".$category->name ."</li>";
												} ?>
											</ul>
										</div>


									</div>
								<?php	else: ?>
									<div class="post-text-box">
										<div class="top">

											<h2><?php the_title();?></h2>

										</div>
										<div class="bottom">
											<p class="show-desktop"><?php if(get_field('short_about')):  echo fredy_custom_excerpt(get_field('short_about')); else: custom_length_excerpt(20);endif;   ?></p>
											<p class="show-ipad"><?php if(get_field('short_about')):  echo fredy_10_custom_excerpt(get_field('short_about')); else: custom_length_excerpt(8);endif;   ?></p>										
											<ul class="cat-list">
												<?php 
												$args = array(
													'exclude' => '1'
												);
												$categories = get_categories( $args );
												foreach($categories as $category) {
													echo "<li>".$category->name ."</li>";
												} ?>
											</ul>
										</div>

									</div>
								<?php endif; ?>
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
