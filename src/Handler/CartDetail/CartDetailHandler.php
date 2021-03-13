<?php

declare(strict_types=1);

namespace App\Handler\CartDetail;

use App\Repository\CartRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CartDetailHandler implements RequestHandlerInterface
{
    public function __construct(
        private CartRepository $cartRepository
    ) {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $cartId = (int) $request->getAttribute('cartId');

        $cart = $this->cartRepository->getById($cartId);

        return CartDetailResponseFactory::create($cart);
    }
}