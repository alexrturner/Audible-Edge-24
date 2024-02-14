<?php
$parentPage = $parentPage ?? 'program';
$events = page($parentPage)->children()->listed();
$dates = [];

foreach ($events as $event) {
    if ($event->start_date()->isNotEmpty()) {
        $displayDate = $event->start_date()->toDate('F jS');
        $dataDate = $event->start_date()->toDate('Y-m-d');

        $uniqueKey = $dataDate;

        // check if unique key is not already in the array to avoid duplicates
        if (!array_key_exists($uniqueKey, $dates)) {
            $dates[$uniqueKey] = ['display' => $displayDate, 'data' => $dataDate];
        }
    }
}
// sort the dates array by keys = chronological order
ksort($dates);
?>

<div class="dates-container">
    <h2 class="dates-header">Upcoming Dates</h2>
    <ul class="dates items">
        <?php foreach ($dates as $date) : ?>
            <li data-type="date" data-id="<?= htmlspecialchars($date['data'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                <?= htmlspecialchars($date['display']) ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>