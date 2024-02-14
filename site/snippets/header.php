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

  <script src="https://d3js.org/d3.v7.js"></script>

  <?php if (!$page->isHomePage()) : ?>
    <?= js('assets/js/menu-overlay.js') ?>
  <?php else : ?>
    <?= js('assets/js/countdown.js') ?>
  <?php endif ?>

  <link rel="shortcut icon" type="image/x-icon" href="<?= url('favicon.ico') ?>">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="description" content="<?= $site->metaDescription() ?> ">
  <meta name="keywords" content="<?= $site->metaKeywords() ?>">
  <meta name="author" content="Tone List">
</head>

<body>
  <div class="header-container">
    <header class="header">
      <a class="ae-title" href="<?= $site->url() ?>" title="<?= $site->title() ?>" aria-label="<?= $site->title() ?> Homepage">
        <h1>
          <?php if ($page->uid() === 'nightschool' || ($page->parent() && $page->parent()->uid() === 'nightschool')) : ?>
            Night School
          <?php else : ?>
            <?= $site->titleDisplay() ?>
          <?php endif ?>
        </h1>
      </a>

      <?php if ($page->isHomePage()) : ?>
        <h2 class="ae-subtitle"><?= $site->subtitle() ?></h2>
        <div id="countdown" class="countdown"></div>
      <?php else : ?>
        <div class="ae-subtitle">
          <?php snippet('menu', ['expanded' => 'false']) ?>
        </div>
      <?php endif ?>
      <button id="toggleStyles" style="position: fixed; top: 0; right: 0;">Toggle CSS Styles</button>

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