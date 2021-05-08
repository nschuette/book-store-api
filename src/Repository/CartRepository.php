<?php

declare(strict_types=1);

namespace App\Repository;

use App\Dto\Cart;
use App\Exception\CartNotFound;
use DateTimeImmutable;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Types\Types;

use function assert;
use function is_array;

final class CartRepository
{
    public function __construct(
        public Connection $connection
    ) {
    }

    public function getById(int $cartId): Cart
    {
        $result = $this->connection->executeQuery(
            <<<'SQL'
                SELECT
                    c.id as cart_id,
                    c.status AS status,
                    c.created_at AS created_at
                FROM carts c
                WHERE c.id = :cartId
                SQL,
            ['cartId' => $cartId],
            ['cartId' => Types::INTEGER]
        );

        if ($result->rowCount() === 0) {
            throw CartNotFound::byCartId($cartId);
        }

        $row = $result->fetchAssociative();
        assert(is_array($row) === true);

        return self::mapResultToDto($row);
    }

    public function createNew(): int
    {
        $this->connection->insert(
            'carts',
            [
                'status'     => 'created',
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
    private static function mapResultToDto(array $result): Cart
    {
        return new Cart(
            (int) $result['cart_id'],
            $result['status'],
            new DateTimeImmutable($result['created_at'])
        );
    }
}
