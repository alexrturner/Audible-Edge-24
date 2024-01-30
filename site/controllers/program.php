<?php

return function ($page) {

    $gallery = $page->images()->sortBy('sort', 'filename');

    return [
        'gallery' => $gallery
    ];
};
