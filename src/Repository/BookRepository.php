<?php

declare(strict_types=1);

namespace App\Repository;

use App\Dto\Author;
use App\Dto\Book;
use App\Dto\Genre;
use App\Dto\Price;
use App\Exception\BookNotFound;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Types\Types;

use function array_map;
use function assert;
use function is_array;

final class BookRepository
{
    public function __construct(
        private Connection $connection
    ) {
    }

    public function getById(int $bookId): Book
    {
        $result = $this->connection->executeQuery(
            <<<'SQL'
                SELECT 
                    b.id AS book_id,
                    b.isbn AS isbn,
                    b.title AS title,
                    a.id AS author_id,
                    a.firstname AS author_firstname,
                    a.lastname AS author_lastname,
                    g.id AS genre_id,
                    g.name AS genre_name,
                    b.year AS year,
                    b.description AS description,
                    b.price AS price_total,
                    b.tax AS price_tax,
                    b.currency AS price_currency
                FROM books b
                INNER JOIN authors a ON a.id = b.author_id
                INNER JOIN genres g ON g.id = b.genre_id
                WHERE b.id = :bookId
                SQL,
            ['bookId' => $bookId],
            ['bookId' => Types::INTEGER]
        );

        if ($result->rowCount() === 0) {
            throw BookNotFound::byBookId($bookId);
        }

        $row = $result->fetchAssociative();
        assert(is_array($row) === true);

        return self::mapResultToDto($row);
    }

    /** @return array<int, Book> */
    public function getAll(?string $sortBy, string $order): array
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder->select([
            'b.id AS book_id',
            'b.isbn AS isbn',
            'b.title AS title',
            'a.id AS author_id',
            'a.firstname AS author_firstname',
            'a.lastname AS author_lastname',
            'g.id AS genre_id',
            'g.name AS genre_name',
            'b.year AS year',
            'b.description AS description',
            'b.price AS price_total',
            'b.tax AS price_tax',
            'b.currency AS price_currency',
        ]);
        $queryBuilder->from('books', 'b');
        $queryBuilder->innerJoin('b', 'authors', 'a', 'a.id = b.author_id');
        $queryBuilder->innerJoin('b', 'genres', 'g', 'g.id = b.genre_id');

        if ($sortBy !== null) {
            $queryBuilder->orderBy($sortBy, $order);
        }

        $result = $queryBuilder->executeQuery();

        return array_map(
            static fn (array $row): Book => self::mapResultToDto($row),
            $result->fetchAllAssociative()
        );
    }

    public function getNumberOfBooks(): int
    {
        $result = $this->connection->executeQuery(
            <<<'SQL'
                    SELECT COUNT(1)
                    FROM books
                    SQL
        );

        return (int) $result->fetchOne();
    }

    /** @param mixed[] $result */
    private static function mapResultToDto(array $result): Book
    {
        return new Book(
            (int) $result['book_id'],
            $result['isbn'],
            $result['title'],
            new Author(
                (int) $result['author_id'],
                $result['author_firstname'],
                $result['author_lastname']
            ),
            new Genre(
                (int) $result['genre_id'],
                $result['genre_name']
            ),
            (int) $result['year'],
            $result['description'],
            new Price(
                (float) $result['price_total'],
                (float) $result['price_tax'],
                $result['price_currency']
            )
        );
    }
}
