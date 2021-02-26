<?php

declare(strict_types=1);

namespace App\Handler;

use App\Query\GetBookList;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class BookListHandler implements RequestHandlerInterface
{
    private GetBookList $getBookListQuery;

    public function __construct(GetBookList $getBookListQuery)
    {
        $this->getBookListQuery = $getBookListQuery;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $books = $this->getBookListQuery->__invoke();

        return new JsonResponse(['books' => $books]);
    }
}
