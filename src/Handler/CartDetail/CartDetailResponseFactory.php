<?php

declare(strict_types=1);

namespace App\Handler\CartDetail;

use App\Dto\Cart;
use Laminas\Diactoros\Response\JsonResponse;

class CartDetailResponseFactory
{
    public static function create(Cart $cart): JsonResponse
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
