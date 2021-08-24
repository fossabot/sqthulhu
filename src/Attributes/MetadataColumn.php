<?php

declare(strict_types=1);

namespace MisterIcy\Sqlthulhu\Attributes;

use Attribute;

/**
 * Class MetadataColumn.
 *
 * Annotates a Metadata Property in order to populate it.
 *
 * @author Alexandros Koutroulis <icyd3mon@gmail.com>
 * @license Apache-2.0
 * @since 1.0
 * @package MisterIcy\Sqthulhu\Attributes
 */
#[Attribute]
class MetadataColumn
{
    public const TYPE_STRING = 0;
    public const TYPE_INT = 1;
    public const TYPE_FLOAT = 2;
    public const TYPE_DATETIME = 3;

    /**
     * The name of the column as it is returned from the Information Schema query.
     * @var string
     */
    public string $columnName;
    /**
     * @var int The type of the value
     */
    public int $type;
    /**
     * Can take a null value
     * @var bool
     */
    public bool $nullable;

    /**
     * @param string $columnName
     * @param int $type
     * @param bool $nullable
     */
    public function __construct(
        string $columnName,
        int $type = self::TYPE_STRING,
        bool $nullable = false
    ) {
        $this->columnName = $columnName;
        $this->type = $type;
        $this->nullable = $nullable;
    }
}