<?php snippet('header') ?>

<style>
    /* 
============
cards 
============
*/
    .pill {
        display: flex;
        flex-wrap: wrap;
    }

    .cards {
        padding: calc(var(--gap) / 2);
    }

    .cards:not(.masonry) {
        display: flex;
        flex-wrap: wrap;
    }

    .cards:not(.masonry) .card {
        width: 50%;
    }

    @media (max-width: 640px) {
        .cards:not(.masonry) .card {
            width: 100%;
        }
    }

    .card {
        display: block;
        margin-bottom: var(--gap);
        padding: calc(var(--gap) / 2);
    }

    .card .inner {
        border-top: var(--hr);
        padding-top: var(--gap);
    }

    .card .pill {
        margin-bottom: 1rem;
    }

    .card h2 {
        font-size: var(--h2);
        letter-spacing: -0.02em;
        line-height: 0.9;
        margin-bottom: var(--gap);
    }

    .card figure {
        margin-bottom: 1.2rem;
    }

    #col-team {
        grid-column: 3 / span 5;
    }
</style>



<main class="content-container">
    <section class="section" id="col1">
        <h1><?= $page->title() ?></h1>
        <p><?= $page->description()->kirbytext() ?></p>
    </section>





    <section class="section team-members" id="col-team">
        <div class="cards">
            <?php foreach ($page->children()->listed() as $teamMember) : ?>

                <div class="card masonry">
                    <div class="inner">
                        <h2><?= $teamMember->title() ?></h2>
                        <span class="roles pill"><?= $teamMember->roles() ?></span>


                        <?php if ($teamMember->image()->isNotEmpty()) : ?>
                            <figure>
                                <img src="<?= $teamMember->image()->url() ?>" alt="<?= $teamMember->title() ?>">
                            </figure>
                        <?php endif; ?>
                        <p><?= $teamMember->bio_short()->kirbytext() ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php snippet('footer') ?>