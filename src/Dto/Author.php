<?php

declare(strict_types=1);

namespace App\Dto;

final class Author
{
    private int $id;

    private string $firstname;

    private string $lastname;

    public function __construct(int $id, string $firstname, string $lastname)
    {
        $this->id        = $id;
        $this->firstname = $firstname;
        $this->lastname  = $lastname;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }
}
