<?php
// load relations SVG on home page and nightschool index
if ($page->isHomePage() || $page->uid() === "program" || $page->uid() === "nightschool") : ?>
  <?= js([
    'assets/js/ae24-squig.js',
    '@auto',
  ]) ?>
<?php else : ?>
  <?= js([
    '@auto',
  ]) ?>
<?php endif ?>
<div class="overlay" style="display: none;">
  <div class="overlay-svg-container">
    <?= // squig
    svg('content/audible-edge-various-squigz-01.svg') ?>
  </div>
</div>
</body>

</html>