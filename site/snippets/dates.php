<?php
// Fetch all listed children/pages for the festival events
// $events = $site->children()->listed();
$events = page('program')->children()->listed();

// Initialize an array to hold dates for display and data attributes
$dates = [];

// Loop through each event
foreach ($events as $event) {
    // Extract and format the start date for display
    $displayDate = $event->start_date()->toDate('F jS');
    // Format the start date for the data-date attribute
    $dataDate = $event->start_date()->toDate('Y-m-d');

    // Construct a unique key to avoid duplicates with different formats
    $uniqueKey = $dataDate;

    // Check if the unique key is not already in the array to avoid duplicates
    if (!array_key_exists($uniqueKey, $dates)) {
        // If not, add it to the array with both display and data-date formats
        $dates[$uniqueKey] = ['display' => $displayDate, 'data' => $dataDate];
    }
}
// Sort the dates array by keys to ensure it's in chronological order
ksort($dates);
?>

<ul class="dates">
    <?php foreach ($dates as $date) : ?>
        <li data-type="date" data-id="<?= htmlspecialchars($date['data']) ?>">
            <?= htmlspecialchars($date['display']) ?>
        </li>
    <?php endforeach; ?>
</ul>