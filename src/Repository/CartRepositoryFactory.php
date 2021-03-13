<?php

declare(strict_types=1);

namespace App\Repository;

use Doctrine\DBAL\Connection;
use Psr\Container\ContainerInterface;

final class CartRepositoryFactory
{
    public function __invoke(ContainerInterface $container): CartRepository
    {
        return new CartRepository(
            $container->get(Connection::class)
        );
    }
}