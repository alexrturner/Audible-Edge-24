<?php snippet('header') ?>

<main class="main">
    <div class="content-container">
        <section class="description">

            <?= kt($page->Description()) ?>

        </section>

        <section class="contact">

            <span class="contact-details"></span>
        </section>
    </div>
</main>

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

<?php snippet('footer') ?>