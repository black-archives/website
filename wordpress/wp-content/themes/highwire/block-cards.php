<?php if( have_rows('puffar') ): ?>

<div class="grid grid-cols-2">
    

<?php while( have_rows('puffar') ) : the_row(); ?>
    <div class="col puff-col">
        <img src="<?= get_sub_field('bild')['url']; ?>" alt="<?= get_sub_field('bild')['alt']; ?>">
        <div class="col-content">
            <h2><?= get_sub_field('rubrik'); ?></h2>
            <p>
                <?= get_sub_field('kort_om'); ?>
            </p>
            <a href="<?= get_sub_field('lank')['url']; ?>" class="btn btn-primary"><?= get_sub_field('lank')['title']; ?> <img src="/wp-content/uploads/2021/03/Pil.svg" /></a>
        </div>
    </div>
<?php endwhile; ?>
</div>
<?php endif; ?>