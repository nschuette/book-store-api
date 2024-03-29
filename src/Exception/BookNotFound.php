<?php

declare(strict_types=1);

namespace App\Exception;

use Exception;

use function sprintf;

final class BookNotFound extends Exception implements ErrorResponse
{
    private const MESSAGE_TEMPLATE = 'No book with id "%d" found!';

    private function __construct(int $bookId)
    {
        parent::__construct(
            sprintf(self::MESSAGE_TEMPLATE, $bookId),
            1614439482
        );
    }

    public static function byBookId(int $bookId): self
    {
        return new self($bookId);
    }

    public function getStatus(): int
    {
        return 404;
    }

    /** @return array<int, array<string, string>>|null */
    public function getErrors(): ?array
    {
        return null;
    }
}
