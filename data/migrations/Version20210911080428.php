<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210911080428 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Insert an fake author named John Doe';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            <<<'SQL'
                INSERT INTO authors
                SET firstname = 'John',
                    lastname  = 'Doe'
                SQL
        );
    }
}
