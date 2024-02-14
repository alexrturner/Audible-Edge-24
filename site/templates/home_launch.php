<?php snippet('header') ?>

<style>
    .content-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        width: 100vw;
    }

    .logo-container {
        /* display: flex;
        justify-content: center;
        align-items: center; */
        position: relative;
        height: auto;
        width: 100vw;
    }

    .logo {
        height: auto;
        width: 100%;
    }

    #audio-buttons-container {
        position: relative;
    }
</style>



<div id="audio-buttons-container">
    <?php $index = 0; ?>
    <?php foreach ($site->files()->template('audio_custom') as $audio) : ?>
        <button class="audio-button circle-button audio-btn-<?= $index ?>" data-audio="<?= $audio->url() ?>">
            <?= $audio->audio_category() ?>

        </button>
        <audio id="audio-<?= $index ?>" src="<?= $audio->url() ?>"></audio>
        <?php $index++; ?>
    <?php endforeach; ?>
</div>

<main class="content-container">

    <section id="festive">

        <div id="svg-container" class="logo-container desktop">
            <?php
            $logoFiles = $site->files()->template('ae_logo');
            $index = 0;
            foreach ($logoFiles as $file) :
            ?>
                <div class="logo" id="logo-<?= $index ?>" style="<?= $index > 0 ? 'display: none;' : '' ?>">
                    <?= $file->read() ?>
                </div>
            <?php
                $index++;
            endforeach;
            ?>

        </div>

    </section>

</main>

<?= js('assets/js/save-the-date.js') ?>

<?php snippet('footer') ?>