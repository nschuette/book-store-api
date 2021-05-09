<?php

declare(strict_types=1);

use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use Psr\Container\ContainerInterface;

return static function (Application $app, MiddlewareFactory $factory, ContainerInterface $container): void {
    $app->get('/api/ping', App\Handler\PingHandler::class);

    $app->get(
        '/api/books',
        [
            App\Handler\BookList\BookListRequestMiddleware::class,
            App\Handler\BookList\BookListHandler::class,
        ]
    );

    $app->get(
        '/api/books/:bookId',
        [
            App\Handler\BookDetail\BookDetailHandler::class,
        ]
    );

    $app->get(
        '/api/books/:bookId/reviews',
        [
            App\Handler\BookReviewList\BookReviewListHandler::class,
        ]
    );

    $app->post(
        '/api/shopping_cart',
        [
            App\Handler\CreateShoppingCart\CreateShoppingCartHandler::class,
        ]
    );
    $app->get(
        '/api/shopping_cart/:shoppingCartId',
        [
            App\Handler\ShoppingCartDetail\ShoppingCartDetailHandler::class,
        ]
    );
};
