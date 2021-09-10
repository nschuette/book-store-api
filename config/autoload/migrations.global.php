<?php

return [
    'doctrine' => [
        'migrations' => [
            'table_storage' => [
                'table_name' => 'migrations',
            ],
            'migrations_paths' => [
                'App\Migrations' => 'data/migrations',
            ],
        ],
    ],
];