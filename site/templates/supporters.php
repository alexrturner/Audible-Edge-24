<?php snippet('header') ?>

<main>
    <section class="text">
        <div>
            <?= kt($page->description()) ?>
        </div>
    </section>

    <section class="logos">

        <h2>Funding Support</h2>
        <?php foreach ($page->fundingSupport()->toFiles() as $logo) : ?>
            <img src="<?= $logo->resize(200)->url() ?>" alt="Funding Support Logo">
        <?php endforeach; ?>

        <h2>Commissioning Partners</h2>
        <?php foreach ($page->commissioningPartners()->toFiles() as $logo) : ?>
            <img src="<?= $logo->resize(200)->url() ?>" alt="Commissioning Partner Logo">
        <?php endforeach; ?>

        <h2>Presenting Partners</h2>
        <?php foreach ($page->presentingPartners()->toFiles() as $logo) : ?>
            <img src="<?= $logo->resize(200)->url() ?>" alt="Presenting Partner Logo">
        <?php endforeach; ?>
    </section>
</main>

<?php snippet('footer') ?>