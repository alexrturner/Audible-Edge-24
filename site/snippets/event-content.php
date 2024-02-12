<!-- title, subtitle, date time, venue, location -->
<section class="section" id="col1">
    <ul class="events" id="events-items">
        <li class="events-item" data-type="events" data-id="<?= $page->id() ?>">
            <h2 class="title"><?= $page->title()->html() ?></h2>
        </li>
    </ul>

    <div class="subtitle">
        <?php if ($subtitle = $page->subtitle()->kirbytext()) : ?>
            <span><?= $subtitle ?></span>
        <?php endif; ?>
    </div>

    <?php if ($location = $page->location()->html()) : ?>
        <p class="location"><?= $location ?></p>
    <?php endif; ?>

    <div class="venue">
        <?php
        $venue =  $page->venues()->toPages();
        $venue = $venue->first();
        ?>

        <?php // check page has a venue 
        if ($venue) : ?>
            <?php if ($venue->website()->isNotEmpty()) : ?>
                <a href="<?= $venue->website()->value() ?>" target="_blank">
                    <?= $venue->title() ?>
                </a>
            <?php else : ?>
                <p>
                    <?= $venue->title() ?>
                </p>
            <?php endif; ?>


            <p>
                <?= $venue->location()->html() ?>
            </p>

            <!-- land acknowledgement -->
            <?php if ($venue->land()->isNotEmpty()) : ?>
                <p>
                    <?= $venue->land()->html() ?>
                </p>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</section>

<!-- artists, image -->
<section class="section" id="col2">

    <ul class="artists" id="artists-items">
        <?php
        $artists =  $page->artist_link()->toPages();
        foreach ($artists as $artist) : ?>
            <li class="artists-item" data-type="artists" data-id="<?= $artist->id() ?>">
                <a href="<?= $artist->url() ?>">
                    <?= $artist->title() ?>
                </a>
            </li>

        <?php endforeach ?>
    </ul>


    <?php if ($page->images()->isNotEmpty()) : ?>
        <div class="event-images">
            <?php foreach ($page->images() as $image) : ?>
                <figure>
                    <img src="<?= $image->url() ?>" alt="<?= $image->alt()->or('Event image') ?>" loading="lazy">
                    <figcaption><?= $image->caption()->or('') ?></figcaption>
                </figure>
            <?php endforeach ?>
        </div>
    <?php endif ?>

</section>

<!-- description, accessibility -->
<section class="section" id="col3">
    <?php if ($description = kt($page->description())) : ?>
        <div class="event-details">
            <?= $description ?>
        </div>
    <?php endif; ?>


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




    <?php if ($tags = $page->tags()->split(',')) : ?>
        <h3>Tags:</h3>
        <div class="tags">
            <?php foreach ($tags as $tag) : ?>
                <span class="tag"><?= $tag ?></span>
            <?php endforeach; ?>
        </div>
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


    <!-- custom accessibility details -->
    <?php if ($venue && $venue->accessibility_text()->isNotEmpty()) : ?>
        <?= $venue->accessibility_text()->kt() ?>
    <?php endif; ?>

    <?php if ($venue && $venue->accessibility()->isNotEmpty()) : ?>
        <p>Accessibility Features:</p>
        <div class="accessibility-features"><?= $venue->accessibility()->html() ?></div>
    <?php endif; ?>

    <?php if ($accessibility = kt($page->accessibility())) : ?>
        <h3>Event Specific Accessibility:</h3>
        <div class="accessibility-info"><?= $accessibility ?></div>
    <?php endif; ?>

    <?php if ($venue && $venue->location_features()->isNotEmpty()) : ?>
        <p>Location Features: <?= $venue->location_features()->html() ?></p>
    <?php endif; ?>

    <!-- map -->
    <?php if ($venue && $venue->map()->isNotEmpty()) : ?>
        <!-- <a>
                            <div class="map map-open" onclick="toggleMap()">
                                <img src="img/map-transparent.png">
                            </div>
                        </a> -->

    <?php endif; ?>

</section>

<section class="section" id="col4">
    <?php // snippet('menu') 
    ?>
</section>