<?php

declare(strict_types=1);

namespace App;

use App\Handler\PingHandler;
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
                Handler\PingHandler::class => static fn (ContainerInterface $container): PingHandler => new PingHandler(),
            ],
        ];
    }
}
