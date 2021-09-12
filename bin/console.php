<?php

declare(strict_types=1);

use Doctrine\DBAL\Connection;
use Doctrine\Migrations\Configuration\Connection\ExistingConnection;
use Doctrine\Migrations\Configuration\Migration\ConfigurationArray;
use Doctrine\Migrations\DependencyFactory;
use Psr\Container\ContainerInterface;
use Doctrine\Migrations\Tools\Console\Command;
use Symfony\Component\Console\Application;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

(function() {
    $container = require 'config/container.php';
    assert($container instanceof ContainerInterface);

    $config = $container->get('config');
    $migrationsConfig = $config['doctrine']['migrations'];

    $connection = $container->get(Connection::class);
    $dependencyFactory = DependencyFactory::fromConnection(
        new ConfigurationArray($migrationsConfig),
        new ExistingConnection($connection)
    );

    $console = new Application('Bookstore-API CLI');
    $console->setCatchExceptions(true);

    $console->addCommands([
        new Command\DumpSchemaCommand($dependencyFactory),
        new Command\ExecuteCommand($dependencyFactory),
        new Command\GenerateCommand($dependencyFactory),
        new Command\LatestCommand($dependencyFactory),
        new Command\ListCommand($dependencyFactory),
        new Command\MigrateCommand($dependencyFactory),
        new Command\RollupCommand($dependencyFactory),
        new Command\StatusCommand($dependencyFactory),
        new Command\SyncMetadataCommand($dependencyFactory),
        new Command\VersionCommand($dependencyFactory),
    ]);

    $console->run();
})();