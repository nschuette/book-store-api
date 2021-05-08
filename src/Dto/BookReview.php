<?php

declare(strict_types=1);

namespace App\Dto;

use DateTimeImmutable;

final class BookReview
{
    public function __construct(
        private int $id,
        private int $bookId,
        private int $rating,
        private string $name,
        private string $text,
        private DateTimeImmutable $createdAt
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getBookId(): int
    {
        return $this->bookId;
    }

    public function getRating(): int
    {
        return $this->rating;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
