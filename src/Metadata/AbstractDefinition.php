<?php

declare(strict_types=1);

namespace MisterIcy\Sqlthulhu\Metadata;

/**
 * AbstractDefinition.
 *
 * @author Alexandros Koutroulis <icyd3mon@gmail.com>
 * @license Apache-2.0
 * @since 1.0
 * @version 1.0
 */
abstract class AbstractDefinition
{
    /**
     * The name of the object.
     *
     * @var string
     */
    private string $name;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    final public function getName(): string
    {
        return $this->name;
    }

    /**
     * Creates a definition from a Database Row.
     *
     * @param array $definition
     * @return static
     */
    abstract static function create(array $definition): self;

}