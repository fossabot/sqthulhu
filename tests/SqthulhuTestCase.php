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
            'mysql:host=%s;charset=%s',
            $_ENV['TEST_DB_HOST'],
            'utf8mb4'
        );

        static::$pdo = new PDO(
            $dsn,
            $_ENV['TEST_DB_USER'],
            isset($_ENV['TEST_DB_PASSWORD']) ? $_ENV['TEST_DB_PASSWORD'] : null
        );

        static::$pdo->exec('CREATE DATABASE IF NOT EXISTS sqthulhu');
        static::$pdo->exec('USE sqthulhu');
        static::createTables();
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