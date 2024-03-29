<?php

declare(strict_types=1);

namespace App\Handler\BookList;

use App\Dto\Author;
use App\Dto\Book;
use App\Dto\Genre;
use App\Infrastructure\Util\MoneyUtil;
use Laminas\Diactoros\Response\JsonResponse;
use Money\Money;

use function array_map;
use function sprintf;

class BookListResponseFactory
{
    /** @param Book[] $books */
    public static function create(int $count, array $books): JsonResponse
    {
        return new JsonResponse([
            'books'         => array_map(
                static fn (Book $book): array => self::formatBook($book),
                $books
            ),
            'total_results' => $count,
        ]);
    }

    /** @return mixed[] */
    private static function formatBook(Book $book): array
    {
        return [
            'id'     => $book->getId(),
            'isbn'   => $book->getIsbn(),
            'title'  => $book->getTitle(),
            'author' => self::formatAuthor($book->getAuthor()),
            'genre'  => self::formatGenre($book->getGenre()),
            'year'   => $book->getYear(),
            'price'  => self::formatMoney($book->getPrice()),
            'tax'    => self::formatMoney($book->getTax()),
            'links'  => [
                'detail' => self::formatLink('GET', sprintf('/api/books/%d', $book->getId())),
            ],
        ];
    }

    /** @return mixed[] */
    private static function formatAuthor(Author $author): array
    {
        return [
            'id'        => $author->getId(),
            'firstname' => $author->getFirstname(),
            'lastname'  => $author->getLastname(),
        ];
    }

    /** @return mixed[] */
    private static function formatGenre(Genre $genre): array
    {
        return [
            'id'   => $genre->getId(),
            'name' => $genre->getName(),
        ];
    }

    /** @return mixed[] */
    private static function formatMoney(Money $money): array
    {
        return [
            'amount'   => MoneyUtil::formatToFloat($money),
            'currency' => $money->getCurrency()->getCode(),
        ];
    }

    /** @return mixed[] */
    private static function formatLink(string $method, string $href): array
    {
        return [
            'method' => $method,
            'href'   => $href,
        ];
    }
}
