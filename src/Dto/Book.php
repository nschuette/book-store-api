<?php

declare(strict_types=1);

namespace App\Dto;

final class Book
{
    public function __construct(
        private int $id,
        private string $isbn,
        private string $title,
        private Author $author,
        private Genre $genre,
        private int $year,
        private ?string $description,
        private Price $price
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getIsbn(): string
    {
        return $this->isbn;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getAuthor(): Author
    {
        return $this->author;
    }

    public function getGenre(): Genre
    {
        return $this->genre;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getPrice(): Price
    {
        return $this->price;
    }
}
