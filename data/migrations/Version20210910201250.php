<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210910201250 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create books table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            <<<'SQL'
                CREATE TABLE books (
                    id int unsigned NOT NULL AUTO_INCREMENT,
                    isbn varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
                    title varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
                    author_id int unsigned NOT NULL,
                    genre_id int unsigned NOT NULL,
                    year smallint unsigned NOT NULL,
                    description text COLLATE utf8mb4_general_ci NOT NULL,
                    price varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
                    tax varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
                    PRIMARY KEY (id),
                    KEY author_id (author_id),
                    KEY genre_id (genre_id),
                    CONSTRAINT books_ibfk_1 FOREIGN KEY (author_id) REFERENCES authors (id) ON DELETE CASCADE ON UPDATE CASCADE,
                    CONSTRAINT books_ibfk_2 FOREIGN KEY (genre_id) REFERENCES genres (id) ON DELETE CASCADE ON UPDATE CASCADE
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci 
                SQL

        );
    }
}
