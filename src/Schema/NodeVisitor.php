<?php declare(strict_types=1);

namespace Swiftly\Config\Schema;

/**
 * @internal
 */
abstract class NodeVisitor
{
    /**
     * @param array<string, AbstractNode> $nodes
     * @param callable(AbstractNode, string):void $callback
     */
    final public static function walkNodes(
        TreeDepth $depth,
        array $nodes,
        callable $callback,
    ): void {
        foreach ($nodes as $node) {
            $depth->enter($node->getKey());

            $callback($node, $depth->toString());

            if ($node instanceof HasPropertiesInterface) {
                self::walkNodes($depth, $node->getProperties(), $callback);
            }

            $depth->exit();
        }
    }
}
