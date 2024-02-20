<?php snippet('header') ?>

<style>
    .subtitle {
        list-style: disc;
    }

    ul.menu-container {
        margin: revert;
    }

    /* 
============
homepage main content sections
============
*/

    /* 
mobile layout
= menu, events, artists 
*/
    @media (max-width: 768px) {

        .all-listings #menu,
        .all-listings #events,
        .all-listings #artists {
            order: 1;
        }

        .all-listings .events {
            order: 2;
        }

        .all-listings .artists {
            order: 3;
        }
    }

    /* 
Desktop layout:
events, artists, menu
*/
    @media (min-width: 769px) {
        .all-listings #events {
            grid-column: 1 / span 2;
        }

        .all-listings #artists {
            grid-column: 3 / span 4;
        }

        .all-listings #menu {
            grid-column: 7;
        }

        .section {
            overflow-y: auto;
            /* Scrollable? */
        }
    }

    /* artists - two column layout */
    .artists-content {
        -webkit-column-count: 2;
        /* Chrome, Safari, Opera */
        -moz-column-count: 2;
        /* Firefox */
        column-count: 2;
        /* Standard syntax */

        -webkit-column-gap: 20px;
        /* Chrome, Safari, Opera */
        -moz-column-gap: 20px;
        /* Firefox */
        column-gap: 20px;
        /* Standard syntax */

        max-height: 100%;
        /* Adjust based on your layout */
    }

    /* artists - single column layout for mobile */
    @media (max-width: 768px) {

        #lineCanvas,
        #input {
            display: none;
        }

        .artists-content {
            -webkit-column-count: 1;
            -moz-column-count: 1;
            column-count: 1;
        }
    }
</style>

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
<?php snippet('settings') ?>

<?php snippet('footer') ?>