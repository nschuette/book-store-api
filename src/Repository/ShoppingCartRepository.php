<?php

declare(strict_types=1);

namespace App\Repository;

use App\Dto\ShoppingCart;
use App\Exception\ShoppingCartNotFound;
use DateTimeImmutable;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Types\Types;

use function assert;
use function is_array;

final class ShoppingCartRepository
{
    public function __construct(
        public Connection $connection
    ) {
    }

    public function getById(int $shoppingCartId): ShoppingCart
    {
        $result = $this->connection->executeQuery(
            <<<'SQL'
                SELECT
                    c.id as shopping_cart_id,
                    c.status AS status,
                    c.created_at AS created_at
                FROM shopping_carts c
                WHERE c.id = :shoppingCartId
                SQL,
            ['shoppingCartId' => $shoppingCartId],
            ['shoppingCartId' => Types::INTEGER]
        );

        if ($result->rowCount() === 0) {
            throw ShoppingCartNotFound::byShoppingCartId($shoppingCartId);
        }

        $row = $result->fetchAssociative();
        assert(is_array($row) === true);

        return self::mapResultToDto($row);
    }

    public function createNew(): int
    {
        $this->connection->insert(
            'shopping_carts',
            [
                'status'     => ShoppingCart::STATUS_CREATED,
                'created_at' => new DateTimeImmutable('now'),
            ],
            [
                'status'     => Types::STRING,
                'created_at' => Types::DATETIME_IMMUTABLE,
            ]
        );

        return (int) $this->connection->lastInsertId();
    }

    /** @param mixed[] $result */
    private static function mapResultToDto(array $result): ShoppingCart
    {
        return new ShoppingCart(
            (int) $result['shopping_cart_id'],
            $result['status'],
            new DateTimeImmutable($result['created_at'])
        );
    }
}
