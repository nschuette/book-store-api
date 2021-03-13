<?php

declare(strict_types=1);

namespace App\Handler;

use App\Exception\BookNotFound;
use App\Repository\BookRepository;
use App\Response\BookResponseFactory;
use App\Response\ErrorResponseFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class BookHandler implements RequestHandlerInterface
{
    public function __construct(
        private BookRepository $bookRepository
    ) {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $bookId = (int) $request->getAttribute('bookId');

        try {
            $book = $this->bookRepository->getById($bookId);
        } catch (BookNotFound $exception) {
            return ErrorResponseFactory::createFromException($exception, 404);
        }

        return BookResponseFactory::create($book);
    }
}
