<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210910193453 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create authors table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            <<<'SQL'
                CREATE TABLE authors (
                    id int unsigned NOT NULL,
                    firstname varchar(80) COLLATE utf8mb4_general_ci NOT NULL,
                    lastname varchar(80) COLLATE utf8mb4_general_ci NOT NULL,
                    PRIMARY KEY (id)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
                SQL
        );
    }
}
