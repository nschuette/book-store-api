<?php

declare(strict_types=1);

namespace App\Dto;

final class Author
{
    public int $id;

    public string $firstname;

    public string $lastname;

    public function __construct(int $id, string $firstname, string $lastname)
    {
        $this->id        = $id;
        $this->firstname = $firstname;
        $this->lastname  = $lastname;
    }
}
