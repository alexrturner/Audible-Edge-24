<?php snippet('header') ?>

<main class="content-container">

    <section class="description">
        <div>
            <?= kt($page->description()) ?>
        </div>
    </section>

    <section class="logos">
        <h2>Funding Support</h2>
        <?php foreach ($page->fundingSupport()->toFiles() as $logo) : ?>
            <?php snippet('supporter-logo', ['logo' => $logo]) ?>
        <?php endforeach; ?>

        <h2>Commissioning Partners</h2>
        <?php foreach ($page->commissioningPartners()->toFiles() as $logo) : ?>
            <?php snippet('supporter-logo', ['logo' => $logo]) ?>
        <?php endforeach; ?>

        <h2>Presenting Partners</h2>
        <?php foreach ($page->presentingPartners()->toFiles() as $logo) : ?>
            <?php snippet('supporter-logo', ['logo' => $logo]) ?>
        <?php endforeach; ?>
    </section>
    </div>
</main>

<?php snippet('footer') ?>