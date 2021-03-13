<?php

declare(strict_types=1);

use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use Psr\Container\ContainerInterface;

return static function (Application $app, MiddlewareFactory $factory, ContainerInterface $container): void {
    $app->get('/api/ping', App\Handler\PingHandler::class, 'api.ping');

    $app->get('/api/books', App\Handler\BookListHandler::class, 'api.books');
    $app->get('/api/books/:bookId', App\Handler\BookHandler::class, 'api.books.book');
    $app->get('/api/books/:bookId/reviews', App\Handler\BookReviewHandler::class, 'api.books.book.reviews');
};
