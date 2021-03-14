<?php

declare(strict_types=1);

namespace App\Handler\BookReviewList;

use App\Dto\Book;
use App\Dto\BookReview;
use Laminas\Diactoros\Response\JsonResponse;

use function array_map;
use function sprintf;

use const DATE_ATOM;

class BookReviewListResponseFactory
{
    /** @param BookReview[] $bookReviews */
    public static function create(float $averageRating, int $count, Book $book, array $bookReviews): JsonResponse
    {
        return new JsonResponse([
            'average' => $averageRating,
            'count'   => $count,
            'reviews' => array_map(
                static fn (BookReview $bookReview): array => self::formatReviews($bookReview),
                $bookReviews
            ),
            'links'   => [
                'detail' => self::formatLink('GET', sprintf('/api/books/%d', $book->getId())),
            ],
        ]);
    }

    /** @return mixed[] */
    private static function formatReviews(BookReview $bookReview): array
    {
        return [
            'id'         => $bookReview->getId(),
            'rating'     => $bookReview->getRating(),
            'name'       => $bookReview->getName(),
            'text'       => $bookReview->getText(),
            'created_at' => $bookReview->getCreatedAt()->format(DATE_ATOM),
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