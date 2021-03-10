<?php

declare(strict_types=1);

namespace App\Handler;

use App\Dto\Book;
use App\Repository\BookRepository;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

use function array_map;
use function sprintf;

class BookListHandler implements RequestHandlerInterface
{
    private BookRepository $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $numberOfBooks = $this->bookRepository->getNumberOfBooks();
        $books         = $this->bookRepository->getAll();

        return new JsonResponse([
            'count' => $numberOfBooks,
            'books' => array_map(
                static fn (Book $book): array => self::formatBook($book),
                $books
            ),
        ]);
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
            'price' => [
                'total' => $book->getPrice()->getTotal(),
                'tax'   => $book->getPrice()->getTax(),
                'currency' => $book->getPrice()->getCurrency(),
            ],
            'links' => [
                'detail' => [
                    'method' => 'GET',
                    'href' => sprintf('/api/books/%d', $book->getId()),
                ],
            ],
        ];
    }
}
