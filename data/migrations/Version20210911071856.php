<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210911071856 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create book_reviews table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            <<<'SQL'
                CREATE TABLE book_reviews (
                    id int unsigned NOT NULL AUTO_INCREMENT,
                    book_id int unsigned NOT NULL,
                    rating tinyint unsigned NOT NULL,
                    name varchar(160) NOT NULL,
                    text tinytext NOT NULL,
                    created_at datetime NOT NULL,
                    PRIMARY KEY (id),
                    KEY book_id (book_id),
                    CONSTRAINT book_reviews_ibfk_1 FOREIGN KEY (book_id) REFERENCES books (id)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci  
                SQL
        );
    }
}
