<?php

declare(strict_types=1);

namespace App\Query;

use App\Dto\Author;
use App\Dto\Book;
use App\Dto\Genre;
use App\Dto\Price;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;

final class GetBookList
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return Book[]
     *
     * @throws Exception
     */
    public function __invoke(): array
    {
        $result = $this->connection->executeQuery(
            <<<'SQL'
                SELECT 
                    b.id,
                    b.author_id,
                    a.firstname AS author_firstname,
                    a.lastname AS author_lastname,
                    b.genre_id,
                    g.name AS genre_name,
                    b.isbn,
                    b.title,
                    b.description,
                    b.year,
                    b.price,
                    b.tax,
                    b.currency
                FROM books b
                INNER JOIN authors a ON a.id = b.author_id
                INNEr JOIN genres g ON g.id = b.genre_id
                SQL
        );

        $books = [];
        foreach ($result->fetchAllAssociative() as $row) {
            $book = new Book(
                (int) $row['id'],
                new Author(
                    (int) $row['author_id'],
                    $row['author_firstname'],
                    $row['author_lastname']
                ),
                new Genre(
                    (int) $row['genre_id'],
                    $row['genre_name']
                ),
                $row['isbn'],
                $row['title'],
                $row['description'],
                (int) $row['year'],
                new Price(
                    (float) $row['price'],
                    (float) $row['tax'],
                    $row['currency']
                )
            );

            $books[] = $book;
        }

        return $books;
    }
}
