<?php snippet('header') ?>

<style>
    .tag {
        background-color: #000;
        color: #fff;
        padding: 0.5rem;
        margin-right: 0.5rem;
        margin-bottom: 0.5rem;
        display: inline-block;
        border: #000 1px solid;
        border-radius: 4px;
    }
</style>

<main class="content">
    <section class="event-content">

        <?php if ($title = $page->title()->html()) : ?>
            <h1><?= $title ?></h1>
        <?php endif; ?>
        <?php if ($subtitle = $page->subtitle()->kirbytext()) : ?>
            <h2><?= $subtitle ?></h2>
        <?php endif; ?>

        <?php if ($location = $page->location()->html()) : ?>
            <p class="location"><?= $location ?></p>
        <?php endif; ?>

        <h3>Artists:</h3>
        <ul class="artists">
            <?php
            $artists =  $page->artist_link()->toPages();
            foreach ($artists as $artist) : ?>
                <li>
                    <a href="<?= $artist->url() ?>"><?= $artist->title() ?></a>
                </li>
            <?php endforeach ?>
        </ul>

        <?php if ($description = kt($page->description())) : ?>
            <h3>Details:</h3>
            <div class="event-details"><?= $description ?></div>
        <?php endif; ?>

        <h3>Venue:</h3>
        <p>
            Data served from the `venue` pages.</p>
        <ul class="venue">
            <?php
            $venues =  $page->venues()->toPages();
            foreach ($venues as $venue) : ?>
                <li>
                    <a href="<?= $venue->url() ?>"><?= $venue->title() ?></a>

                    <p>Location: <?= $venue->location()->html() ?></p>
                    <!-- Display custom accessibility details -->
                    <?php if ($venue->accessibility_text()->isNotEmpty()) : ?>
                        <p>Accessibility: <?= $venue->accessibility_text()->kirbytextinline() ?></p>
                    <?php endif; ?>
                    <!-- Display land acknowledgement, if available -->
                    <?php if ($venue->land()->isNotEmpty()) : ?>
                        <p>Land Acknowledgement: <?= $venue->land()->html() ?></p>
                    <?php endif; ?>


                    <?php if ($venue->accessibility()->isNotEmpty()) : ?>
                        <p>Accessibility Features: <?= $venue->accessibility()->html() ?></p>
                    <?php endif; ?>


                    <!-- Display land acknowledgement -->
                    <?php if ($venue->land()->isNotEmpty()) : ?>
                        <p>Land Acknowledgement: <?= $venue->land()->html() ?></p>
                    <?php endif; ?>

                    <!-- Display location features as tags -->
                    <?php if ($venue->location_features()->isNotEmpty()) : ?>
                        <p>Location Features: <?= $venue->location_features()->html() ?></p>
                    <?php endif; ?>

                    <!-- Display map -->
                    <?php if ($venue->map()->isNotEmpty()) : ?>
                        <div>Map: <?= $venue->map()->kirbytext() ?></div>
                    <?php endif; ?>


                    <!-- Display website -->
                    <?php if ($venue->website()->isNotEmpty()) : ?>
                        <p>Website: <a href="<?= $venue->website()->value() ?>" target="_blank"><?= $venue->website()->value() ?></a></p>
                    <?php endif; ?>



                </li>
            <?php endforeach ?>
        </ul>

        <?php if ($page->ticketed()->toBool()) : ?>
            <div class="ticket-info">
                <?php if ($ticket_link = $page->ticket_link()->url()) : ?>
                    <a href="<?= $ticket_link ?>" class="ticket-link">Tickets</a>
                <?php endif; ?>
                <?php if ($ticket_price = $page->ticket_price()->value()) : ?>
                    <p class="ticket-price">$<?= $ticket_price ?></p>
                <?php endif; ?>
                <?php if ($ticket_price_text = $page->ticket_price_text()->html()) : ?>
                    <p class="ticket-price-text"><?= $ticket_price_text ?></p>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <h3>Event Dates:</h3>
        <div class="event-dates">
            <?php if ($start_date = $page->start_date()->toDate('d/m/Y')) : ?>
                <p class="date">Start: <?= $start_date ?>
                    <?php if ($start_time = $page->start_time()->toDate('H:iA')) : ?>
                        <span class="time">at <?= $start_time ?></span>
                    <?php endif; ?>
                </p>
            <?php endif; ?>
            <?php if ($end_date = $page->end_date()->toDate('d/m/Y')) : ?>
                <p class="date">End: <?= $end_date ?>
                    <?php if ($end_time = $page->end_time()->toDate('H:iA')) : ?>
                        <span class="time">at <?= $end_time ?></span>
                    <?php endif; ?>
                </p>
            <?php endif; ?>
        </div>


        <?php if ($tags = $page->tags()->split(',')) : ?>
            <h3>Tags:</h3>
            <div class="tags">
                <?php foreach ($tags as $tag) : ?>
                    <span class="tag"><?= $tag ?></span>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>


        <?php if ($accessibility = kt($page->accessibility())) : ?>
            <h3>Event Specific Accessibility:</h3>
            <div class="accessibility-info"><?= $accessibility ?></div>
        <?php endif; ?>

        <?php $links = $page->links()->toStructure();
        if ($links->isNotEmpty()) : ?>
            <h3>Links:</h3>
            <ul class="event-links">
                <?php foreach ($links as $link) : ?>
                    <li>
                        <a href="<?= $link->url() ?>" <?= $link->popup()->toBool() ? 'target="_blank"' : '' ?>>
                            <?= $link->text()->html() ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </section>

</main>
<?php snippet('footer') ?>