<?php

declare(strict_types=1);

namespace App;

use Laminas\ServiceManager\Factory\InvokableFactory;

class ConfigProvider
{
    /** @return mixed[] */
    public function __invoke(): array
    {
        return [
            'dependencies'  => $this->getDependencies(),
        ];
    }

    /** @return mixed[] */
    public function getDependencies(): array
    {
        return [
            'factories'  => [
                Handler\PingHandler::class => InvokableFactory::class,

                // Book list
                Handler\BookList\BookListRequestMiddleware::class => InvokableFactory::class,
                Handler\BookList\BookListHandler::class           => Handler\BookList\BookListHandlerFactory::class,

                // Book detail
                Handler\BookDetail\BookDetailHandler::class => Handler\BookDetail\BookDetailHandlerFactory::class,

                // Book review list
                Handler\BookReviewList\BookReviewListHandler::class => Handler\BookReviewList\BookReviewListHandlerFactory::class,

                // Create new cart
                Handler\CreateCart\CreateCartHandler::class => Handler\CreateCart\CreateCartHandlerFactory::class,

                // Cart detail
                Handler\CartDetail\CartDetailHandler::class => Handler\CartDetail\CartDetailHandlerFactory::class,
            ],
        ];
    }
}
