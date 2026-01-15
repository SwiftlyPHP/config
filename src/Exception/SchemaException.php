<?php declare(strict_types=1);

namespace Swiftly\Config\Exception;

use LogicException;
use Swiftly\Config\ExceptionInterface;

/**
 * @api
 */
final class SchemaException extends LogicException implements ExceptionInterface
{
    public static function rootNodeConfig(): self
    {
        return new self(
            'Invalid method call: calling "configure()" on the root node of a'
            . ' schema is unsupported, the top-most node should only be used'
            . ' to define properties',
        );
    }
}
