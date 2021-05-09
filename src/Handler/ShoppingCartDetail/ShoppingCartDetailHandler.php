<?php

declare(strict_types=1);

namespace App\Handler\ShoppingCartDetail;

use App\Repository\ShoppingCartRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ShoppingCartDetailHandler implements RequestHandlerInterface
{
    public function __construct(
        private ShoppingCartRepository $shoppingCartRepository
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $shoppingCartId = (int) $request->getAttribute('shoppingCartId');

        $shoppingCart = $this->shoppingCartRepository->getById($shoppingCartId);

        return ShoppingCartDetailResponseFactory::create($shoppingCart);
    }
}
