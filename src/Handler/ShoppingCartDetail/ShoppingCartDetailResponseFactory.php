<?php

declare(strict_types=1);

namespace App\Handler\ShoppingCartDetail;

use App\Dto\ShoppingCart;
use App\Dto\ShoppingCartItem;
use Laminas\Diactoros\Response\JsonResponse;

use function array_map;
use function array_reduce;

class ShoppingCartDetailResponseFactory
{
    /** @param ShoppingCartItem[] $shoppingCartItems */
    public static function create(ShoppingCart $shoppingCart, array $shoppingCartItems): JsonResponse
    {
        return new JsonResponse([
            'shopping_cart_id'     => $shoppingCart->getId(),
            'shopping_cart_status' => $shoppingCart->getStatus(),
            'items'                => array_map(
                static fn (ShoppingCartItem $shoppingCartItem): array => self::formatShoppingCartItem($shoppingCartItem),
                $shoppingCartItems
            ),
            'total'                => self::formatTotal($shoppingCartItems),
        ]);
    }

    /** @return mixed[] */
    private static function formatShoppingCartItem(ShoppingCartItem $shoppingCartItem): array
    {
        return [
            'book_id'  => $shoppingCartItem->getBookId(),
            'quantity' => $shoppingCartItem->getQuantity(),
            'price'    => self::formatMoney(
                $shoppingCartItem->getPrice()->getTotal(),
                $shoppingCartItem->getPrice()->getCurrency()
            ),
            'tax'      => self::formatMoney(
                $shoppingCartItem->getPrice()->getTax(),
                $shoppingCartItem->getPrice()->getCurrency()
            ),
        ];
    }

    /**
     * @param ShoppingCartItem[] $shoppingCartItems
     *
     * @return mixed[][]
     */
    private static function formatTotal(array $shoppingCartItems): array
    {
        $price = array_reduce(
            $shoppingCartItems,
            static function (float $sum, ShoppingCartItem $shoppingCartItem): float {
                return $sum += $shoppingCartItem->getPrice()->getTotal() * $shoppingCartItem->getQuantity();
            },
            0.00
        );

        $tax = array_reduce(
            $shoppingCartItems,
            static function (float $sum, ShoppingCartItem $shoppingCartItem): float {
                return $sum += $shoppingCartItem->getPrice()->getTax() * $shoppingCartItem->getQuantity();
            },
            0.00
        );

        return [
            'price' => self::formatMoney($price, 'EUR'),
            'tax'   => self::formatMoney($tax, 'EUR'),
        ];
    }

    /** @return mixed[] */
    private static function formatMoney(float $amount, string $currency): array
    {
        return [
            'amount'   => $amount,
            'currency' => $currency,
        ];
    }
}
