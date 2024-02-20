<style>
    :root {
        --gallery-height: 33vh;
    }

    .gallery-container {
        position: relative;
        /* width: 100%;
        padding: 0 !important; */
    }

    .gallery-images figure {
        display: none;
        text-align: center;
        height: var(--gallery-height);
        justify-content: center;
        align-items: center;
    }

    .gallery-images figure.active {
        display: block;
    }

    button.gallery-prev,
    button.gallery-next {
        position: absolute;
        top: 50%;
        transform: translateY(calc(-50% - 1em));
    }

    button.gallery-prev {
        left: 0.5rem;
        height: 2rem;
    }

    button.gallery-next {
        right: 0.5rem;
        height: 2rem;
    }

    .gallery-images figure img {
        max-height: var(--gallery-height);
        height: auto;
    }


    /* //todo revise 
        */
    button.gallery-prev,
    button.gallery-next {
        top: 0%;
        transform: translateY(calc(50% + 0.5em));

    }

    .gallery-images figure {
        align-items: start;
    }

    .gallery-count {
        text-align: center;
    }
</style>

<?php if ($images->isNotEmpty()) : ?>
    <div class="gallery-container">
        <?php
        $count = $images->count();
        if ($count > 1) : ?>
            <button class="gallery-prev">←</button>
            <button class="gallery-next">→</button>
            <div class="gallery-count">
                <span class="current">1</span><span class="total"> / <?= $count ?></span>
            </div>
        <?php endif; ?>
        <div class="gallery-images">
            <?php foreach ($images as $index => $image) : ?>
                <figure class="<?= $index === 0 ? 'active' : '' ?>">
                    <img src="<?= $image->resize(500)->url() ?>" alt="<?= $image->alt()->or($page->title() . ' image') ?>" loading="lazy">
                    <figcaption><?= $image->caption()->or('') ?></figcaption>
                </figure>
            <?php endforeach; ?>
        </div>


    </div>
<?php endif; ?>