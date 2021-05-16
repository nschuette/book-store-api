<?php

declare(strict_types=1);

namespace App\Handler\ShoppingCartDetail;

use App\Dto\ShoppingCart;
use App\Dto\ShoppingCartItem;
use App\Infrastructure\Util\MoneyUtil;
use Laminas\Diactoros\Response\JsonResponse;
use Money\Currency;
use Money\Money;

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
            'price'    => self::formatMoney($shoppingCartItem->getPrice()),
            'tax'      => self::formatMoney($shoppingCartItem->getTax()),
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
            static function (Money $sum, ShoppingCartItem $shoppingCartItem): Money {
                return $sum->add($shoppingCartItem->getPrice()->multiply($shoppingCartItem->getQuantity()));
            },
            new Money(0, new Currency('EUR'))
        );

        $tax = array_reduce(
            $shoppingCartItems,
            static function (Money $sum, ShoppingCartItem $shoppingCartItem): Money {
                return $sum->add($shoppingCartItem->getTax()->multiply($shoppingCartItem->getQuantity()));
            },
            new Money(0, new Currency('EUR'))
        );

        return [
            'price' => self::formatMoney($price),
            'tax'   => self::formatMoney($tax),
        ];
    }

    /** @return mixed[] */
    private static function formatMoney(Money $money): array
    {
        return [
            'amount'   => MoneyUtil::formatToFloat($money),
            'currency' => $money->getCurrency()->getCode(),
        ];
    }
}
