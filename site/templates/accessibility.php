<?php snippet('header') ?>

<style>
    .honeypot {
        position: absolute;
        left: -9999px;
    }
</style>

<main class="main">

    <section class="intro">
        <?= kt($page->intro()) ?>
    </section>
    <section class="description">
        <?= kt($page->description()) ?>
    </section>

    <section class="form">
        <?= kt($page->form()) ?>
        <?php if ($success) : ?>
            <div class="alert success">
                <p><?= $success ?></p>
            </div>
        <?php else : ?>
            <?php if (isset($alert['error'])) : ?>
                <div><?= $alert['error'] ?></div>
            <?php endif ?>
            <form method="post" action="<?= $page->url() ?>">
                <div class="honeypot">
                    <label for="website">Website <abbr title="required">*</abbr></label>
                    <input type="url" id="website" name="website" tabindex="-1">
                </div>
                <div class="field half">
                    <input type="text" id="name" name="name" value="<?= esc($data['name'] ?? '', 'attr') ?>" placeholder="Name" required>
                    <?= isset($alert['name']) ? '<span class="alert error">' . esc($alert['name']) . '</span>' : '' ?>
                </div>
                <div class="field half">
                    <input type="text" id="pronouns" name="pronouns" value="<?= esc($data['pronouns'] ?? '', 'attr') ?>" placeholder="Pronouns" required>
                    <?= isset($alert['pronouns']) ? '<span class="alert error">' . esc($alert['pronouns']) . '</span>' : '' ?>
                </div>
                <div class="field">
                    <input type="email" id="email" name="email" value="<?= esc($data['email'] ?? '', 'attr') ?>" placeholder="eMail" required>
                    <?= isset($alert['email']) ? '<span class="alert error">' . esc($alert['email']) . '</span>' : '' ?>
                </div>
                <div class="field">
                    <textarea id="text" name="text" placeholder="Message" required>
                    <?= esc($data['text'] ?? '') ?>
                </textarea>
                    <?= isset($alert['text']) ? '<span class="alert error">' . esc($alert['text']) . '</span>' : '' ?>
                </div>
                <input type="submit" name="submit" value="Get in Touch">
            </form>
        <?php endif ?>
    </section>
</main>


<?php snippet('footer') ?>