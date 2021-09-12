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
        1 => 'Krimi',
        2 => 'Fantasy',
        3 => 'Science-Fiction',
        4 => 'Liebesromane',
        5 => 'Familienromane',
        6 => 'Reiseromane',
        7 => 'Thriller',
        8 => 'Sachbücher'
    ];

    public function getDescription(): string
    {
        return 'Insert some genres';
    }

    public function up(Schema $schema): void
    {
        foreach (self::GENRES as $id => $genre) {
            $this->addSql(
                <<<'SQL'
                    INSERT INTO genres
                    SET id   = :id,
                        name = :genre
                    SQL,
                [
                    'id'    => $id,
                    'genre' => $genre
                ],
                [
                    'id'    => Types::INTEGER,
                    'genre' => Types::STRING
                ]
            );
        }
    }
}
