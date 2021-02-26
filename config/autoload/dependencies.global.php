<?php

declare(strict_types=1);

return [
    'dependencies' => [
        'factories'  => [
            Doctrine\DBAL\Connection::class => App\Infrastructure\ConnectionFactory::class
        ],
    ],
];
