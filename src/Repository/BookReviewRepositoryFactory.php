<?php

declare(strict_types=1);

namespace App\Repository;

use Doctrine\DBAL\Connection;
use Psr\Container\ContainerInterface;

class BookReviewRepositoryFactory
{
    public function __invoke(ContainerInterface $container): BookReviewRepository
    {
        return new BookReviewRepository(
            $container->get(Connection::class)
        );
    }
}