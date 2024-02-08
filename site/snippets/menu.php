<?php
// arguments: expanded (true/false)
$expanded = $expanded ?? "true";
?>

<nav class="section menu" id="menu" aria-label="Main Navigation">
    <ul class="menu-container">
        <li class="menu-item first-item <?php e($expanded === "true", "", "list-style-circle"); ?>">
            <button class="menu-toggle toggle" aria-expanded="<?= $expanded ?>" aria-controls="menu-items" aria-label="Toggle Menu">Menu <span class="icon-bar"></span></button>
            <br><br>
            <ul class="items <?php e($expanded === "true", "", "hidden flex"); ?> " id="menu-items">
                <?php foreach ($site->children()->listed() as $p) : ?>
                    <li class="menu-item">
                        <a <?php e($p->isOpen(), 'aria-current="page"') ?> href="<?= $p->url() ?>" class="menu-link<?php e($p->isOpen(), ' active') ?>">
                            <?= $p->title()->esc() ?>
                        </a>
                    </li>
                <?php endforeach ?>
            </ul>
        </li>
    </ul>
</nav>