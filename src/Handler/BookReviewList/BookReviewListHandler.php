<?php

declare(strict_types=1);

namespace App\Handler\BookReviewList;

use App\Repository\BookRepository;
use App\Repository\BookReviewRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class BookReviewListHandler implements RequestHandlerInterface
{
    public function __construct(
        private BookRepository $bookRepository,
        private BookReviewRepository $bookReviewRepository,
    ) {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $bookId = (int) $request->getAttribute('bookId');

        $book          = $this->bookRepository->getById($bookId);
        $ratingAverage = $this->bookReviewRepository->getAverageRatingByBookId($book->getId());
        $reviewCount   = $this->bookReviewRepository->getNumberOfReviewsByBookId($book->getId());
        $bookReviews   = $this->bookReviewRepository->getByBookId($book->getId());

        return BookReviewListResponseFactory::create(
            $ratingAverage,
            $reviewCount,
            $book,
            $bookReviews
        );
    }
}