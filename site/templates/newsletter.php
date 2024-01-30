<?php snippet('header') ?>

<h1><?= $page->title()->html() ?></h1>

<a href="<?= $page->emailSignupLink()->url() ?>">Sign up for our Email Newsletter</a>
<br>
<a href="<?= $page->smsSignupLink()->url() ?>">Sign up for our SMS Newsletter</a>

<?php snippet('footer') ?>