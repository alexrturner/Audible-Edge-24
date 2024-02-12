<?php
// fetch and format dates and times
$start_date = $page->start_date()->toDate('F jS');
$start_time = $page->start_time()->toDate('H:iA');

$end_date = $page->end_date()->toDate('F jS');
$end_time = $page->end_time()->toDate('H:iA');
?>

<ul class="dates items">

    <li class="date">
        <?= $start_date ?>
        <?php if ($start_time) : ?>
            <span class="time"><?= $start_time ?></span>
        <?php endif; ?>

        <?php
        // if end date and start date are the same, display different times
        if ($end_date && $start_date === $end_date) {
            if ($end_time && $start_time !== $end_time) {
                echo " – " . $end_time;
            }
        }
        ?>
    </li>
    <?php
    // if end date is different from start date
    if ($end_date && $start_date !== $end_date) : ?>
        <li class="date"><?= $end_date ?>
            <?php if ($end_time) : ?>
                <span class="time"><?= $end_time ?></span>
            <?php endif; ?>
        </li>
    <?php endif; ?>

</ul>