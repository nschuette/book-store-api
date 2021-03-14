<?php

declare(strict_types=1);

namespace App\Handler\BookReviewList;

use App\Repository\BookRepository;
use App\Repository\BookReviewRepository;
use Psr\Container\ContainerInterface;

class BookReviewListHandlerFactory
{
    public function __invoke(ContainerInterface $container): BookReviewListHandler
    {
        return new BookReviewListHandler(
            $container->get(BookRepository::class),
            $container->get(BookReviewRepository::class)
        );
    }
}