<?php

declare(strict_types=1);

namespace App\Handler;

use App\Exception\BookNotFound;
use App\Repository\BookRepository;
use App\Repository\BookReviewRepository;
use App\Response\BookReviewResponseFactory;
use App\Response\ErrorResponseFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class BookReviewHandler implements RequestHandlerInterface
{
    public function __construct(
        private BookRepository $bookRepository,
        private BookReviewRepository $bookReviewRepository,
    ) {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $bookId = (int) $request->getAttribute('bookId');

        try {
            $book = $this->bookRepository->getById($bookId);
        } catch (BookNotFound $exception) {
            return ErrorResponseFactory::createFromException($exception, 404);
        }

        $ratingAverage = $this->bookReviewRepository->getAverageRatingByBookId($book->getId());
        $reviewCount   = $this->bookReviewRepository->getNumberOfReviewsByBookId($book->getId());
        $bookReviews   = $this->bookReviewRepository->getByBookId($book->getId());

        return BookReviewResponseFactory::create(
            $ratingAverage,
            $reviewCount,
            $book,
            $bookReviews
        );
    }
}
