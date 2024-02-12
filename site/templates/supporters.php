<?php snippet('header') ?>

<main class="content-container">

    <section class="description">
        <div>
            <?= kt($page->description()) ?>
        </div>
    </section>

    <section class="logos">
        <?php
        // Funding Support
        $fundingLogos = $page->fundingSupport()->toFiles();
        if ($fundingLogos->isNotEmpty()) : ?>
            <h2>Funding Support</h2>
            <?php foreach ($fundingLogos as $logo) : ?>
                <?php snippet('supporter-logo', ['logo' => $logo]) ?>
            <?php endforeach; ?>
        <?php endif ?>

        <?php
        // Commissioning Partners
        $commissioningLogos = $page->commissioningPartners()->toFiles();
        if ($commissioningLogos->isNotEmpty()) : ?>
            <h2>Commissioning Partners</h2>
            <?php foreach ($commissioningLogos as $logo) : ?>
                <?php snippet('supporter-logo', ['logo' => $logo]) ?>
            <?php endforeach; ?>
        <?php endif ?>

        <?php
        // Presenting Partners
        $presentingLogos = $page->presentingPartners()->toFiles();
        if ($presentingLogos->isNotEmpty()) : ?>
            <h2>Presenting Partners</h2>
            <?php foreach ($presentingLogos as $logo) : ?>
                <?php snippet('supporter-logo', ['logo' => $logo]) ?>
            <?php endforeach; ?>
        <?php endif ?>
    </section>
    </div>
</main>

<?php snippet('footer') ?>