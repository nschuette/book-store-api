<?php

declare(strict_types=1);

namespace App\Handler\CreateCart;

use App\Repository\CartRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CreateCartHandler implements RequestHandlerInterface
{
    public function __construct(
        private CartRepository $cartRepository
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $cartId = $this->cartRepository->createNew();

        return CreateCartResponseFactory::create($cartId);
    }
}
