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

  <style>
    :root {
      --cc-1: <?= $site->color()->or('blue') ?>;
    }
  </style>

  <link rel="shortcut icon" type="image/x-icon" href="<?= url('favicon.ico') ?>">

  <script src="https://d3js.org/d3.v7.js"></script>


</head>

<body>
  <div class="header-container">
    <header class="header">

      <div class="logo-container desktop">
        <a class="logo" href="<?= $site->url() ?>" tabindex="1" title="Audible Edge" aria-label="Audible Edge Homepage">
          <?= svg('assets/logo.svg') ?>
        </a>

        <?php if ($page->isHomePage()) : ?>
          <div class="search-container">
            <input class="search" type="search" data-column="all" placeholder="search">
          </div>
        <?php endif ?>
      </div>


      <nav class="menu-container">
        <ul class="flex menu">

          <?php foreach ($site->children()->listed() as $p) : ?>

            <li class="menu-item">

              <a <?php e($p->isOpen(), 'aria-current="page"') ?> class="menu-item  <?php e($p->isOpen(), ' active') ?>" href="<?= $p->url() ?>">
                <?= $p->title()->esc() ?>
              </a>
            </li>

          <?php endforeach ?>

        </ul>
      </nav>

    </header>
  </div>