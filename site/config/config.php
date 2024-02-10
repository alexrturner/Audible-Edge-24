<?php

// function generateArtistsAndEventsJson()
// {
//     $kirby = kirby();
//     // Fetch artists using the 'artist' template
//     $artists = page('artists')->children()->listed();
//     $artistData = [];

//     foreach ($artists as $artist) {
//         // Fetch associated events using the 'events' field (pages field)
//         $events = [];
//         foreach ($artist->events()->toPages() as $eventPage) {
//             if ($eventPage) {
//                 $events[] = [
//                     'uuid' => (string) $eventPage->id(),
//                     'title' => (string) $eventPage->title()->value(),

//                 ];
//             }
//         }

//         $artistData[] = [
//             'uuid' => (string) $artist->id(),
//             'title' => (string) $artist->title()->value(),
//             'events' => $events,
//             // Include additional artist details as needed
//         ];
//     }

//     $jsonData = json_encode($artistData, JSON_PRETTY_PRINT);
//     file_put_contents($kirby->root('assets') . '/data/artists-and-events.json', $jsonData);
// }



function generateRelationsJson()
{
    $kirby = kirby();
    $artists = page('artists')->children()->listed();
    $artistData = [];
    $eventsData = [];
    $datesData = [];

    foreach ($artists as $artist) {
        $events = [];
        foreach ($artist->events()->toPages() as $eventPage) {
            if ($eventPage) {
                $eventUuid = (string) $eventPage->id();
                $events[] = $eventUuid;

                // Assuming you have a startDate field in your event pages
                $eventDate = (string) $eventPage->start_date()->toDate('Y-m-d');
                if (!isset($datesData[$eventDate])) {
                    $datesData[$eventDate] = ['events' => [], 'artists' => []];
                }
                $datesData[$eventDate]['events'][] = $eventUuid;
                if (!in_array((string) $artist->id(), $datesData[$eventDate]['artists'])) {
                    $datesData[$eventDate]['artists'][] = (string) $artist->id();
                }

                // Populate events data
                if (!isset($eventsData[$eventUuid])) {
                    $eventsData[$eventUuid] = [
                        'uuid' => $eventUuid,
                        'title' => (string) $eventPage->title()->value(),
                        'date' => $eventDate,
                        'artists' => [],
                    ];
                }
                $eventsData[$eventUuid]['artists'][] = (string) $artist->id();
            }
        }

        $artistData[(string) $artist->id()] = [
            'uuid' => (string) $artist->id(),
            'title' => (string) $artist->title()->value(),
            'events' => $events,
        ];
    }

    $combinedData = [
        'artists' => $artistData,
        'events' => $eventsData,
        'dates' => $datesData,
    ];

    $jsonData = json_encode($combinedData, JSON_PRETTY_PRINT);
    file_put_contents($kirby->root('assets') . '/data/relations.json', $jsonData);
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
            'pattern' => 'artists',
            'action'  => function () {
                return go('/');
            }
        ],
        [
            'pattern' => 'program',
            'action'  => function () {
                // if (!kirby()->user() || !kirby()->user()->hasRole('admin', 'editor')) {
                return go('/');
                // }
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
            generateRelationsJson();
            if ($newPage && ($newPage->intendedTemplate() === 'artist' || $newPage->intendedTemplate() === 'event')) {
                generateRelationsJson();
            }
        },
        'page.update:after' => function ($newPage, $oldPage) {
            generateRelationsJson();
            if ($newPage && ($newPage->intendedTemplate() === 'artist' || $newPage->intendedTemplate() === 'event')) {
                generateRelationsJson();
            }
        },
        'page.delete:after' => function ($status, $page) {
            if ($page && ($page->intendedTemplate() === 'artist' || $page->intendedTemplate() === 'event')) {
                generateRelationsJson();
            }
        },
    ],


];
