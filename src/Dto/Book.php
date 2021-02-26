<?php

declare(strict_types=1);

namespace App\Dto;

final class Book
{
    public int $id;

    public Author $author;

    public Genre $genre;

    public string $isbn;

    public string $title;

    public ?string $description = null;

    public int $year;

    public Price $price;

    public function __construct(
        int $id,
        Author $author,
        Genre $genre,
        string $isbn,
        string $title,
        ?string $description,
        int $year,
        Price $price
    ) {
        $this->id          = $id;
        $this->author      = $author;
        $this->genre       = $genre;
        $this->isbn        = $isbn;
        $this->title       = $title;
        $this->description = $description;
        $this->year        = $year;
        $this->price       = $price;
    }
}
