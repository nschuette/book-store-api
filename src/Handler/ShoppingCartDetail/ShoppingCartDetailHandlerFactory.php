<?php

declare(strict_types=1);

namespace App\Handler\ShoppingCartDetail;

use App\Repository\ShoppingCartRepository;
use Psr\Container\ContainerInterface;

class ShoppingCartDetailHandlerFactory
{
    public function __invoke(ContainerInterface $container): ShoppingCartDetailHandler
    {
        return new ShoppingCartDetailHandler(
            $container->get(ShoppingCartRepository::class)
        );
    }
}
