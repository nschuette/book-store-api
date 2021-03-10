<?php

declare(strict_types=1);

namespace App;

use App\Handler\BookHandler;
use App\Handler\BookListHandler;
use App\Handler\PingHandler;
use App\Repository\BookRepository;
use Psr\Container\ContainerInterface;

class ConfigProvider
{
    /** @return mixed[] */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
        ];
    }

    /** @return mixed[] */
    public function getDependencies(): array
    {
        return [
            'factories'  => [
                Handler\PingHandler::class => static function (ContainerInterface $container): PingHandler {
                    return new PingHandler();
                },

                Handler\BookListHandler::class => static function (ContainerInterface $container): BookListHandler {
                    return new BookListHandler(
                        $container->get(BookRepository::class)
                    );
                },

                Handler\BookHandler::class => static function (ContainerInterface $container): BookHandler {
                    return new BookHandler(
                        $container->get(BookRepository::class),
                    );
                },
            ],
        ];
    }
}
