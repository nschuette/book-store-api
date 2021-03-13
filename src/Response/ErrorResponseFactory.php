<?php

declare(strict_types=1);

namespace App\Response;

use Laminas\Diactoros\Response\JsonResponse;
use Throwable;

use function time;

final class ErrorResponseFactory extends JsonResponse
{
    public static function createFromException(Throwable $exception, int $status = 400): self
    {
        return new self([
            'timestamp' => time(),
            'status'    => $status,
            'error'     => $exception->getMessage(),
        ], $status);
    }
}
