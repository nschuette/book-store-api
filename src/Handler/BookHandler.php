<?php

declare(strict_types=1);

namespace App\Handler;

use App\Dto\Book;
use App\Exception\BookNotFound;
use App\Repository\BookRepository;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

use function time;

class BookHandler implements RequestHandlerInterface
{
    private BookRepository $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $bookId = (int) $request->getAttribute('bookId');

        try {
            $book = $this->bookRepository->getById($bookId);
        } catch (BookNotFound $exception) {
            return new JsonResponse([
                'timestamp' => time(),
                'status'    => 404,
                'error'     => $exception->getMessage(),
            ], 404);
        }

        return new JsonResponse(
            self::formatBook($book)
        );
    }

    /**
     * @return mixed[]
     */
    private static function formatBook(Book $book): array
    {
        return [
            'id' => $book->getId(),
            'isbn' => $book->getIsbn(),
            'title' => $book->getTitle(),
            'author' => [
                'id' => $book->getAuthor()->getId(),
                'firstname' => $book->getAuthor()->getFirstname(),
                'lastname' => $book->getAuthor()->getLastname(),
            ],
            'genre' => [
                'id' => $book->getGenre()->getId(),
                'name' => $book->getGenre()->getName(),
            ],
            'year' => $book->getYear(),
            'description' => $book->getDescription(),
            'price' => [
                'total' => $book->getPrice()->getTotal(),
                'tax'   => $book->getPrice()->getTax(),
                'currency' => $book->getPrice()->getCurrency(),
            ],
            'links' => [
                'list' => [
                    'method' => 'GET',
                    'href' => '/api/books',
                ],
            ],
        ];
    }
}
