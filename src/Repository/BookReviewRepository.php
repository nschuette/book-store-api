<?php

declare(strict_types=1);

namespace App\Repository;

use App\Dto\BookReview;
use DateTimeImmutable;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Types\Types;

use function array_map;

final class BookReviewRepository
{
    public function __construct(
        private Connection $connection
    ) {}

    /** @return array<int, BookReview> */
    public function getByBookId(int $bookId): array
    {
        $result = $this->connection->executeQuery(
            <<<'SQL'
                SELECT 
                    br.id AS book_review_id,
                    br.book_id AS book_id,
                    br.rating AS rating,
                    br.name AS name,
                    br.text AS text,
                    br.created_at AS created_at
                FROM book_reviews br
                WHERE br.book_id = :bookId
                SQL,
            ['bookId' => $bookId],
            ['bookId' => Types::INTEGER]
        );

        return array_map(
            static fn (array $row): BookReview => self::mapResultToDto($row),
            $result->fetchAllAssociative()
        );
    }

    public function getAverageRatingByBookId(int $bookId): float
    {
        $result = $this->connection->executeQuery(
            <<<'SQL'
                SELECT AVG(br.rating)
                FROM book_reviews br
                WHERE br.book_id = :bookId
                SQL,
            ['bookId' => $bookId],
            ['bookId' => Types::INTEGER]
        );

        return (float) $result->fetchOne();
    }

    public function getNumberOfReviewsByBookId(int $bookId): int
    {
        $result = $this->connection->executeQuery(
            <<<'SQL'
                SELECT COUNT(1)
                FROM book_reviews br
                WHERE br.book_id = :bookId
                SQL,
            ['bookId' => $bookId],
            ['bookId' => Types::INTEGER]
        );

        return (int) $result->fetchOne();
    }

    /** @param mixed[] $result */
    private static function mapResultToDto(array $result): BookReview
    {
        return new BookReview(
            (int) $result['book_review_id'],
            (int) $result['book_id'],
            (int) $result['rating'],
            $result['name'],
            $result['text'],
            new DateTimeImmutable($result['created_at'])
        );
    }
}
