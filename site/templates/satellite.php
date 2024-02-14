<?php snippet('header') ?>

<main class="content-container">

    <div class="section satellite" id="events">
        <ul class="satellite-container">
            <li class="satellite-item first-item">
                <button class="satellite-toggle toggle" aria-expanded="true" aria-controls="satellite-items">
                    <h2 class="section-title">Program</h2>
                </button>
                <br><br>
                <?php snippet('listings', ['parentPageSlug' => 'satellite', 'className' => 'satellite']); ?>
            </li>
        </ul>
    </div>

    <?php snippet('artists-filtered', ['filter' => 'satellite']) ?>

    <?php snippet('description') ?>

</main>

<?php snippet('footer') ?>