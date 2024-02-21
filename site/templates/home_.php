<?php snippet('header') ?>

<style>
    body {
        overflow-y: hidden;
    }

    .ae-title {
        display: flex;
        justify-content: center;
        align-items: center;

        width: min-content;
        white-space: initial;
        position: fixed;
        bottom: 33%;
        left: 20%;
        z-index: 100;
        font-size: var(--fs-big);
        letter-spacing: -0.06em;
        font-weight: normal;
    }

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
        display: block !important;
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
        width: 100%;
        max-width: 60rem;
        height: 100%;
        display: flex !important;
        justify-content: center;
        align-items: center;
    }

    @media screen and (max-width: 768px) {
        .logo-container {
            position: absolute;
            display: block !important;
            top: -10vh;
        }
    }

    #audio-buttons-container {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
    }

    .audio-button,
    .audio-intro-button {
        pointer-events: auto;
        /* Ensure buttons can be interacted with */
        position: absolute;
        z-index: 15;
        line-height: 1;
        display: flex !important;
        justify-content: center;
        align-content: center;

    }

    .audio-button {
        /* transition: all 0.3s ease; */
        animation-fill-mode: forwards;
    }

    .audio-button:hover {
        background-color: var(--cc-olive-highlight);
    }

    @keyframes shake {
        0% {
            transform: translate(0, 0) rotate(0);
        }


        50% {
            transform: translate(-5px, 0) rotate(-5deg);
        }


        100% {
            transform: translate(0, 0) rotate(0);
        }
    }

    .content-container {
        /* height: auto; */
        /* position: relative; */
        max-height: fit-content;
    }

    .audio-intro-container {
        position: absolute;
        bottom: 0;
        pointer-events: auto !important;
    }

    #menu {
        position: fixed;
        right: 1em;
        width: fit-content;
    }

    /* 
    SVG colours and opacity 
    */
    .cls-1,
    .cls-2,
    .cls-3 {
        opacity: 1 !important;
    }

    svg path,
    svg polyline {
        fill: var(--cc-olive);
        stroke: var(--cc-olive) !important;
    }





    .cls-3 {
        fill: var(--cc-orange) !important;
        /* animation: fill 2s linear infinite; */
    }

    svg path.cls-2 {
        /* fill: var(--cc-olive-light) !important; */
        opacity: 0.8 !important;
        animation: fill 12s linear infinite;
    }



    .cls-1 {
        /* fill: var(--cc-purple-highlight) !important; */
        /* opacity: 0.2; */

        stroke: var(--cc-olive) !important;
        /* stroke: var(--cc-purple-highlight) !important; */
    }

    @keyframes fill {
        0% {
            fill: var(--cc-olive-highlight);
        }

        50% {
            fill: var(--cc-olive-light);
        }

        100% {
            fill: var(--cc-olive-highlight);
        }
    }

    @-moz-keyframes fill {
        0% {
            fill: var(--cc-olive-highlight);
        }

        50% {
            fill: var(--cc-olive-light);
        }

        100% {
            fill: var(--cc-olive-highlight);
        }
    }
</style>







<main class="content-container">

    <div class="homepage__dates">
        <span class="hidden">Festival Dates:</span>
        <span>April</span>
        <span>26–28</span>
    </div>
    <div id="svg-container" class="logo-container desktop" style="display: none;">
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

    <div id="audio-buttons-container" style="display: none;">
        <?php $index = 0; ?>
        <?php foreach ($site->files()->template('audio_custom') as $audio) : ?>
            <button class="audio-button circle-button audio-btn-<?= $index ?>" data-audio="<?= $audio->url() ?>">
                <?= $audio->audio_category() ?>
                <audio id="audio-<?= $index ?>" src="<?= $audio->url() ?>"></audio>
            </button>

            <?php $index++; ?>
        <?php endforeach; ?>
    </div>

    <div class="audio-intro-container">
        <?php $index = 0; ?>
        <?php foreach ($site->files()->template('audio_intro') as $intro_audio) : ?>

            <?= kt($site->audio_intro_text()) ?>
            <button class="audio-intro-button circle-button audio-intro-btn-<?= $index ?>" data-audio="audio-intro-<?= $index ?>" onclick="playPauseIntro(this)" style="display: none;">
            </button>

            <audio id="audio-intro-<?= $index ?>" class="audio-intro" src="<?= $intro_audio->url() ?>" controls></audio>

            <?php $index++; ?>
        <?php endforeach; ?>

    </div>

    <div class="content-container all-listings">
        <?php snippet('menu') ?>
    </div>

</main>

<?= js('assets/js/save-the-date.js') ?>

<?php snippet('footer') ?>