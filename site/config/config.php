<?php

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
                // event link
                $eventUuid = (string) $eventPage->id();
                $events[] = $eventUuid;


                // event date data
                $eventDate = (string) $eventPage->start_date()->toDate('Y-m-d');

                $eventType = 'program'; // default event type
                if ($eventPage->intendedTemplate() == 'nightschool-event') {
                    $eventType = 'nightschool';
                } elseif ($eventPage->intendedTemplate() == 'satellite-event') {
                    $eventType = 'satellite';
                }

                if (!isset($datesData[$eventDate])) {
                    $datesData[$eventDate] = ['events' => [], 'artists' => []];
                }
                $datesData[$eventDate]['events'][] = $eventUuid;
                if (!in_array((string) $artist->id(), $datesData[$eventDate]['artists'])) {
                    $datesData[$eventDate]['artists'][] = (string) $artist->id();
                }

                // events data
                if (!isset($eventsData[$eventUuid])) {
                    $eventsData[$eventUuid] = [
                        'uuid' => $eventUuid,
                        'title' => (string) $eventPage->title()->value(),
                        'date' => $eventDate,
                        'artists' => [],
                        'event_type' => []
                    ];
                }
                // add event type if not already included
                if (!in_array($eventType, $eventsData[$eventUuid]['event_type'])) {
                    $eventsData[$eventUuid]['event_type'][] = $eventType;
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
 * all config options: https://getkirby.com/docs/reference/system/options
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
        // [
        //     'pattern' => 'program',
        //     'action'  => function () {
        //         // Check user role or other conditions
        //         if (!kirby()->user() || !kirby()->user()->hasRole('admin', 'editor')) {
        //             return go('/');
        //         }
        //     }
        // ],
        [
            'pattern' => 'artists',
            'action'  => function () {
                return go('/');
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
    ],
    'hooks' => [
        'page.create:after' => function ($newPage) {
            if ($newPage && in_array($newPage->intendedTemplate(), ['artist', 'event', 'nightschool-event', 'satellite-event'])) {
                generateRelationsJson();
            }
        },
        'page.update:after' => function ($newPage, $oldPage) {
            if ($newPage && in_array($newPage->intendedTemplate(), ['artist', 'event', 'nightschool-event', 'satellite-event'])) {
                generateRelationsJson();
            }
        },
        'page.delete:after' => function ($status, $page) {
            if ($page && in_array($page->intendedTemplate(), ['artist', 'event', 'nightschool-event', 'satellite-event'])) {
                generateRelationsJson();
            }
        },
    ],
];
