<?php snippet('header') ?>

<style>
    main {
        margin-top: 100px;
    }
</style>

<?php $today = strtotime(date('Y-m-d')); ?>
<main>
    <section class="table">
        <table id="table-of-everything" class="tablesorter">
            <thead>
                <tr>
                    <th class="th-1">Land</th>
                    <th class="th-2">Event Name</th>
                    <th class="th-3">Venue</th>
                    <th class="th-4">Date</th>
                    <th class="th-5">Project</th>
                    <th class="th-6 filter-false" data-sorter=" false">Link</th>
                </tr>
            </thead>
            <tbody class="current">
                <?php
                foreach ($page->children()->listed() as $event) :
                    $startDate = strtotime($event->start_date());

                    if ($startDate >= $today) : ?>
                        <tr class="event all-filter">
                            <!-- Event details -->
                        </tr>
                <?php endif;
                endforeach; ?>
            </tbody>
            <tbody class="archive">
                <?php foreach ($page->children()->listed() as $event) : ?>
                    <tr class="event all-filter">
                        <td class="event-location">
                            <?php if ($event->location()->isNotEmpty()) : ?>
                                <?= kt($event->location()) ?>
                            <?php endif ?>
                        </td>
                        <td class="event-name">
                            <?php if ($event->title()->isNotEmpty()) : ?>
                                <?= kt($event->title()) ?>
                            <?php endif ?>
                        </td>
                        <td class="event-venue">
                            <?php if ($event->venue()->isNotEmpty()) : ?>
                                <?= kt($event->venue()) ?>
                            <?php endif ?>
                        </td>
                        <td class="event-date">
                            <?php if ($event->start_date()->isNotEmpty()) : ?>
                                <?= $event->start_date()->toDate('d/m/y') ?>
                                <?php if ($event->end_date()->isNotEmpty()) : ?>
                                    – <?= $event->end_date()->toDate('d/m/y') ?>
                                <?php endif ?>
                            <?php endif ?>
                        </td>
                        <td class="event-project">

                            <?php if ($event->project_link()->isNotEmpty()) :
                                $projectUrl = $event->project_link()->toPage();
                                $projectPage = page($projectUrl);

                                if ($projectPage) :
                                    $projectTitle = $projectPage->title()->html();
                            ?>
                                    <a href="<?= $projectUrl ?>" target="_blank" rel="noopener noreferrer"><?= $projectTitle ?></a>
                                <?php endif; ?>

                            <?php elseif ($event->project_text()->isNotEmpty()) : ?>
                                <?= $event->project_text()->html() ?>
                            <?php endif; ?>
                        </td>
                        <td class="event-link">
                            <?php if ($event->link()->isNotEmpty()) : ?>
                                <a href="<?= $event->link()->toUrl() ?>" target="_blank" rel="noopener noreferrer">
                                    <?= $event->link_text()->isNotEmpty() ? $event->link_text()->html() : 'Link' ?>
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </section>
</main>
<a href=" <?= $page->link()->toUrl() ?>"><?= $page->link() ?></a>

<?php snippet('footer') ?>