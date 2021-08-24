<?php

declare(strict_types=1);

namespace MisterIcy\Sqlthulhu\Metadata;

use DateTime;
use MisterIcy\Sqlthulhu\Attributes\MetadataColumn;
use MisterIcy\Sqlthulhu\Exception\MetadataException;

final class TableDefinition extends AbstractDefinition
{
    public const TABLE_BASE_TABLE = 'BASE_TABLE';
    public const TABLE_VIEW = 'VIEW';
    public const TABLE_SYSTEM_VIEW = 'SYSTEM VIEW';

    public const ROW_FORMAT_FIXED = 'Fixed';
    public const ROW_FORMAT_DYNAMIC = 'Dynamic';
    public const ROW_FORMAT_COMPRESSED = 'Compressed';
    public const ROW_FORMAT_REDUNDANT = 'Redundant';
    public const ROW_FORMAT_COMPACT = 'Compact';

    /**
     * The name of the schema to which the table belongs.
     *
     * @var string
     */
    #[MetadataColumn('TABLE_SCHEMA')]
    private string $schema;

    /**
     * The type of the table.
     *
     * @var string
     */
    private string $tableType;

    /**
     * Database Engine.
     *
     * @var string
     */
    private string $engine;

    /**
     * The row-storage format.
     * @var string
     */
    private string $rowFormat;

    /**
     * The number of rows stored in the table.
     *
     * @var int|null
     */
    private ?int $tableRows;

    private int $dataLength;

    private int $maxDataLength;

    private int $indexLength;

    private int $dataFree;

    private int $autoIncrement;

    private ?DateTime $createTime;
    private ?DateTime $updateTime;
    private ?DateTime $checkTime;

    private string $tableCollation;
    private ?string $checksum;

    public static function create(array $definition): AbstractDefinition
    {
        if (empty($definition)) {
            throw new MetadataException('The supplied definition is empty');
        }

        if (!array_key_exists('TABLE_NAME', $definition) ||
            !array_key_exists('TABLE_COLLATION', $definition)) {
            throw new MetadataException('The supplied definition is invalid');
        }

        $def = new self('');

        $reflectionClass = new \ReflectionClass(self::class);
        foreach ($reflectionClass->getProperties() as $property) {
            foreach ($property->getAttributes() as $attribute) {
                if ($attribute->getName() === MetadataColumn::class) {
                    /** @var MetadataColumn $metaColumn */
                    $metaColumn = $attribute->newInstance();
                    if (!array_key_exists($metaColumn->columnName, $definition)) {
                        continue;
                    }

                    $value = $definition[$metaColumn->columnName];
                    $value = match ($metaColumn->type) {
                        MetadataColumn::TYPE_INT => intval($value),
                        MetadataColumn::TYPE_FLOAT => floatval($value),
                        default => strval($value),
                    };
                    $property->setAccessible(true);
                    $property->setValue($def, $value);
                }
            }
        }
        return $def;
    }

}