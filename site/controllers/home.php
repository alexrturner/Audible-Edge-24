<?php

return function ($site, $pages, $page) {
    $projectTitle = '';

    if ($page->project()->isNotEmpty()) {
        $projectId = $page->project()->value();
        $projectPage = $site->find($projectId);

        if ($projectPage) {
            $projectTitle = $projectPage->title()->value();
        }
    }

    // Return variables to the template
    return [
        'projectTitle' => $projectTitle
    ];
};
