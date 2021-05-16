<?php

declare(strict_types=1);

namespace App\Dto;

use Money\Money;

final class Book
{
    public function __construct(
        private int $id,
        private Author $author,
        private Genre $genre,
        private string $isbn,
        private string $title,
        private ?string $description,
        private int $year,
        private Money $price,
        private Money $tax
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getAuthor(): Author
    {
        return $this->author;
    }

    public function getGenre(): Genre
    {
        return $this->genre;
    }

    public function getIsbn(): string
    {
        return $this->isbn;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function getPrice(): Money
    {
        return $this->price;
    }

    public function getTax(): Money
    {
        return $this->tax;
    }
}
