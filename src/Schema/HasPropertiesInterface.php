<?php declare(strict_types=1);

namespace Swiftly\Config\Schema;

/**
 * @internal
 */
interface HasPropertiesInterface
{
    /**
     * @template T of AbstractNode
     *
     * @param non-empty-string $key
     * @param T $node
     * @param null|array<string, mixed>|callable(T):void $config
     *
     * @return $this
     */
    public function property(
        string $key,
        AbstractNode $node,
        null|array|callable $config = null,
    ): static;

    /**
     * @return array<non-empty-string, AbstractNode>
     */
    public function getProperties(): array;
}
