<?php snippet('header') ?>
<main class="content">
    <div class="text-container">

        <?php snippet('intro') ?>
        <section class="text">
            <?php if ($page->description()->isNotEmpty()) : ?>
                <div class="project-description">
                    <?= kt($page->description()) ?>
                </div>
            <?php endif ?>
            <?php if ($page->links()->isNotEmpty()) : ?>
                <div class="project-links">
                    <?= kt($page->links()) ?>
                </div>
            <?php endif ?>
        </section>
    </div>
    <div class="image-container">
        <?php if ($image = $page->image()) : ?>
            <img src="<?= $image->url() ?>" alt=" <?= $image->alt() ?>" />
        <?php endif; ?>
    </div>

</main>
<?php snippet('footer') ?>