<?php

return function ($kirby, $page) {
    // Fetch all 'work' pages
    $workPages = $kirby->site()->index()->filterBy('intendedTemplate', 'work');

    // Extract and compile unique categories
    $categories = $workPages->pluck('category_test', ',', true);

    // Remove duplicates and empty values
    $categories = array_filter(array_unique($categories));

    // Return an array of variables to the template
    return [
        'categories' => $categories
    ];
};
