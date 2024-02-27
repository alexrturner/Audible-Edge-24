<?php snippet('header') ?>

<main class="main content-container index">

    <section id="col1" class="intro" style="max-width: 60ch;">
        <?= kt($page->intro()) ?>
    </section>

    <section id="col2" class="description" style="max-width: 60ch;">
        <?= kt($page->description()) ?>
    </section>

    <section id="col3" class="form" style="max-width: 60ch;">

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
                <div class="honeypot" style="position: absolute; left: -9999px;">
                    <label for="website">Website <abbr title="required">*</abbr></label>
                    <input type="url" id="website" name="website" tabindex="-1">
                </div>
                <div class="field-group">
                    <div class="field half">
                        <input type="text" id="name" name="name" value="<?= esc($data['name'] ?? '', 'attr') ?>" placeholder="Name">
                        <?= isset($alert['name']) ? '<span class="alert error">' . esc($alert['name']) . '</span>' : '' ?>
                    </div>
                    <div class="field half">
                        <input type="text" id="pronouns" name="pronouns" value="<?= esc($data['pronouns'] ?? '', 'attr') ?>" placeholder="Pronouns">
                        <?= isset($alert['pronouns']) ? '<span class="alert error">' . esc($alert['pronouns']) . '</span>' : '' ?>
                    </div>
                </div>
                <div class="field-group">
                    <div class="field half">
                        <input type="email" id="email" name="email" value="<?= esc($data['email'] ?? '', 'attr') ?>" placeholder="eMail">
                        <?= isset($alert['email']) ? '<span class="alert error">' . esc($alert['email']) . '</span>' : '' ?>
                    </div>
                    <div class="field half">
                        <input type="tel" id="phone" name="phone" value="<?= esc($data['phone'] ?? '', 'attr') ?>" placeholder="Phone">
                        <?= isset($alert['phone']) ? '<span class="alert error">' . esc($alert['phone']) . '</span>' : '' ?>
                    </div>
                </div>
                <div class="field">
                    <textarea id="text" name="text" placeholder="Request" required><?= esc($data['text'] ?? '') ?></textarea>

                    <?= isset($alert['text']) ? '<span class="alert error">' . esc($alert['text']) . '</span>' : '' ?>
                </div>
                <div>
                    <button class="button__link button__submit" type="submit">Get in Touch</button>
                    <!-- <input type="submit" name="submit" value="Get in Touch"> -->
                </div>
            </form>
        <?php endif ?>
    </section>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = ($_POST["name"]);
        $pronouns = ($_POST["pronouns"]);
        $phone = ($_POST["phone"]);
        $email = ($_POST["email"]);
        $submitted_at = date('Y-m-d H:i:s');

        // Database connection parameters
        $host = 'localhost';
        $username = '***REMOVED***_ae24';
        $password = 'kk6aGGh7GrRdmCU';
        $database = '***REMOVED***_audible_edge_2024';
        $usertable = "users";

        $conn = mysqli_connect($host, $username, $password, $database);

        // Check connection
        if ($conn === false) {
            die("Error: could not connect. " . mysqli_connect_error());
        }

        $sql = "INSERT INTO $usertable (name, pronouns, email, phone, text, submitted_at) VALUES ('$name', '$pronouns', '$email', '$phone', '$text', '$submitted_at');";

        if (mysqli_query($conn, $sql)) {
            echo '<div class="form-container"><p class="form-text">Records successfully added!</p><p class="form-text">Welcome to the Audible Edge text line.</p></div>';
        } else {
            echo '<div class="form-container"><p class="form-text">ERROR: Unable to execute $sql.</p></div>' . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
    ?>
</main>


<?php snippet('footer') ?>