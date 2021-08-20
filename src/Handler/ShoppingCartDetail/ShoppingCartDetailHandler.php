<?php

declare(strict_types=1);

namespace App\Handler\ShoppingCartDetail;

use App\Exception\ShoppingCartUnavailable;
use App\Repository\ShoppingCartItemRepository;
use App\Repository\ShoppingCartRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ShoppingCartDetailHandler implements RequestHandlerInterface
{
    public function __construct(
        private ShoppingCartRepository $shoppingCartRepository,
        private ShoppingCartItemRepository $shoppingCartItemRepository
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $shoppingCartId = (int) $request->getAttribute('shoppingCartId');

        $shoppingCart = $this->shoppingCartRepository->getById($shoppingCartId);
        if ($shoppingCart->isComplete() || $shoppingCart->isCanceled()) {
            throw ShoppingCartUnavailable::byShoppingCartId($shoppingCartId);
        }

        $shoppingCartItems = $this->shoppingCartItemRepository->getByShoppingCartId($shoppingCart->getId());

        return ShoppingCartDetailResponseFactory::create(
            $shoppingCart,
            $shoppingCartItems
        );
    }
}
