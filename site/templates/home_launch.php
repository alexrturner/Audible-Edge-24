<?php snippet('header') ?>

<main>

    <section id="festive">

        <div class="logo-container desktop">

            <?php
            // Retrieve files with the 'logo_landing' template
            $logoFile = $site->files()->template('logo_landing')->first();
            // Check if a file is found
            if ($logoFile) : ?>
                <a class="logo" href="<?= $site->url() ?>" title="<?= $site->title() ?>" aria-label="<?= $site->title() ?> Homepage">
                    <img src="<?= $logoFile->url() ?>" alt="<?= $logoFile->alt()->isEmpty() ? $site->title()->value() : $logoFile->alt() ?>">
                </a>
            <?php endif; ?>
        </div>


    </section>

</main>

<?php snippet('footer') ?>