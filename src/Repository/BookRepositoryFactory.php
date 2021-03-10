<?php

declare(strict_types=1);

namespace App\Repository;

use Doctrine\DBAL\Connection;
use Psr\Container\ContainerInterface;

final class BookRepositoryFactory
{
    public function __invoke(ContainerInterface $container): BookRepository
    {
        return new BookRepository(
            $container->get(Connection::class)
        );
    }
}
