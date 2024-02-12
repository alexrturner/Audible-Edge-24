<?php snippet('header') ?>

<main class="content-container">

    <!-- associsated event -->
    <section class="section" id="col1">
        <?php $events = $page->events()->toPages(); ?>
        <?php if ($events->isNotEmpty()) : ?>

            <ul class="associated-events">
                <?php foreach ($events as $event) : ?>
                    <li>
                        <a href="<?= $event->url() ?>">
                            <?= $event->title()->html() ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>


    </section>

    <!-- artists, images -->
    <section class="section" id="col2">
        <ul class="artists" id="events-items">
            <li class="artists-item" data-type="artists" data-id="<?= $page->id() ?>">
                <h2 class="title"><?= $page->title()->html() ?></h2>
            </li>
        </ul>

        <?php if ($credits = $page->credits()->toStructure()) : ?>
            <ul class="credits">
                <?php foreach ($credits as $credit) : ?>
                    <li>
                        <?php if ($credit->other_name()->isNotEmpty()) : ?><?= $credit->other_name()->html() ?><?php endif; ?>&nbsp;<?php if ($credit->sort_name()->isNotEmpty()) : ?><?= $credit->sort_name()->html() ?><?php endif; ?><?php if ($credit->group()->isNotEmpty()) : ?>&nbsp;(<?= $credit->group()->html() ?>)<?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <?php if ($page->images()->isNotEmpty()) : ?>
            <div class="artist-images">
                <?php foreach ($page->images() as $image) : ?>
                    <figure>
                        <img src="<?= $image->resize(50)->url() ?>" alt="<?= $image->alt()->or($page->title()->html()) ?>" loading="lazy">
                        <figcaption><?= $image->caption()->or('') ?></figcaption>
                    </figure>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>


    </section>

    <!-- description and links -->
    <section class="section" id="col3">

        <?php if ($bio_short = $page->bio_short()->kirbytext()) : ?>
            <div class="bio-short">
                <?= $bio_short ?>
            </div>
        <?php endif; ?>

        <?php if ($bio_long = $page->bio_long()->kirbytext()) : ?>
            <div class="bio-long">
                <?= $bio_long ?>
            </div>
        <?php endif; ?>

        <?php $links = $page->links()->toStructure(); ?>
        <?php if ($links->isNotEmpty()) : ?>
            <ul class="artist-links">
                <?php foreach ($links as $link) : ?>
                    <li>
                        <a href="<?= $link->url() ?>" <?= $link->popup()->toBool() ? 'target="_blank"' : '' ?>>

                            <?= $link->text()->html() ?>
                            (
                            <?php
                            // Construct the SVG file path based on the link type
                            $type = $link->type()->value(); // Assuming $link->type() returns the type name
                            $svgFilePath = 'assets/imgs/icons/' . $type . '.svg';

                            // Use the svg() function to include the SVG file, if it exists
                            if (file_exists($svgFilePath)) {
                                svg($svgFilePath);
                            } else {
                                // Fallback if the SVG file doesn't exist
                                echo htmlspecialchars($type);
                            }
                            ?>
                            )
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <?php if ($page->support()->isNotEmpty()) : ?>
            <p class="support">Supported By: <?= $page->support() ?></p>
        <?php endif; ?>
    </section>

    <!-- sounds -->
    <section class="section" id="col4">

        <?php
        // Fetch files using the 'audio' template
        $sounds = $page->files()->template('audio');
        $counter = 0;
        if ($sounds->isNotEmpty()) : ?>
            <div class="artist-sounds">
                <?php foreach ($sounds as $sound) : ?>
                    <audio id="audioSample<?= $counter ?>" class="audio-sample" controls>
                        <source src="<?= $sound->url() ?>" type="<?= $sound->mime() ?>">
                        Your browser does not support the audio element.
                    </audio>
                    <button id="playAudioButton<?= $counter ?>" class="circle-button play-audio-button"></button>
                    <?php $counter++; ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>


    </section>
</main>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get all play buttons
        var playButtons = document.querySelectorAll('.play-audio-button');

        playButtons.forEach(function(button, index) {
            // Each button controls the corresponding audio element
            var audioSample = document.getElementById('audioSample' + index);

            button.addEventListener("click", function() {
                // Check if this audio is already playing
                if (!audioSample.paused) {
                    audioSample.pause();
                    audioSample.currentTime = 0; // Optionally reset audio to start
                    this.classList.remove("clicked");
                } else {
                    // Pause any other playing audio samples
                    document.querySelectorAll('.audio-sample').forEach(function(otherAudio) {
                        otherAudio.pause();
                        otherAudio.currentTime = 0; // Optionally reset audio to start
                    });
                    // Reset all buttons to their initial state
                    document.querySelectorAll('.play-audio-button').forEach(function(otherButton) {
                        otherButton.classList.remove("clicked");
                    });

                    // Play this audio
                    audioSample.play();
                    this.classList.add("clicked");
                }
            });

            // When the audio has ended, change the button background back to its original style
            audioSample.onended = function() {
                button.classList.remove("clicked");
            };
        });
    });
</script>
<?php snippet('footer') ?>