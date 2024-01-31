<?php snippet('header') ?>

<section class="events">


    <?php if ($events = page('program')) : ?>
        <ul id="table-of-events" class="tablesorter">

            <?php foreach ($events->children()->listed() as $event) : ?>

                <li class="event">
                    <a href="<?= $event->url() ?>">
                        <?php if ($event->title()->isNotEmpty()) : ?>
                            <span><?= $event->title()->esc() ?></span>
                        <?php endif ?>


                    </a>
                </li>

            <?php endforeach ?>
        </ul>
    <?php endif ?>

</section>

<?php snippet('footer') ?>