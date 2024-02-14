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

    svg {
        width: 100%;
        height: 100%;
    }

    .logo {
        height: auto;
        width: 100%;
    }

    #audio-buttons-container {
        position: relative;
        max-width: 60rem;
    }

    .audio-button audio {
        display: none;
    }

    #svg-container {
        width: 100%;
        height: 100%;

    }

    .logo-container {
        position: relative;
        /* Ensure this is positioned relative or absolute */
        width: 100%;
        /* Adjust width as necessary to match SVG scaling */
        max-width: 60rem;
        /* Match SVG container's max width */
        height: 100%;
        /* Adjust height to match SVG's aspect ratio if necessary */
        display: flex;
        justify-content: center;
        align-items: center;
        /* max-height: 66vh; */
    }

    #audio-buttons-container {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        /* Ensure it matches the .logo-container's dimensions */
        height: 100%;
        pointer-events: none;
        /* Allows clicks to pass through when not over buttons */
    }

    .audio-button,
    .audio-intro-button {
        pointer-events: auto;
        /* Ensure buttons can be interacted with */
        position: absolute;
        /* Position buttons absolutely within their container */
        z-index: 12;
        line-height: 1;
        display: flex;
        justify-content: center;
        align-content: center;

    }

    .audio-button {
        transition: all 0.3s ease;
    }

    .content-container {
        /* height: auto; */
        /* position: relative; */
        max-height: fit-content;
    }


    /* svg path {
        opacity: 1 !important;
    } */

    /* svg opacity */
    .cls-1,
    .cls-2,
    .cls-3 {
        opacity: 1 !important;
    }


    .cls-3 {
        fill: var(--cc-orange) !important;
    }

    .cls-2 {
        fill: var(--cc-olive-highlight) !important;
    }

    .cls-1 {
        /* fill: var(--cc-purple-highlight) !important; */
        /* opacity: 0.2; */

        stroke: var(--cc-blue) !important;
    }
</style>







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
        <?php foreach ($site->files()->template('audio_intro') as $intro_audio) : ?>
            <button class="audio-intro-button circle-button audio-intro-btn-<?= $index ?>" data-audio="<?= $intro_audio->url() ?>">

            </button>
            <?= kt($site->audio_intro_text()) ?>
            <audio id="audio-intro-<?= $index ?>" src="<?= $intro_audio->url() ?>" controls></audio>

            <?php $index++; ?>
        <?php endforeach; ?>

    </div>

    <div class="content-container all-listings">
        <?php snippet('menu') ?>

    </div>

</main>

<?= js('assets/js/save-the-date.js') ?>

<?php snippet('footer') ?>