<?php

declare(strict_types=1);

namespace App\Handler\BookDetail;

use App\Repository\BookRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class BookDetailHandler implements RequestHandlerInterface
{
    public function __construct(
        private BookRepository $bookRepository
    ) {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $bookId = (int) $request->getAttribute('bookId');

        $book = $this->bookRepository->getById($bookId);

        return BookDetailResponseFactory::create($book);
    }
}