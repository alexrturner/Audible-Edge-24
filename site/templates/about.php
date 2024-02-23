<?php snippet('header') ?>

<main class="main">
    <div class="content-container ">
        <section id="col3" class="description">

            <?= kt($page->Description()) ?>

        </section>

        <section id="col2" class="contact">

            <div class="signup">
                <!-- Sign up for our -->
                <a href="<?= $page->link_email()->url() ?>" class="button__link" aria-label="Visit Email Newsletter sign up" aria-type="link">Email Newsletter</a>
            </div>
            <div class="signup">
                <a href="<?= $page->link_sms()->url() ?>" class="button__link" aria-label="Visit SMS Newsletter sign up" aria-type="link">SMS Newsletter</a>
            </div>
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