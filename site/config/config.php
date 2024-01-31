<?php

function generateArtistsAndEventsJson()
{
    $kirby = kirby();
    // Fetch artists using the 'artist' template
    // $artists = $kirby->site()->children()->listed()->filterBy('intendedTemplate', 'artist');
    $artists = page('artists')->children()->listed();
    $artistData = [];

    foreach ($artists as $artist) {
        // Fetch associated events using the 'events' field (pages field)
        $events = [];
        foreach ($artist->events()->toPages() as $eventPage) {
            if ($eventPage) {
                $events[] = [
                    // 'uuid' => $eventPage->uuid(),
                    // 'title' => $eventPage->title()
                    'uuid' => (string) $eventPage->id(),
                    'title' => (string) $eventPage->title()->value(),

                ];
            }
        }

        $artistData[] = [
            // 'uuid' => $artist->uuid(),
            // 'title' => $artist->title(),
            'uuid' => (string) $artist->id(),
            'title' => (string) $artist->title()->value(),
            'events' => $events,
            // Include additional artist details as needed
        ];
    }

    $jsonData = json_encode($artistData, JSON_PRETTY_PRINT);
    file_put_contents($kirby->root('assets') . '/data/artists-and-events.json', $jsonData);
}


/**
 * All config options: https://getkirby.com/docs/reference/system/options
 */
return [
    'debug' => true,
    'panel' => [
        'install' => true
    ],
    'api' => [
        'basicAuth' => true
    ],
    'languages' => true,
    'thumbs' => [
        'srcsets' => [
            'default' => [300, 600, 900, 1200, 1800, 2400, 3000, 3600, 4200, 4800],
            'large' => [300, 600, 900, 1200, 1800, 2400, 3000, 3600, 4200, 4800],
            'medium' => [300, 600, 900, 1200, 1800, 2400, 3000, 3600, 4200, 4800],
            'small' => [300, 600, 900, 1200, 1800, 2400, 3000, 3600, 4200, 4800],
            'tiny' => [300, 600, 900, 1200, 1800, 2400, 3000, 3600, 4200, 4800],
        ]
    ],
    'routes' => [
        [
            'pattern' => 'works(:all)',
            'action'  => function () {
                // Check user role or other conditions
                if (!kirby()->user() || !kirby()->user()->hasRole('admin', 'editor')) {
                    return go('/');
                }
            }
        ],
        [
            'pattern' => 'projects',
            'action'  => function () {
                if (!kirby()->user() || !kirby()->user()->hasRole('admin', 'editor')) {
                    return go('/');
                }
            }
        ],
        [
            'pattern' => 'services',
            'action'  => function () {
                if (!kirby()->user() || !kirby()->user()->hasRole('admin', 'editor')) {
                    return go('/');
                }
            }
        ],
        [
            'pattern' => 'upcoming/(:any)',
            'action'  => function ($any) {
                if (!kirby()->user() || !kirby()->user()->hasRole('admin', 'editor')) {
                    return go('/');
                }
            }
        ],
        [
            'pattern' => '(:any)',
            'action'  => function ($uri) {
                $page = page($uri);
                if (!$page) $page = page('error');
                return site()->visit($page);
            }
        ],

        // [
        //     'pattern' => 'api/data',
        //     'method' => 'GET',
        //     'action'  => function () {
        //         $kirby = kirby();
        //         $artists = page('artists')->children()->listed();
        //         // $events = page('events')->children()->listed();

        //         $artistData = [];
        //         foreach ($artists as $artist) {
        //             $events = [];
        //             foreach ($artist->events()->toStructure() as $eventLink) {
        //                 $eventPage = $kirby->page($eventLink->value());
        //                 if ($eventPage) {
        //                     $events[] = [
        //                         'uuid' => $eventPage->uuid()->value(),
        //                         'title' => $eventPage->title()->value(),
        //                     ];
        //                 }
        //             }

        //             $artistData[] = [
        //                 'uuid' => $artist->uuid()->value(),
        //                 'title' => $artist->title()->value(),
        //                 'events' => $events,
        //             ];
        //         }

        //         // Fetch events similarly, if needed

        //         // Return JSON response
        //         return [
        //             'statusCode' => 200,
        //             'headers' => [
        //                 'Content-Type' => 'application/json'
        //             ],
        //             'body' => json_encode($artistData),
        //         ];
        //     },

        // ],


    ],
    'hooks' => [
        'page.create:after' => function ($newPage) {
            generateArtistsAndEventsJson();
            if ($newPage && ($newPage->intendedTemplate() === 'artist' || $newPage->intendedTemplate() === 'event')) {
                generateArtistsAndEventsJson();
            }
        },
        'page.update:after' => function ($newPage, $oldPage) {
            generateArtistsAndEventsJson();
            if ($newPage && ($newPage->intendedTemplate() === 'artist' || $newPage->intendedTemplate() === 'event')) {
                generateArtistsAndEventsJson();
            }
        },
        'page.delete:after' => function ($status, $page) {
            if ($page && ($page->intendedTemplate() === 'artist' || $page->intendedTemplate() === 'event')) {
                generateArtistsAndEventsJson();
            }
        },
    ],


];
