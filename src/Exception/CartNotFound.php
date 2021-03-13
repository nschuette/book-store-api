<?php

declare(strict_types=1);

namespace App\Exception;

use Exception;

use function sprintf;

final class CartNotFound extends Exception implements ErrorResponse
{
    private const MESSAGE_TEMPLATE = 'No cart with id "%d" found!';

    private function __construct(int $cartId)
    {
        parent::__construct(
            sprintf(self::MESSAGE_TEMPLATE, $cartId),
            1616329235
        );
    }

    public static function byCartId(int $cartId): self
    {
        return new self($cartId);
    }

    public function getStatus(): int
    {
        return 404;
    }

    public function getErrors(): ?array
    {
        return null;
    }
}