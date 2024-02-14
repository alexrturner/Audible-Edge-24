<?php snippet('header') ?>

<style>
    .content-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        /* width: 100vw; */
        width: 100%;
        margin: 0;
    }

    .logo-container {
        display: flex;
        justify-content: center;
        align-items: center;

        /* position: relative; */
        height: auto;
        width: 100vw;
        position: fixed;
        height: 100vh;
        width: 100%;
        max-width: 60rem;
        top: 0;
    }

    .logo {
        height: auto;
        width: 100%;
    }

    #audio-buttons-container {
        position: relative;
    }

    .audio-button audio {
        display: none;
    }
</style>



<div id="audio-buttons-container">
    <?php $index = 0; ?>
    <?php foreach ($site->files()->template('audio_custom') as $audio) : ?>
        <button class="audio-button circle-button audio-btn-<?= $index ?>" data-audio="<?= $audio->url() ?>">
            <?= $audio->audio_category() ?>
            <audio id="audio-<?= $index ?>" src="<?= $audio->url() ?>"></audio>
        </button>

        <?php $index++; ?>
    <?php endforeach; ?>
</div>

<div class="intro-container">
    <?php $index = 0; ?>
    <?php foreach ($site->files()->template('audio_introduction') as $intro_audio) : ?>
        <button class="audio-intro-button circle-button audio-intro-btn-<?= $index ?>" data-audio="<?= $intro_audio->url() ?>">
            <?= $intro_audio ?>
            <audio id="audio-intro-<?= $index ?>" src="<?= $audio->url() ?>"></audio>
        </button>

        <?php $index++; ?>
    <?php endforeach; ?>

</div>

<main class="content-container">

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

    <section id="festive">
    </section>

</main>

<?= js('assets/js/save-the-date.js') ?>

<?php snippet('footer') ?>