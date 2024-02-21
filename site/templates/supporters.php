<?php snippet('header') ?>

<main class="content-container index">

    <section class="description">
        <div>
            <?= kt($page->description()) ?>
        </div>
    </section>

    <section class="logos">

        <?php
        // display full logos after Program Launch
        date_default_timezone_set('Australia/Perth');
        $currentDate = new DateTime();
        $cutoffDate = new DateTime('2024-03-12');

        if ($currentDate < $cutoffDate) : ?>
            <div class="logos-partial">
                <?php foreach ($page->partialLogos()->toFiles() as $logo) : ?>
                    <img style="max-width: 100%;" src="<?= $logo->url() ?>" alt="<?= $logo->alt()->escape() ?>">
                <?php endforeach; ?>
            </div>

        <?php else : ?>
            <div class="logos-small">
                <?php foreach ($page->smallLogos()->toFiles() as $logo) : ?>
                    <img style="max-width: 100%;" src="<?= $logo->url() ?>" alt="<?= $logo->alt()->escape() ?>">
                <?php endforeach; ?>
            </div>

            <div class="logos-medium">
                <?php foreach ($page->mediumLogos()->toFiles() as $logo) : ?>
                    <img style="max-width: 100%;" src="<?= $logo->url() ?>" alt="<?= $logo->alt()->escape() ?>">
                <?php endforeach; ?>
            </div>

            <div class="logos-large">
                <?php foreach ($page->largeLogos()->toFiles() as $logo) : ?>
                    <img style="max-width: 100%;" src="<?= $logo->url() ?>" alt="<?= $logo->alt()->escape() ?>">
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </section>
    </div>
</main>

<?php snippet('footer') ?>