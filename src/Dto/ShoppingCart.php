<?php

declare(strict_types=1);

namespace App\Dto;

use DateTimeImmutable;

final class ShoppingCart
{
    public const STATUS_CREATED  = 'created';
    public const STATUS_COMPLETE = 'complete';
    public const STATUS_CANCELED = 'canceled';

    public function __construct(
        private int $id,
        private string $status,
        private DateTimeImmutable $createdAt
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function isComplete(): bool
    {
        return $this->status === self::STATUS_COMPLETE;
    }

    public function isCanceled(): bool
    {
        return $this->status === self::STATUS_CANCELED;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
