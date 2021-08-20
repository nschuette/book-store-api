<?php

declare(strict_types=1);

namespace App\Exception;

use Exception;

use function sprintf;

final class ShoppingCartNotFound extends Exception implements ErrorResponse
{
    private const MESSAGE_TEMPLATE = 'No shopping cart with id "%d" found!';

    private function __construct(int $shoppingShoppingCartId)
    {
        parent::__construct(
            sprintf(self::MESSAGE_TEMPLATE, $shoppingShoppingCartId),
            1616329235
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
