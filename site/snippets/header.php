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

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const isDisabled = localStorage.getItem('stylesDisabled') === 'true';
      for (let i = 0; i < document.styleSheets.length; i++) {
        document.styleSheets[i].disabled = isDisabled;
      }
    });
  </script>

  <?= css([
    'assets/css/normalize.v8.0.1.css',
    'assets/css/index.css',
    '@auto',
  ]) ?>

  <?= js([
    'assets/js/script.js'
  ]) ?>

  <script src="https://d3js.org/d3.v7.js"></script>

  <?php if ($page->isHomePage()) : ?>
    <?= js('assets/js/countdown.js') ?>
  <?php else : ?>
    <?= js('assets/js/menu-overlay.js') ?>
  <?php endif ?>



  <link rel="shortcut icon" type="image/x-icon" href="<?= url('favicon.ico') ?>">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="description" content="<?= $site->metaDescription()->esc() ?> ">
  <meta name="keywords" content="<?= $site->metaKeywords()->esc() ?>">
  <meta name="author" content="Tone List">
</head>

<body>

  <div class="header-container">
    <header class="header">
      <?php if ($page->isHomePage()) : ?>
        <h1 class="ae-title pseudo-list-item">
          <?= $site->titleDisplay() ?>
        </h1>

      <?php else : ?>
        <a class="ae-title" href="<?= $site->url() ?>" title="<?= $site->title() ?>" aria-label="<?= $site->title() ?> Homepage">
          <h1>
            <?php if ($page->uid() === 'nightschool' || ($page->parent() && $page->parent()->uid() === 'nightschool')) : ?>
              Night School
            <?php else : ?>
              <?= $site->titleDisplay() ?>
            <?php endif ?>
          </h1>
          <div class="svg-banner" style="display: none;">
            <?= svg('assets/img/banner/AE24-banner-01.svg') ?>
          </div>
        </a>
        <div class="anchor-point"></div>
      <?php endif ?>


      <?php if ($page->isHomePage() || $page->uid() === 'program') : ?>
        <?php if ($page->isHomePage()) : ?>
          <div class="countdown-container">
            Full program announced in <span id="countdown"></span>
          </div>
        <?php endif ?>
      <?php else : ?>

      <?php endif ?>

      <?php
      if ($page->isHomePage()) : ?>
        <?php // snippet('dates-global') 
        ?>
      <?php elseif ($page->uid() === 'program') : ?>
        <?php snippet('dates-global') ?>
      <?php elseif ($page->uid() === 'nightschool') : ?>
        <?php snippet('dates-global', ['parentPage' => 'nightschool'])  ?>
      <?php elseif ($page->uid() === 'satellite') : ?>
        <?php snippet('dates-global', ['parentPage' => 'satellite'])  ?>
      <?php else : ?>
        <?php snippet('dates-local') ?>
      <?php endif ?>
    </header>
    <?php if (!$page->isHomePage()) : ?>

      <div class="menu-header-container">
        <?php
        // arguments: expanded (true/false)
        $expanded = "false";
        ?>
        <button class="menu-toggle toggle pseudo-list-item" aria-expanded="<?= $expanded ?>" aria-controls="menu-items" aria-label="Toggle Menu">Menu</span></button>
        <br><br>

        <ul class="menu-items <?php e($expanded === "true", "", "hidden"); ?>" id="menu-items">
          <li class="menu-item">
            <a href="/satellite/program-launch" class="menu-link">
              Program Launch
            </a>
          </li>
          <?php foreach ($site->children()->listed() as $p) : ?>
            <li class="menu-item">
              <a <?php e($p->isOpen(), 'aria-current="page"') ?> href="<?= $p->url() ?>" class="menu-link<?php e($p->isOpen(), ' active') ?>">
                <?= $p->title()->esc() ?>
              </a>
            </li>
          <?php endforeach ?>

        </ul>

        <?php if ($page->parent()) : ?>
          <?php snippet('pagination-event') ?>
        <?php endif ?>
      </div>
    <?php endif ?>
    <div class="plain-text-container" style="position: fixed; top: 0.5rem; right: 0.3rem;">
      <button id="togglePlainTextView" class="pseudo-list-item">Plain Text</button>

      <?php if ($page->uid() === 'nightschool' || $page->slug('program')) : ?>
        <?php snippet('settings') ?>
      <?php endif ?>
    </div>
  </div>