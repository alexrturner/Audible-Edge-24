<?php snippet('header') ?>
<main class="content">
    <div class="text-container">
        <section class="text">
            <h2>Acknowledgement</h2>
            <?= $page->acknowledgement() ?>
        </section>

        <section class="text">
            <h2>Biography</h2>
            <?= $page->description() ?>
        </section>

    </div>
</main>
<?php snippet('footer') ?>