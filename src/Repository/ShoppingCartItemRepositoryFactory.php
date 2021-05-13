<?php

declare(strict_types=1);

namespace App\Repository;

use Doctrine\DBAL\Connection;
use Psr\Container\ContainerInterface;

final class ShoppingCartItemRepositoryFactory
{
    public function __invoke(ContainerInterface $container): ShoppingCartItemRepository
    {
        return new ShoppingCartItemRepository(
            $container->get(Connection::class)
        );
    }
}
