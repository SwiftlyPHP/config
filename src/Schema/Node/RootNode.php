<?php declare(strict_types=1);

namespace Swiftly\Config\Schema\Node;

use Swiftly\Config\Exception\SchemaException;

/**
 * @api
 *
 * @upgrade:php8.1 Use :never to type return value of `configure()`
 * @upgrade:php8.2 Use false to type return of `isOptional()`, `isNullable()`
 */
final class RootNode extends ObjectNode
{
    public function __construct()
    {
        parent::__construct('@');

        $this->nullable(false);
        $this->optional(false);
    }

    /**
     * {@inheritDoc}
     */
    public function isNullable(): bool
    {
        return false;
    }

    /**
     * {@inheritDoc}
     */
    public function isOptional(): bool
    {
        return false;
    }

    /**
     * {@inheritDoc}
     *
     * @throws SchemaException The root node cannot be configured
     */
    public function configure(array $config): void
    {
        throw SchemaException::rootNodeConfig();
    }
}
