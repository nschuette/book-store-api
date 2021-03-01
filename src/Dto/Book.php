<?php

declare(strict_types=1);

namespace App\Dto;

final class Book
{
    private int $id;

    private string $isbn;

    private string $title;

    private Author $author;

    private Genre $genre;

    private int $year;

    private ?string $description;

    private Price $price;

    public function __construct(
        int $id,
        string $isbn,
        string $title,
        Author $author,
        Genre $genre,
        int $year,
        ?string $description,
        Price $price
    ) {
        $this->id          = $id;
        $this->isbn        = $isbn;
        $this->title       = $title;
        $this->author      = $author;
        $this->genre       = $genre;
        $this->year        = $year;
        $this->description = $description;
        $this->price       = $price;
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
