<?php snippet('header') ?>

<main class="content-container">

    <div class="section nightschool" id="nightschool">
        <ul class="nightschool-container">
            <li class="nightschool-item first-item">
                <button class="nightschool-toggle toggle" aria-expanded="true" aria-controls="nightschool-items">Program <span class="icon-bar"></span></button>
                <br><br>
                <?php snippet('listings', ['parentPageSlug' => 'nightschool', 'className' => 'nightschool']); ?>
            </li>
        </ul>
    </div>


    <?php snippet('artists-filtered', ['filter' => 'nightschool']) ?>

    <?php snippet('description') ?>

</main>
<?php snippet('footer') ?>