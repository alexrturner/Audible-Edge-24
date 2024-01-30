<?php snippet('header') ?>


<main class="content">
    <div class="text-container">
        <div class="text">
            <h1><?= $page->title() ?></h1>
            <?= $page->text()->kirbytext() ?>
        </div>
    </div>

    <div class="image-container">
        <?php if ($image = $page->image()) : ?>
            <img src="<?= $image->url() ?>" alt=" <?= $image->alt() ?>" />
        <?php endif; ?>
    </div>
</main>



<?php snippet('footer') ?>