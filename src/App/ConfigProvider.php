<?php

declare(strict_types=1);

namespace App;

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
            'invokables' => [
                Handler\PingHandler::class => Handler\PingHandler::class,
            ],
            'factories'  => [],
        ];
    }
}
