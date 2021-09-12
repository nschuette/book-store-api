<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210911080428 extends AbstractMigration
{
    private const AUTHORS = [
        [
            'id'        => 1,
            'firstname' => 'John',
            'lastname'  => 'Doe',
        ],
        [
            'id'        => 2,
            'firstname' => 'George',
            'lastname'  => 'Orwell'
        ],
        [
            'id'        => 3,
            'firstname' => 'Stephen',
            'lastname'  => 'King',
        ]
    ];

    public function getDescription(): string
    {
        return 'Insert authors';
    }

    public function up(Schema $schema): void
    {
        foreach (self::AUTHORS as $author) {
            $this->addSql(
                <<<'SQL'
                    INSERT INTO authors 
                    SET id        = :id,
                        firstname = :firstname,
                        lastname  = :lastname
                    SQL,
                [
                    'id'        => $author['id'],
                    'firstname' => $author['firstname'],
                    'lastname'  => $author['lastname'],
                ],
                [
                    'id'        => Types::INTEGER,
                    'firstname' => Types::STRING,
                    'lastname'  => Types::STRING,
                ]
            );
        }
    }
}
