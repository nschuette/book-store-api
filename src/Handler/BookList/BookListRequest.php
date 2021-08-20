<?php

declare(strict_types=1);

namespace App\Handler\BookList;

final class BookListRequest
{
    private function __construct(
        private ?string $sortBy = null,
        private string $order,
    ) {
    }

    /** @param array<string, string> $queryParams */
    public static function createFromArray(array $queryParams): self
    {
        return new self(
            $queryParams['sort_by'] ?? null,
            $queryParams['order'] ?? 'asc'
        );
    }

    public function getSortBy(): ?string
    {
        return $this->sortBy;
    }

    public function getOrder(): string
    {
        return $this->order;
    }
}
