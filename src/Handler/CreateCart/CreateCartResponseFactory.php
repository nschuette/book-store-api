<?php

declare(strict_types=1);

namespace App\Handler\CreateCart;

use Laminas\Diactoros\Response\RedirectResponse;

use function sprintf;

class CreateCartResponseFactory
{
    private const CART_DETAIL_URI = '/api/cart/%d';

    public static function create(int $cartId): RedirectResponse
    {
        return new RedirectResponse(
            sprintf(self::CART_DETAIL_URI, $cartId)
        );
    }
}
