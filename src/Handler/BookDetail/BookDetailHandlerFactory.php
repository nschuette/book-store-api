<?php

declare(strict_types=1);

namespace App\Handler\BookDetail;

use App\Repository\BookRepository;
use Psr\Container\ContainerInterface;

class BookDetailHandlerFactory
{
    public function __invoke(ContainerInterface $container): BookDetailHandler
    {
        return new BookDetailHandler(
            $container->get(BookRepository::class)
        );
    }
}
