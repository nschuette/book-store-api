<?php

declare(strict_types=1);

return [
    'dependencies' => [
        'factories'  => [
            // Infrastructure
            Doctrine\DBAL\Connection::class => App\Infrastructure\ConnectionFactory::class,

            // Repositories
            App\Repository\BookRepository::class => App\Repository\BookRepositoryFactory::class,
            App\Repository\BookReviewRepository::class => App\Repository\BookReviewRepositoryFactory::class,
        ],
    ],
];
