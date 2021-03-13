<?php

declare(strict_types=1);

namespace App\Handler;

use App\Repository\BookRepository;
use App\Response\BookListResponseFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class BookListHandler implements RequestHandlerInterface
{
    public function __construct(
        private BookRepository $bookRepository
    ) {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $bookCount = $this->bookRepository->getNumberOfBooks();
        $books     = $this->bookRepository->getAll();

        return BookListResponseFactory::create(
            $bookCount,
            $books
        );
    }
}
