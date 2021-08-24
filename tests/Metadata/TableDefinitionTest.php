<?php

namespace MisterIcy\Sqthulhu\Tests\Metadata;

use MisterIcy\Sqlthulhu\Metadata\TableDefinition;
use MisterIcy\Sqthulhu\Tests\SqthulhuTestCase;
use PHPUnit\Framework\TestCase;

class TableDefinitionTest extends SqthulhuTestCase
{
    /**
     * @throws \MisterIcy\Sqlthulhu\Exception\MetadataException
     * @covers \MisterIcy\Sqlthulhu\Metadata\TableDefinition::create
     */
    public function testTableDefinitionCreation() : void
    {
        $stmt = static::$pdo->query(
            'SELECT * FROM information_schema.TABLES WHERE TABLE_SCHEMA="sqthulhu" AND TABLE_NAME="configuration"'
        );
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $definition = TableDefinition::create($result[0]);
        $this->assertNotNull($definition);
        $this->assertInstanceOf(TableDefinition::class, $definition);



    }
}