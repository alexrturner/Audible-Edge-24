<ul class="dates items">
    <?php
    if ($start_date = $page->start_date()->toDate('F jS')) : ?>
        <li class="date">
            <?= $start_date ?>
            <?php if ($start_time = $page->start_time()->toDate('H:iA')) : ?>
                <span class="time">, <?= $start_time ?></span>
            <?php endif; ?>
        </li>
    <?php endif; ?>
    <?php if ($end_date = $page->end_date()->toDate('F jS')) : ?>
        <li class="date"><?= $end_date ?>
            <?php if ($end_time = $page->end_time()->toDate('H:iA')) : ?>
                <span class="time">, <?= $end_time ?></span>
            <?php endif; ?>
        </li>
    <?php endif; ?>
</ul>