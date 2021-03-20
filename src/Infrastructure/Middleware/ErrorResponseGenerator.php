<?php

declare(strict_types=1);

namespace App\Infrastructure\Middleware;

use App\Exception\ErrorResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Throwable;

class ErrorResponseGenerator
{
    private const DEFAULT_STATUS = 500;
    private const DEFAULT_MESSAGE = 'Internal Server Error';

    public function __invoke(
        Throwable $throwable,
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        $status = $message = $errors = null;
        if ($throwable instanceof ErrorResponse) {
            $status  = $throwable->getStatus();
            $message = $throwable->getMessage();
            $errors  = $throwable->getErrors();
        }

        if ($status === null) {
            $status  = self::DEFAULT_STATUS;
            $message = self::DEFAULT_MESSAGE;
        }

        return new JsonResponse(array_filter([
            'timestamp' => time(),
            'status'    => $status,
            'message'   => $message,
            'errors'    => $errors,
        ]), $status);
    }
}