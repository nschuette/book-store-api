<?php

declare(strict_types=1);

namespace App\Handler\ShoppingCartDetail;

use App\Dto\ShoppingCart;
use Laminas\Diactoros\Response\JsonResponse;

class ShoppingCartDetailResponseFactory
{
    public static function create(ShoppingCart $cart): JsonResponse
    {
        return new JsonResponse([
            'cart_id'   => $cart->getId(),
            'items'     => [],
            'payment'   => [
                'total'    => 0.00,
                'tax'      => 0.00,
                'currency' => 'EUR',
            ],
        ]);
    }
}
