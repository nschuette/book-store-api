<?php

declare(strict_types=1);

namespace App\Handler\CreateShoppingCart;

use App\Repository\ShoppingCartRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CreateShoppingCartHandler implements RequestHandlerInterface
{
    public function __construct(
        private ShoppingCartRepository $shoppingCartRepository
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $shoppingCartId = $this->shoppingCartRepository->createNew();

        return CreateShoppingCartResponseFactory::create($shoppingCartId);
    }
}
