<?php

declare(strict_types=1);

namespace App\Migrations;

use App\Infrastructure\Util\MoneyUtil;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;
use Money\Currency;
use Money\Money;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210911092641 extends AbstractMigration
{
    private const BOOKS = [
        [
            'isbn'        => '978-2-6074-7415-6',
            'title'       => 'Wie entwickle ich eine REST-API mit Laminas Mezzio',
            'authorId'    => 1,
            'genreId'     => 8,
            'year'        => 2021,
            'description' => 'Das Buch bietet eine theoretisch fundierte, vor allem aber praxistaugliche Anleitung zum ' .
                'professionellen Einsatz von RESTful HTTP. Es beschreibt den Architekturstil REST ' .
                '(Representational State Transfer) und seine Umsetzung im Rahmen der Protokolle des World Wide Web ' .
                '(HTTP, URIs und andere). Es wird gezeigt, wie man klassische Webanwendungen und Webservices so entwirft, ' .
                'dass sie im Einklang mit den Grundprinzipien des Web stehen und seine vielen Vorteile ausnutzen. ' .
                'Nach einer kurzen Einleitung, die die Grundprinzipien vermittelt (Ressourcen, Repräsentationen, ' .
                'Hyperlinks, Content Negotiation), wird ein vollständiges praktisches Beispiel vorgestellt. Danach ' .
                'werden die einzelnen Konzepte sowie fortgeschrittene Themen wie Caching, Dokumentation und Sicherheit ' .
                'detailliert betrachtet. Schließlich wird eine erweiterte Form der Beispielanwendung entwickelt, um die ' .
                'Umsetzung der fortgeschrittenen Konzepte zu demonstrieren. Inzwischen etablierte Best Practices zu Entwurf ' .
                'und Implementierung werden in einem eigenen Kapitel beschrieben und diskutiert.',
            'priceInEuro' => 2900,
            'taxInEuro'   => 203,
        ],
        [
            'isbn'  => '978-3-548-23410-6',
            'title' => '1984',
            'authorId' => 2,
            'genreId' => 3,
            'year' => 1949,
            'description' => 'Im April des Jahres 1984 führt Winston Smith ein ödes und tristes Leben in London, ' .
                'einer düsteren Stadt im totalitären Staate Ozeanien, in der alle permanent vom Großen Bruder beobachtet ' .
                'und jeder Schritt und jedes Wort von der Gedankenpolizei überwacht werden. Winston, ein Mitglied der ' .
                'äußeren Partei, verbringt seine Tage damit, im Ministerium für Wahrheit die Geschichte so umzuschreiben, ' .
                'wie es die Regierung verfügt. Äußerlich angepasst, brodelt in ihm ein tiefer Hass gegen die Partei und ' .
                'das Regime, weil die Kluft zwischen der Propaganda, die er tagtäglich verfassen muss, und Realität, ' .
                'die er erlebt, zu groß ist. Ist er der einzige Mensch in diesem Staat, dessen Gedächtnis noch ' .
                'funktioniert und der bemerkt, dass die Partei alles zu ihren Gunsten manipuliert? Als er in Julia ' .
                'nicht nur seine große Liebe, sondern auch eine Gleichgesinnte findet, fasst er den Mut, mit ihr ' .
                'gemeinsam der geheimen Organisation der Bruderschaft beizutreten, die sich der Zerstörung der Partei ' .
                'verschrieben hat. Aber das stets wachsame System duldet keine Opposition, und auch an vermeintlich ' .
                'sicheren Orten lauert die totale Überwachung. Wird ihm die Gehirnwäsche oder gar die Vaporisierung ' .
                'drohen, die der Große Bruder für Andersdenkende und Regimegegner bereithält? George Orwells Dystopie ' .
                '1984 hat auch über 70 Jahre nach ihrer Erstveröffentlichung nichts von ihrer Brisanz und Aktualität ' .
                'verloren. Seine albtraumhafte Vision des totalitären Überwachungsstaats Ozeanien, in dem die Menschen ' .
                'unter ständiger Überwachung durch eine allwissende Regierung leben, ist heute relevanter denn ' .
                'eh und je.',
            'priceInEuro' => 2900,
            'taxInEuro'   => 203,
        ],
    ];

    public function getDescription(): string
    {
        return 'Add an fake book';
    }

    public function up(Schema $schema): void
    {
        foreach (self::BOOKS as $book) {
            $price = new Money($book['priceInEuro'], new Currency('EUR'));
            $tax   = new Money($book['taxInEuro'], new Currency('EUR'));

            $this->addSql(
                <<<'SQL'
                INSERT INTO books
                SET isbn        = :isbn,
                    title       = :title,
                    author_id   = :authorId, 
                    genre_id    = :genreId,
                    year        = :year,
                    description = :description,
                    price       = :price,
                    tax         = :tax
                SQL,
                [
                    'isbn'        => $book['isbn'],
                    'title'       => $book['title'],
                    'authorId'    => $book['authorId'],
                    'genreId'     => $book['genreId'],
                    'year'        => $book['year'],
                    'description' => $book['description'],
                    'price'       => MoneyUtil::formatToString($price),
                    'tax'         => MoneyUtil::formatToString($tax),$book['year']
                ],
                [
                    'isbn'        => Types::STRING,
                    'title'       => Types::STRING,
                    'authorId'    => Types::INTEGER,
                    'genreId'     => Types::INTEGER,
                    'year'        => Types::INTEGER,
                    'description' => Types::STRING,
                    'price'       => Types::STRING,
                    'tax'         => Types::STRING,
                ]
            );
        }
    }
}
