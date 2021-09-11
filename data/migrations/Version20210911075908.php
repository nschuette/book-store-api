<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210911075908 extends AbstractMigration
{
    private const GENRES = [
        'Krimi',
        'Fantasy',
        'Science-Fiction',
        'Liebesromane',
        'Familienromane',
        'Reiseromane',
        'Thriller',
        'Sachbücher'
    ];

    public function getDescription(): string
    {
        return 'Insert some genres';
    }

    public function up(Schema $schema): void
    {
        foreach (self::GENRES as $genre) {
            $this->addSql(
                <<<'SQL'
                    INSERT INTO genres
                    SET name = :genre
                    SQL,
                ['genre' => $genre],
                ['genre' => Types::STRING]
            );
        }
    }
}
