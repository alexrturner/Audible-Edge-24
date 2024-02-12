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
            <a href="<?= $logo->link()->isNotEmpty() ? $logo->link() : '#' ?>" class="logo-link" target="_blank">
                <img src="<?= $logo->resize(200)->url() ?>" alt="<?= $logo->alt()->escape() ?>">
                <p><?= $logo->caption()->kt() ?></p>
            </a>
        <?php endforeach; ?>

        <h2>Commissioning Partners</h2>
        <?php foreach ($page->commissioningPartners()->toFiles() as $logo) : ?>
            <a href="<?= $logo->link()->isNotEmpty() ? $logo->link() : '#' ?>" class="logo-link" target="_blank">
                <img src="<?= $logo->resize(200)->url() ?>" alt="<?= $logo->alt()->escape() ?>">
                <p><?= $logo->caption()->kt() ?></p>
            </a>
        <?php endforeach; ?>

        <h2>Presenting Partners</h2>
        <?php foreach ($page->presentingPartners()->toFiles() as $logo) : ?>
            <a href="<?= $logo->link()->isNotEmpty() ? $logo->link() : '#' ?>" class="logo-link" target="_blank">
                <img src="<?= $logo->resize(200)->url() ?>" alt="<?= $logo->alt()->escape() ?>">
                <p><?= $logo->caption()->kt() ?></p>
            </a>
        <?php endforeach; ?>
    </section>
    </div>
</main>

<?php snippet('footer') ?>