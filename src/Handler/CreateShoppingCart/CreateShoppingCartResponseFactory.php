<?php

declare(strict_types=1);

namespace App\Handler\CreateShoppingCart;

use Laminas\Diactoros\Response\RedirectResponse;

use function sprintf;

class CreateShoppingCartResponseFactory
{
    private const SHOPPING_CART_DETAIL_URI = '/api/shopping_cart/%d';

    public static function create(int $shoppingCartId): RedirectResponse
    {
        return new RedirectResponse(
            sprintf(self::SHOPPING_CART_DETAIL_URI, $shoppingCartId)
        );
    }
}
