<?php snippet('header') ?>

<h1><?= $page->title()->html() ?></h1>

<div>
    <?= kt($page->description()) ?>
</div>

<h2>Funding Support</h2>
<?php foreach ($page->fundingSupport()->toFiles() as $logo) : ?>
    <img src="<?= $logo->url() ?>" alt="Funding Support Logo">
<?php endforeach; ?>

<h2>Commissioning Partners</h2>
<?php foreach ($page->commissioningPartners()->toFiles() as $logo) : ?>
    <img src="<?= $logo->url() ?>" alt="Commissioning Partner Logo">
<?php endforeach; ?>

<h2>Presenting Partners</h2>
<?php foreach ($page->presentingPartners()->toFiles() as $logo) : ?>
    <img src="<?= $logo->url() ?>" alt="Presenting Partner Logo">
<?php endforeach; ?>

<?php snippet('footer') ?>