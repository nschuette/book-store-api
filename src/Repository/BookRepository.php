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

final class BookRepository
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
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

        return self::mapResultToDto(
            $result->fetchAssociative()
        );
    }

    /**
     * @return Book[]
     */
    public function getAll(): array
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
                SQL
        );

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

    /**
     * @param mixed[] $row
     */
    private static function mapResultToDto(array $row): Book
    {
        return new Book(
            (int) $row['book_id'],
            $row['isbn'],
            $row['title'],
            new Author(
                (int) $row['author_id'],
                $row['author_firstname'],
                $row['author_lastname']
            ),
            new Genre(
                (int) $row['genre_id'],
                $row['genre_name']
            ),
            (int) $row['year'],
            $row['description'],
            new Price(
                (float) $row['price_total'],
                (float) $row['price_tax'],
                $row['price_currency']
            )
        );
    }
}
