<?php

declare(strict_types=1);

namespace App\Handler\BookList;

use App\Repository\BookRepository;
use Psr\Container\ContainerInterface;

class BookListHandlerFactory
{
    public function __invoke(ContainerInterface $container): BookListHandler
    {
        return new BookListHandler(
            $container->get(BookRepository::class)
        );
    }
}