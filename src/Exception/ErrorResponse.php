<?php

declare(strict_types=1);

namespace App\Exception;

interface ErrorResponse
{
    public function getStatus(): int;

    /** @return array<int, array<string, string>>|null */
    public function getErrors(): ?array;
}
