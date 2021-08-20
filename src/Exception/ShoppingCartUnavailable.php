<?php

declare(strict_types=1);

namespace App\Exception;

use Exception;

use function sprintf;

final class ShoppingCartUnavailable extends Exception implements ErrorResponse
{
    private const MESSAGE_TEMPLATE = 'The shopping cart with id "%d" is unavailable. Either it is complete or has been canceled!';

    private function __construct(int $shoppingCartId)
    {
        parent::__construct(
            sprintf(self::MESSAGE_TEMPLATE, $shoppingCartId),
            1616352222
        );
    }

    public static function byShoppingCartId(int $shoppingCartId): self
    {
        return new self($shoppingCartId);
    }

    public function getStatus(): int
    {
        return 404;
    }

    /** @return array<int, array<string, string>>|null */
    public function getErrors(): ?array
    {
        return null;
    }
}
