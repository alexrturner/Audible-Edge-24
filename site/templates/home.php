<?php snippet('header') ?>


<svg id="lineCanvas">
    <!-- squig -->
</svg>
<button id="settingsButton">🦑</button>
<div id="input" class="hidden">
    <label for="noiseIntensity">Noise Intensity:</label>
    <input type="range" id="noiseIntensity" name="noiseIntensity" min="0" max="1000" step="10" value="800">
    <span id="noiseIntensityValue">800</span>

    <br>

    <label for="subdivisionFactor">Subdivision Factor:</label>
    <input type="range" id="subdivisionFactor" name="subdivisionFactor" min="1" max="20" value="2">
    <span id="subdivisionFactorValue">2</span>

    <br>

    <button id="toggleSquig">on</button>
</div>

<main>

    <div class="content-container">
        <?php snippet('menu') ?>

        <!-- Events Section -->
        <div class="section events" id="events">
            <ul class="events-container">
                <li class="events-item first-item">
                    <button class="events-toggle toggle" aria-expanded="true" aria-controls="events-items">Program <span class="icon-bar"></span></button>
                    <br><br>
                    <?php snippet('listings', ['parentPageSlug' => 'program', 'className' => 'events']); ?>
                </li>
            </ul>
        </div>

        <div class="section artists" id="artists">
            <ul class="artists-container">
                <li class="artists-item first-item">
                    <button class="artists-toggle toggle" aria-expanded="true" aria-controls="artists-items">Lineup <span class="icon-bar"></span></button>
                    <br><br>
                    <div class="artists-content">
                        <?php snippet('listings', ['parentPageSlug' => 'artists', 'className' => 'artists']); ?>
                    </div>
                </li>
            </ul>
        </div>
    </div>

</main>

<?php snippet('footer') ?>