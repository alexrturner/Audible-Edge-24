<?php
$events = page('program')->children()->listed();
$dates = [];

foreach ($events as $event) {
    $displayDate = $event->start_date()->toDate('F jS');
    $dataDate = $event->start_date()->toDate('Y-m-d');

    $uniqueKey = $dataDate;

    // check if unique key is not already in the array to avoid duplicates
    if (!array_key_exists($uniqueKey, $dates)) {
        $dates[$uniqueKey] = ['display' => $displayDate, 'data' => $dataDate];
    }
}
// sort the dates array by keys = chronological order
ksort($dates);
?>

<ul class="dates items">
    <?php foreach ($dates as $date) : ?>
        <li data-type="date" data-id="<?= htmlspecialchars($date['data']) ?>">
            <?= htmlspecialchars($date['display']) ?>
        </li>
    <?php endforeach; ?>
</ul>