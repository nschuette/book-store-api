<?php

declare(strict_types=1);

namespace App\Handler\CartDetail;

use App\Repository\CartRepository;
use Psr\Container\ContainerInterface;

class CartDetailHandlerFactory
{
    public function __invoke(ContainerInterface $container): CartDetailHandler
    {
        return new CartDetailHandler(
            $container->get(CartRepository::class)
        );
    }
}
