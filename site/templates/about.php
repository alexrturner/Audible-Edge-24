<?php snippet('header') ?>

<main class="content">
    <div class="text-container">
        <section class="text">
            <h1><?= $page->title()->html() ?></h1>
        </section>
        <section class="text">
            <div class="contact">
                <?= kt($page->Description()) ?>
                <span class="contact-details"></span>
            </div>
        </section>



        <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function() {
                var email = "<?= $site->email()->esc() ?>";
                var mailLink = "<a href='mailto:" + email + "'>" + email + "</a>";

                var mailBox = document.querySelector('.contact-details');
                if (mailBox) {
                    mailBox.innerHTML = mailLink;
                }
            });
        </script>
</main>

<?php snippet('footer') ?>