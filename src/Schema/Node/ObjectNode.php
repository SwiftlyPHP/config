<?php declare(strict_types=1);

namespace Swiftly\Config\Schema\Node;

use BackedEnum;
use Swiftly\Config\Exception\SchemaException;
use Swiftly\Config\Schema\AbstractNode;
use Swiftly\Config\Schema\HasPropertiesInterface;
use Swiftly\Config\Schema\IsConfigurableInterface;

use function assert;
use function is_callable;

/**
 * @api
 */
class ObjectNode extends AbstractNode implements
    HasPropertiesInterface,
    IsConfigurableInterface
{
    /**
     * @var array<non-empty-string, AbstractNode>
     */
    protected readonly array $properties = [];

    /**
     * @param non-empty-string $key
     */
    public function __construct(string $key)
    {
        parent::__construct($key);

        $this->nullable(false);
        $this->optional(false);
    }

    /**
     * @param non-empty-string $key
     * @param null|array<string, mixed>|callable(StringNode):void $config
     *
     * @return $this
     */
    public function string(string $key, null|array|callable $config = null): self
    {
        return $this->property($key, new StringNode($key), $config);
    }

    /**
     * @param non-empty-string $key
     * @param null|array<string, mixed>|callable(IntNode):void $config
     *
     * @return $this
     */
    public function int(string $key, null|array|callable $config = null): self
    {
        return $this->property($key, new IntNode($key), $config);
    }

    /**
     * @param non-empty-string $key
     * @param null|array<string, mixed>|callable(BoolNode):void $config
     *
     * @return $this
     */
    public function bool(string $key, null|array|callable $config = null): self
    {
        return $this->property($key, new BoolNode($key), $config);
    }

    /**
     * @param non-empty-string $key
     * @param null|array<string, mixed>|callable(ObjectNode):void $config
     *
     * @return $this
     */
    public function object(string $key, null|array|callable $config = null): self
    {
        return $this->property($key, new ObjectNode($key), $config);
    }

    /**
     * @template T of BackedEnum
     *
     * @param non-empty-string $key
     * @param class-string<T> $enumName
     * @param null|array<string, mixed>|callable(EnumNode<T>):void $config
     *
     * @return $this
     */
    public function enum(
        string $key,
        string $enumName,
        null|array|callable $config = null,
    ): self {
        return $this->property($key, new EnumNode($key, $enumName), $config);
    }

    /**
     * @template T of AbstractNode
     *
     * @param non-empty-string $key
     * @param T $node
     * @param null|array<string, mixed>|callable(T):void $config
     *
     * @throws SchemaException If this type of node cannot be configured
     *
     * @return $this
     */
    public function property(
        string $key,
        AbstractNode $node,
        null|array|callable $config = null,
    ): static {
        $this->properties[$key] = self::applyConfig($node, $config);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getProperties(): array
    {
        return $this->properties;
    }

    /**
     * @template T of AbstractNode
     *
     * @param T $node
     * @param null|array<string, mixed>|callable(T):void $config
     *
     * @return T
     */
    private static function applyConfig(
        AbstractNode $node,
        null|array|callable $config,
    ): AbstractNode {
        if (null === $config) {
            return $node;
        }

        if (is_callable($config)) {
            $config($node);
        } elseif (!empty($config)) {
            self::defaultConfig($node, $config);
        }

        return $node;
    }

    /**
     * @psalm-assert IsConfigurableInterface $node
     *
     * @param array<string, mixed> $config
     */
    private static function defaultConfig(
        AbstractNode $node,
        array $config,
    ): void {
        assert(!empty($config));

        if (!$node instanceof IsConfigurableInterface) {
            throw SchemaException::unconfigurableNode($node);
        }

        $node->configure($config);
    }
}
