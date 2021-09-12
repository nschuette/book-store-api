<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210911072429 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create shopping_carts table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            <<<'SQL'
                CREATE TABLE shopping_carts (
                    id int unsigned NOT NULL AUTO_INCREMENT,
                    status varchar(100) NOT NULL,
                    created_at datetime NOT NULL,
                    PRIMARY KEY (id)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci  
                SQL
        );
    }
}
