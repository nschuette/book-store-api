<?php

declare(strict_types=1);

namespace App\Migrations;

use App\Infrastructure\Util\MoneyUtil;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Money\Currency;
use Money\Money;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210911092641 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add an fake book';
    }

    public function up(Schema $schema): void
    {
        $price = new Money(3900, new Currency('EUR'));
        $tax   = new Money(100, new Currency('EUR'));

        $this->addSql(
            <<<'SQL'
                INSERT INTO books
                SET isbn        = '978-2-6074-7415-6',
                    title       = 'Wie erstelle ich eine REST-API mit Laminas Mezzio',
                    author_id   = 1, 
                    genre_id    = 8,
                    year        = 2021,
                    description = '',
                    price       = :price,
                    tax         = :tax
                SQL,
            [
                'price' => MoneyUtil::formatToString($price),
                'tax'   => MoneyUtil::formatToString($tax)
            ]
        );
    }
}
