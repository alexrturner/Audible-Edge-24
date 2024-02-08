<?php snippet('header') ?>
<div class="cards">
    <a href="<?= $event->url() ?>" class="card">
        <figure class="bg">
            <div role="img" aria-label="" class="img" style="background-position: 50% 50%; background-image: url(<?= $img->resize(400) ?>);" data-src="<?= $img->thumb($options = null) ?>" lazy="loaded">
                <div class="size" style="padding-top: 66.6667%;"></div>
            </div>
        </figure>

        <div class="pill">
            <span>
                <?=
                // 23 January 2024
                $page->date()->toDate('d M Y') ?>
            </span>
        </div>
        <h2 class="h2">
            <?= $page->title() ?>
        </h2>
    </a>
</div>

<?php snippet('footer') ?>