<?php

declare(strict_types=1);

namespace App\Infrastructure\Middleware;

class ErrorResponseGeneratorFactory
{
    public function __invoke(): ErrorResponseGenerator
    {
        return new ErrorResponseGenerator();
    }
}