<style>
    .gallery-container {
        position: relative;
        width: 100%;
        padding: 0 !important;
    }

    .gallery-images figure {
        display: none;
        text-align: center;
    }

    .gallery-images figure.active {
        display: block;
    }

    button.gallery-prev,
    button.gallery-next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
    }

    button.gallery-prev {
        left: 10px;
    }

    button.gallery-next {
        right: 10px;
    }
</style>

<?php if ($images->isNotEmpty()) : ?>
    <div class="gallery-container">
        <div class="gallery-images">
            <?php foreach ($images as $index => $image) : ?>
                <figure class="<?= $index === 0 ? 'active' : '' ?>">
                    <img src="<?= $image->resize(800)->url() ?>" alt="<?= $image->alt()->or($page->title() . ' image') ?>" loading="lazy">
                    <figcaption><?= $image->caption()->or('') ?></figcaption>
                </figure>
            <?php endforeach; ?>
        </div>
        <?php
        $count = $images->count();
        if ($count > 1) : ?>
            <button class="gallery-prev">←</button>
            <button class="gallery-next">→</button>
            <div class="gallery-count">
                <span class="current">1</span><span class="total"> / <?= $count ?></span>
            </div>
        <?php endif; ?>

    </div>
<?php endif; ?>