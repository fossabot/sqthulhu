<?php

namespace MisterIcy\Sqthulhu\Tests;

use PDO;
use PHPUnit\Framework\TestCase;

class SqthulhuTestCase extends TestCase
{
    protected static PDO $pdo;
    public static function setUpBeforeClass(): void
    {
        $dsn = sprintf(
            'mysql:host=%s;dbname=%s;charset=%s',
            $_ENV['TEST_DB_HOST'],
            $_ENV['TEST_DB_SCHEMA'],
            'utf8mb4'
        );

        static::$pdo = new PDO($dsn, $_ENV['TEST_DB_USER'], $_ENV['TEST_DB_PASSWORD']);



    }
    private static function createTables(): void
    {
        $query = <<<SQL
CREATE TABLE IF NOT EXISTS `configuration` (
    `name` varchar(100) not null primary key,
    `value` mediumtext null default null
);
SQL;
        static::$pdo->exec($query);
    }

}