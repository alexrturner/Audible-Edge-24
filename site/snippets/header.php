<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">


  <?php if ($page->isHomePage()) : ?>
    <title><?= $site->title()->esc() ?></title>
  <?php else : ?>
    <title><?= $site->title()->esc() ?> | <?= $page->title()->esc() ?></title>
  <?php endif ?>


  <?= css([
    'assets/css/normalize.v8.0.1.css',
    'assets/css/index.css',
    '@auto',
  ]) ?>

  <?= js([
    'assets/js/script.js'
  ]) ?>

  <style>
    :root {
      --cc-1: <?= $site->color()->or('blue') ?>;
    }
  </style>

  <link rel="shortcut icon" type="image/x-icon" href="<?= url('favicon.ico') ?>">


  <script src="https://d3js.org/d3.v7.js"></script>


  <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="description" content="<?= $site->metaDescription() ?> ">
  <meta name="keywords" content="<?= $site->metaKeywords() ?>">
  <meta name="author" content="Tone List">


  <?php if (!$page->isHomePage()) : ?>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        // non-home pages - toggle overlay on menu click 
        const toggleButton = document.querySelector('.menu-toggle');
        const overlay = document.querySelector('.overlay');

        toggleButton.addEventListener('click', function() {
          const isOpen = overlay.style.visibility === 'visible';
          overlay.style.opacity = isOpen ? '0' : '1';
          overlay.style.visibility = isOpen ? 'hidden' : 'visible';
        });
      });
    </script>
  <?php else : ?>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        // countdown till program launch (home page)
        const countdown = document.getElementById('countdown');
        const targetDate = new Date('March 13, 2024 00:00:00').getTime();

        const updateCountdown = function() {
          const now = new Date().getTime();
          // convert timezone offset to milliseconds, then adjust for UTC+8
          const timezoneOffset = new Date().getTimezoneOffset() * 60000;
          const UTC8time = now + timezoneOffset + (8 * 3600000);
          const distance = targetDate - UTC8time;

          // calculate days remaining & display
          const days = Math.floor(distance / (1000 * 60 * 60 * 24));
          countdown.innerHTML = days + ' days until Program Launch';

          // if the countdown is over, display message
          if (distance < 0) {
            clearInterval(interval);
            countdown.innerHTML = 'Program has launched!';
          }
        };

        // run once on load, then update countdown every day
        updateCountdown();
        const interval = setInterval(updateCountdown, 86400000); // 24hrs
      });
    </script>

  <?php endif ?>

  <?= $site->googleAnalytics() ?>

  <?= $site->facebookPixel() ?>

  <?= $site->googleTagManager() ?>

  <?= $site->googleSiteVerification() ?>

  <?= $site->bingSiteVerification() ?>

  <?= $site->yandexVerification() ?>

  <?= $site->pinterestVerification() ?>

  <?= $site->twitterCard() ?>

  <?= $site->robots() ?>

  <?= $site->customCode() ?>

  <?= $site->css() ?>

  <?= $site->js() ?>

  <?= $site->head() ?>
</head>

<body>
  <div class="overlay">
    <?= svg('content/audible-edge-various-squigz-01.svg') ?>
  </div>
  <div class="header-container">
    <header class="header">
      <a class="ae-title" href="<?= $site->url() ?>" title="<?= $site->title() ?>" aria-label="<?= $site->title() ?> Homepage">
        <h1>
          <?= $site->titleDisplay() ?>
        </h1>
      </a>

      <?php if ($page->isHomePage()) : ?>
        <h2 class="ae-subtitle"><?= $site->subtitle() ?></h2>
        <div id="countdown" class="countdown"></div>
      <?php else : ?>
        <h2 class="ae-subtitle">
          <?php snippet('menu', ['expanded' => 'false']) ?>
        </h2>
      <?php endif ?>

      <?php if ($page->isHomePage() || $page->intendedTemplate() === 'home_launch') : ?>
        <?php snippet('dates-global') ?>
      <?php elseif ($page->uid() === 'nightschool') : ?>
        <?php snippet('dates-global', ['parentPage' => 'nightschool'])  ?>
      <?php elseif ($page->uid() === 'satellite') : ?>
        <?php snippet('dates-global', ['parentPage' => 'satellite'])  ?>
      <?php else : ?>
        <?php snippet('dates-local') ?>
      <?php endif ?>
    </header>
  </div>