<?php
$logo = $logo;
?>
<a href="<?= $logo->link()->isNotEmpty() ? $logo->link() : '#' ?>" class="logo-link" target="_blank">
    <div class="logo-container">
        <div class="logo-image">
            <img src="<?= $logo->resize(600)->url() ?>" alt="<?= $logo->alt()->escape() ?>">
        </div>
        <div class="logo-caption">
            <span><?= $logo->caption()->kt() ?></span>
        </div>
    </div>
</a>