<?php

declare(strict_types=1);

namespace App\Dto;

use DateTimeImmutable;

final class Cart
{
    private const STATUS_CREATED  = 'created';
    private const STATUS_COMPLETE = 'complete';

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

    public function isCreated(): bool
    {
        return $this->status === self::STATUS_CREATED;
    }

    public function isComplete(): bool
    {
        return $this->status === self::STATUS_COMPLETE;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
