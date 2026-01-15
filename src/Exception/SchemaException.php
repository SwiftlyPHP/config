<?php declare(strict_types=1);

namespace Swiftly\Config\Exception;

use LogicException;
use Swiftly\Config\ExceptionInterface;
use Swiftly\Config\Schema\AbstractNode;
use Swiftly\Config\Schema\IsConfigurableInterface;

use function basename;
use function lcfirst;
use function sprintf;
use function strtr;

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

    public static function unconfigurableNode(AbstractNode $node): self
    {
        return new self(sprintf(
            'Failed to configure node of type "%s" as it does not support being'
            . ' configured via array; it should be configured using a callback'
            . ' instead',
            self::nodeName($node),
        ));
    }

    /**
     * @internal
     */
    public static function invalidInheritanceOfConfigure(
        AbstractNode $node,
    ): self {
        return new self(sprintf(
            'Incorrect method call: calling "configure()" on node of type "%s"'
            . ' is unsupported; only nodes that implement "%s" may make use of'
            . ' the "configure()" method',
            $node::class,
            IsConfigurableInterface::class,
        ));
    }

    private static function nodeName(AbstractNode $node): string
    {
        $nodeName = strtr($node::class, '\\', '/');
        $nodeName = basename($nodeName, 'Node');
        $nodeName = lcfirst($nodeName);

        return $nodeName;
    }
}
