<?php snippet('header') ?>

<style>
    .honeypot {
        position: absolute;
        left: -9999px;
    }
</style>

<main class="main">

    <section class="description">
        <?= kt($page->description()) ?>
    </section>

    <section class="form">
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
                <div class="field">
                    <label for="name">
                        Name <abbr title="required">*</abbr>
                    </label>
                    <input type="text" id="name" name="name" value="<?= esc($data['name'] ?? '', 'attr') ?>" required>
                    <?= isset($alert['name']) ? '<span class="alert error">' . esc($alert['name']) . '</span>' : '' ?>
                </div>
                <div class="field">
                    <label for="pronouns">
                        Pronouns
                    </label>
                    <input type="text" id="pronouns" name="pronouns" value="<?= esc($data['pronouns'] ?? '', 'attr') ?>" required>
                    <?= isset($alert['pronouns']) ? '<span class="alert error">' . esc($alert['pronouns']) . '</span>' : '' ?>
                </div>
                <div class="field">
                    <label for="email">
                        Email <abbr title="required">*</abbr>
                    </label>
                    <input type="email" id="email" name="email" value="<?= esc($data['email'] ?? '', 'attr') ?>" required>
                    <?= isset($alert['email']) ? '<span class="alert error">' . esc($alert['email']) . '</span>' : '' ?>
                </div>
                <div class="field">
                    <label for="text">
                        Text <abbr title="required">*</abbr>
                    </label>
                    <textarea id="text" name="text" required>
                    <?= esc($data['text'] ?? '') ?>
                </textarea>
                    <?= isset($alert['text']) ? '<span class="alert error">' . esc($alert['text']) . '</span>' : '' ?>
                </div>
                <input type="submit" name="submit" value="Submit">
            </form>
        <?php endif ?>
    </section>
</main>


<?php snippet('footer') ?>