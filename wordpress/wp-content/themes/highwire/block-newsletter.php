<div class="outer-container">
    <div class="form-container">
        <h1><?= get_field('rubrik'); ?></h1>
        <p class="before">
            <?= get_field('text_innan'); ?>
        </p>
        <div>
            <?= do_shortcode(get_field('kortkod_formular'));  ?>
        </div>
        <div class="after"><?= get_field('text_efter'); ?></div>
    </div>
</div>