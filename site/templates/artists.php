<?php snippet('header') ?>

<main class="main" role="main">

    <div class="text">
        <h1><?= $page->title()->html() ?></h1>
        <?= kt($page->text()) ?>
    </div>

    <section class="artists">
        <?php foreach ($page->children()->listed() as $artist) : ?>
            <div class="artist">
                <h2><a href="<?= $artist->url() ?>"><?= $artist->title()->html() ?></a></h2>
                <p><?= $artist->bio_short()->excerpt(50) ?></p>

                <details>
                    <summary>
                        Read More
                        <?php if ($artist->hasImages()) :
                            $firstImage = $artist->images()->first()->resize(50);
                        ?>
                            <figure>
                                <img src="<?= $firstImage->url() ?>" alt="<?= $firstImage->alt()->or($artist->title()->html()) ?>">
                            </figure>
                        <?php endif ?>
                    </summary>
                    <p><?= $artist->bio_long()->kt() ?></p>
                    <section>
                        <?php if ($artist->hasImages()) : ?>
                            <div class="artist-images">
                                <?php foreach ($artist->images() as $image) : ?>
                                    <img src="<?= $image->resize(50)->url() ?>" alt="<?= $image->alt()->or($artist->title()->html()) ?>">
                                <?php endforeach ?>
                            </div>
                        <?php endif ?>

                        <?php if ($artist->links()->isNotEmpty()) : ?>
                            <div class="artist-links">
                                <h2>Links</h2>
                                <ul>
                                    <?php foreach ($artist->links()->toStructure() as $link) : ?>
                                        <li>

                                            <?php if ($link->type() == 'audio') : ?>
                                                <span>&#x1F508;</span>
                                            <?php elseif ($link->type() == 'video') : ?>
                                                &#x1F4FD;
                                            <?php elseif ($link->type() == 'image') : ?>
                                                &#x1F5BC;
                                            <?php elseif ($link->type() == 'pdf') : ?>
                                                &#x1F4C4;
                                            <?php else : ?>
                                                &#x1F517;
                                            <?php endif ?>

                                            <a href="<?= $link->url() ?>" <?php e($link->popup(), 'target="_blank"') ?>>
                                                <?= $link->text() ?>
                                            </a>

                                        </li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        <?php endif ?>

                        <?php if ($artist->events()->isNotEmpty()) : ?>
                            <div class="artist-events">
                                <h2>Associated Events</h2>
                                <ul>
                                    <?php
                                    $events =  $artist->events()->toPages();
                                    foreach ($events as $event) : ?>
                                        <li><a href="<?= $event->url() ?>"><?= $event->title() ?></a></li>
                                    <?php endforeach ?>
                                </ul>
                            </div>


                        <?php endif ?>

                        <?php if ($artist->credits()->isNotEmpty()) : ?>
                            <div class="artist-credits">
                                <h2>Credits</h2>
                                <ul>
                                    <?php foreach ($artist->credits()->toStructure() as $credit) : ?>
                                        <li>
                                            <?= $credit->other_name() ?> <?= $credit->sort_name() ?>
                                            <?php if ($credit->group()->isNotEmpty()) : ?>
                                                (<?= $credit->group()->implode(', ') ?>)
                                            <?php endif ?>
                                        </li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        <?php endif ?>
                    </section>
                </details>
            </div>
        <?php endforeach ?>
    </section>

</main>

<?php snippet('footer') ?>