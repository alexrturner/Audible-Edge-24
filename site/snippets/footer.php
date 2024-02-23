<div id="lineCanvas-container" style="display: none;">
  <svg id="lineCanvas">
    <!-- squig -->
  </svg>
</div>





<?php
// load relations SVG on home page and nightschool index
if ($page->isHomePage() || $page->uid() === "program" || $page->uid() === "nightschool") : ?>
  <?= js([
    'assets/js/ae24-squig.js',
    '@auto',
  ]) ?>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const eventItems = document.querySelectorAll('.events-item');
      const timesContainer = document.getElementById('dates-event-times');

      eventItems.forEach(function(item) {
        item.addEventListener('mouseover', function() {
          const startTime = this.getAttribute('data-start-time');
          const endTime = this.getAttribute('data-end-time');
          timesContainer.textContent = `Start: ${startTime}, End: ${endTime}`;
        });

        item.addEventListener('mouseout', function() {
          timesContainer.textContent = '';
        });
      });
    });
  </script>

<?php else : ?>
  <?= js([
    '@auto',
  ]) ?>
<?php endif ?>

<?php if ($page->intendedTemplate("event")) : ?>
  <script>
    let noiseIntensity = 80;
    let subdivisionFactor = 3;

    function addNoiseToLine(points, noiseIntensity = 2, subdivisionFactor = 5) {
      let noisyPoints = [];

      points.forEach((point, i) => {
        // add original point
        noisyPoints.push(point);
        // for each segment, add midpoints with noise
        if (i < points.length - 1) {
          const nextPoint = points[i + 1];
          // subdivide segment and add noise
          for (let j = 1; j <= subdivisionFactor; j++) {
            const t = j / (subdivisionFactor + 1);
            const midX = point.x + (nextPoint.x - point.x) * t;
            const midY = point.y + (nextPoint.y - point.y) * t;
            const noisyMidPoint = addRandomness({
                x: midX,
                y: midY
              },
              noiseIntensity
            );
            noisyPoints.push(noisyMidPoint);
          }
        }
      });

      return noisyPoints;
    }

    function addRandomness(point, intensity = 100) {
      // add random displacement to x and y, controlled by intensity
      return {
        x: point.x + (Math.random() - 0.5) * intensity,
        y: point.y + (Math.random() - 0.5) * intensity,
      };
    }

    function getElementPosition(element) {
      const rect = element.getBoundingClientRect();
      return {
        x: rect.left + window.scrollX,
        y: rect.top + window.scrollY
      };
    }
    const lineGenerator = d3
      .line()
      .x((d) => d.x)
      .y((d) => d.y)
      // apply smooth curve
      // alpha controls the tension
      .curve(d3.curveCatmullRom.alpha(0.5));

    const svg = d3.select("#lineCanvas");
    const eventItem = document.querySelector('.events-item');
    const anchorItem = document.querySelector('.anchor-point');
    const dateItem = document.querySelector('.date');
    document.addEventListener("DOMContentLoaded", function() {
      const eventPosition = getElementPosition(eventItem);
      const anchorPosition = getElementPosition(anchorItem);
      const datePosition = getElementPosition(dateItem);

      let points = [eventPosition, anchorPosition, datePosition];

      // add noise
      let pointsWithNoise = addNoiseToLine(points, noiseIntensity, subdivisionFactor);

      // gen path
      const pathData = lineGenerator(pointsWithNoise);

      svg.append("path")
        .attr("d", pathData)
        .style("stroke", "var(--cc-squig-colour)")
        .style("stroke-width", 6)
        .style("fill", "none");
    });
  </script>
<?php endif; ?>

<div class="overlay" style="display: none;">
  <div class="overlay-svg-container">
    <?php
    $logoFiles = $site->files()->template('ae_logo_menu');
    $index = 0;
    foreach ($logoFiles as $file) :
    ?>
      <div class="logo" id="logo-menu-<?= $index ?>" style="<?= $index > 0 ? 'display: none;' : '' ?>">
        <?= $file->read() ?>
      </div>
    <?php
      $index++;
    endforeach;
    ?>
  </div>
</div>
</body>

</html>