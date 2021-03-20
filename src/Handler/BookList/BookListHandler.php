<?php

declare(strict_types=1);

namespace App\Handler\BookList;

use App\Repository\BookRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class BookListHandler implements RequestHandlerInterface
{
    public const ALLOWED_SORT_BY_FIELDS = ['title', 'year'];
    public const ALLOWED_ORDERINGS = ['asc', 'desc'];

    public function __construct(
        private BookRepository $bookRepository
    ) {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $bookListRequest = $request->getAttribute(BookListRequest::class);
        assert($bookListRequest instanceof BookListRequest);

        $bookCount = $this->bookRepository->getNumberOfBooks();
        $books     = $this->bookRepository->getAll(
            $bookListRequest->getSortBy(),
            $bookListRequest->getOrder()
        );

        return BookListResponseFactory::create(
            $bookCount,
            $books
        );
    }
}
