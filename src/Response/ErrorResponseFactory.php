<?php

declare(strict_types=1);

namespace App\Response;

use Exception;
use Laminas\Diactoros\Response\JsonResponse;
use Throwable;

use function time;

final class ErrorResponseFactory
{
    public static function createFromException(Exception|Throwable $exception, int $statusCode = 400): JsonResponse
    {
        return self::createResponse($statusCode, [
            [
                'code'    => $exception->getCode(),
                'message' => $exception->getMessage(),
            ]
        ]);
    }

    public static function createFromMessage(string $message, int $code, int $statusCode = 400): JsonResponse
    {
        return self::createResponse($statusCode, [
            [
                'code'    => $code,
                'message' => $message,
            ]
        ]);
    }

    /** @param mixed[] $errors */
    private static function createResponse(int $statusCode, array $errors): JsonResponse
    {
        return new JsonResponse([
            'timestamp' => time(),
            'status'    => $statusCode,
            'error'     => $errors,
        ], $statusCode);
    }
}
