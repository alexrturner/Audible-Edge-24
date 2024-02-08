<?php
// arguments: parent page slug, optional class name
$parentPageSlug = $parentPageSlug ?? null;
$className = $className ?? 'listing';

if ($parentPageSlug && ($parentPage = page($parentPageSlug)) && $parentPage->hasChildren()) : ?>
    <ul class="items" id="<?= $className ?>-items">
        <?php foreach ($parentPage->children()->listed() as $child) : ?>
            <li class="<?= $className ?>-item" data-type="<?= $className ?>" data-id="<?= $child->id() ?>">
                <a href="<?= $child->url() ?>" class="<?= $className ?>-link">
                    <?= $child->title()->esc() ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>