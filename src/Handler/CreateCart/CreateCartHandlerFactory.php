<?php

declare(strict_types=1);

namespace App\Handler\CreateCart;

use App\Repository\CartRepository;
use Psr\Container\ContainerInterface;

class CreateCartHandlerFactory
{
    public function __invoke(ContainerInterface $container): CreateCartHandler
    {
        return new CreateCartHandler(
            $container->get(CartRepository::class)
        );
    }
}
