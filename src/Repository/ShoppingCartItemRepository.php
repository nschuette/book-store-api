<?php

declare(strict_types=1);

namespace App\Repository;

use App\Dto\Price;
use App\Dto\ShoppingCartItem;
use DateTimeImmutable;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Types\Types;

use function array_map;

final class ShoppingCartItemRepository
{
    public function __construct(
        private Connection $connection
    ) {
    }

    /** @return array<int, ShoppingCartItem> */
    public function getByShoppingCartId(int $shoppingCartId): array
    {
        $result = $this->connection->executeQuery(
            <<<'SQL'
                SELECT 
                    ci.id AS id,
                    ci.shopping_cart_id AS shopping_cart_id,
                    ci.book_id AS book_id,
                    ci.price AS price_total,
                    ci.tax AS price_tax,
                    ci.currency AS price_currency,
                    ci.quantity AS quantity,
                    ci.created_at AS created_at,
                    ci.updated_at AS updated_at
                FROM shopping_cart_items ci
                WHERE shopping_cart_id = :shoppingCartId
                SQL,
            ['shoppingCartId' => $shoppingCartId],
            ['shoppingCartId' => Types::INTEGER]
        );

        return array_map(
            static fn (array $row): ShoppingCartItem => self::mapResultToDto($row),
            $result->fetchAllAssociative(),
        );
    }

    /** @param mixed[] $result */
    private static function mapResultToDto(array $result): ShoppingCartItem
    {
        return new ShoppingCartItem(
            (int) $result['id'],
            (int) $result['shopping_cart_id'],
            (int) $result['book_id'],
            new Price(
                (float) $result['price_total'],
                (float) $result['price_tax'],
                $result['price_currency']
            ),
            (int) $result['quantity'],
            new DateTimeImmutable($result['created_at']),
            $result['updated_at'] !== null
                ? new DateTimeImmutable($result['updated_at'])
                : null
        );
    }
}
