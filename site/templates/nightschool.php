<?php snippet('header') ?>

<main class="content-container">

    <div class="section filtered" id="events">
        <ul class="nightschool-container">
            <li class="nightschool-item first-item">
                <button class="nightschool-toggle toggle" aria-expanded="true" aria-controls="nightschool-items">
                    <h2 class="section-title">Program</h2>
                </button>
                <br><br>
                <?php snippet('listings', ['parentPageSlug' => 'nightschool', 'className' => 'nightschool']); ?>
            </li>
        </ul>
    </div>

    <?php snippet('artists-filtered', ['filter' => 'nightschool']) ?>

    <?php snippet('description') ?>

</main>
<?php snippet('footer') ?>