<?php

declare(strict_types=1);

namespace App\Repository;

use Doctrine\DBAL\Connection;
use Psr\Container\ContainerInterface;

final class ShoppingCartRepositoryFactory
{
    public function __invoke(ContainerInterface $container): ShoppingCartRepository
    {
        return new ShoppingCartRepository(
            $container->get(Connection::class)
        );
    }
}
