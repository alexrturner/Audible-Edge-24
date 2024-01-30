<?php

// function generateCategoriesJson()
// {
//     $categories = page('works')->children()->pluck('category', ',', true);
//     $jsonData = json_encode($categories);
//     file_put_contents(kirby()->root('site') . '/categories.json', $jsonData);
// }


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
        ]

    ],
    // 'hooks' => [
    //     'page.update:after' => function ($newPage, $oldPage) {
    //         // check if updated page is a child of 'projects' and if the 'Category' field has changed
    //         if ($newPage->parent()->slug() === 'works' && $newPage->category()->value() !== $oldPage->category()->value()) {
    //             // regenerate the JSON file
    //             generateCategoriesJson();
    //         }
    //     }
    // ],

];
