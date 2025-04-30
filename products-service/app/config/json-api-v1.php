<?php
return [
    'resources' => [
        'products' => App\Models\Product::class,
    ],
    'url' => [
        'host' => env('APP_URL', 'http://localhost'),
        'namespace' => '/api/v1',
    ],
];