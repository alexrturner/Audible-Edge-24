<?php
// all listed events sorted by 'start_date' and 'start_time'
if ($page->parent()->uid() === 'program') {
    $allEvents = page('program')->children()->listed()->sortBy('start_date', 'asc', 'start_time', 'asc');
} elseif ($page->parent()->uid() === 'nightschool') {
    $allEvents = page('nightschool')->children()->listed()->sortBy('start_date', 'asc', 'start_time', 'asc');
} else {
    return;
}

// current event's position
$currentEventIndex = $allEvents->indexOf($page);

$prevEvent = null;
$nextEvent = null;

if ($currentEventIndex !== false) {
    $prevEvent = ($currentEventIndex > 0) ? $allEvents->nth($currentEventIndex - 1) : null;
    $nextEvent = ($currentEventIndex < $allEvents->count() - 1) ? $allEvents->nth($currentEventIndex + 1) : null;
}
?>
<?php if ($currentEventIndex !== false) : ?>
    <nav class="pagination">
        <?php if ($prevEvent) : ?>
            <a href="<?= $prevEvent->url() ?>" title="<?= $prevEvent->title() ?>" rel="prev">&larr; Previous Event</a>
        <?php endif; ?>

        <?php if ($nextEvent) : ?>
            <a href="<?= $nextEvent->url() ?>" title="<?= $nextEvent->title() ?>" rel="next">Next. Event &rarr;</a>
        <?php endif; ?>
    </nav>
<?php endif; ?>