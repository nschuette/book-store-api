<?php

declare(strict_types=1);

namespace App\Handler\BookDetail;

use App\Dto\Author;
use App\Dto\Book;
use App\Dto\Genre;
use App\Dto\Price;
use Laminas\Diactoros\Response\JsonResponse;

class BookDetailResponseFactory
{
    public static function create(Book $book): JsonResponse
    {
        return new JsonResponse([
            'id'          => $book->getId(),
            'isbn'        => $book->getIsbn(),
            'author'      => self::formatAuthor($book->getAuthor()),
            'genre'       => self::formatGenre($book->getGenre()),
            'year'        => $book->getYear(),
            'description' => $book->getDescription(),
            'price'       => self::formatPrice($book->getPrice()),
            'links'       => [
                'list'    => self::formatLink('GET', '/api/books'),
                'reviews' => self::formatLink('GET', sprintf('/api/books/%d/reviews', $book->getId())),
            ],
        ]);
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
    private static function formatPrice(Price $price): array
    {
        return [
            'total'    => $price->getTotal(),
            'tax'      => $price->getTax(),
            'currency' => $price->getCurrency(),
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