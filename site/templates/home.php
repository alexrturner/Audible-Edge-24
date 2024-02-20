<?php snippet('header') ?>




<main>

    <div class="content-container all-listings">
        <?php snippet('menu') ?>

        <div class="section events" id="events">
            <ul class="events-container">
                <li class="events-item first-item">
                    <button class="events-toggle toggle" aria-expanded="true" aria-controls="events-items">Program</span></button>
                    <br><br>
                    <?php snippet('listings', ['parentPageSlug' => 'program', 'className' => 'events']); ?>
                </li>
            </ul>
        </div>

        <div class="section artists" id="artists">
            <ul class="artists-container">
                <li class="artists-item first-item">
                    <button class="artists-toggle toggle" aria-expanded="true" aria-controls="artists-items">Lineup</span></button>
                    <br><br>
                    <div class="artists-content">
                        <?php snippet('listings', ['parentPageSlug' => 'artists', 'className' => 'artists']); ?>
                    </div>
                </li>
            </ul>
        </div>
    </div>

</main>


<svg id="lineCanvas">
    <!-- squig -->
</svg>
<button id="settingsButton" style="display:none;">settings</button>
<div id="input" class="hidden" style="display:none;">
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

<?php snippet('footer') ?>