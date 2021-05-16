<?php

declare(strict_types=1);

namespace App\Dto;

use DateTimeImmutable;
use Money\Money;

final class ShoppingCartItem
{
    public function __construct(
        private int $id,
        private int $shoppingCartId,
        private int $bookId,
        private Money $price,
        private Money $tax,
        private int $quantity,
        private DateTimeImmutable $createdAt,
        private ?DateTimeImmutable $updatedAt = null,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getShoppingCartId(): int
    {
        return $this->shoppingCartId;
    }

    public function getBookId(): int
    {
        return $this->bookId;
    }

    public function getPrice(): Money
    {
        return $this->price;
    }

    public function getTax(): Money
    {
        return $this->tax;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }
}
