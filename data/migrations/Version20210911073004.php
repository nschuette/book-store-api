<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210911073004 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create shopping_cart_items table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            <<<'SQL'
                CREATE TABLE shopping_cart_items (
                    id int unsigned NOT NULL AUTO_INCREMENT,
                    shopping_cart_id int unsigned NOT NULL,
                    book_id int unsigned NOT NULL,
                    price varchar(20) NOT NULL,
                    tax varchar(20) NOT NULL,
                    quantity tinyint unsigned NOT NULL,
                    created_at datetime NOT NULL,
                    updated_at datetime NOT NULL,
                    PRIMARY KEY (id),
                    KEY shopping_cart_id (shopping_cart_id),
                    KEY book_id (book_id),
                    CONSTRAINT shopping_cart_items_ibfk_1 FOREIGN KEY (shopping_cart_id) REFERENCES shopping_carts (id),
                    CONSTRAINT shopping_cart_items_ibfk_2 FOREIGN KEY (book_id) REFERENCES books (id)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci  
                SQL
        );
    }
}
