<?php snippet('header') ?>

<main class="content-container filtered-listings">

    <div class="section filtered" id="events">
        <ul class="events-container">
            <li class="nightschool-item first-item">
                <button class="events-toggle toggle" aria-expanded="true" aria-controls="events-items">
                    <h2 class="section-title">Program</h2>
                </button>
                <br><br>
                <?php snippet('listings', ['parentPageSlug' => 'nightschool', 'className' => 'events']); ?>
            </li>
        </ul>
    </div>

    <?php snippet('artists-filtered', ['filter' => 'nightschool']) ?>

    <?php snippet('description') ?>

</main>

<svg id="lineCanvas">
    <!-- squig -->
</svg>
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
<?php snippet('footer') ?>