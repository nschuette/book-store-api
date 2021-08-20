<?php

declare(strict_types=1);

namespace App\Handler\CreateShoppingCart;

use App\Repository\ShoppingCartRepository;
use Psr\Container\ContainerInterface;

class CreateShoppingCartHandlerFactory
{
    public function __invoke(ContainerInterface $container): CreateShoppingCartHandler
    {
        return new CreateShoppingCartHandler(
            $container->get(ShoppingCartRepository::class)
        );
    }
}
