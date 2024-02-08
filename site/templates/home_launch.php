<?php snippet('header') ?>

<?php if ($works = page('works')) : ?>
<?php endif ?>

<main>

    <section id="festive">

        <div class="logo-container desktop">
            <a class="logo" href="<?= $site->url() ?>" title="<?= $site->title() ?>" aria-label="<?= $site->title() ?> Homepage">
                <?= svg('assets/img/logo-2.svg') ?>
            </a>
        </div>

    </section>

</main>

<?php snippet('footer') ?>