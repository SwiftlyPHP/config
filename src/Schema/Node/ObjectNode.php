<?php declare(strict_types=1);

namespace Swiftly\Config\Schema\Node;

use Swiftly\Config\Schema\AbstractNode;
use Swiftly\Config\Schema\HasPropertiesInterface;
use Swiftly\Config\Schema\IsConfigurableInterface;

use function is_callable;

/**
 * @api
 *
 * @upgrade:php8.1 Mark properties as readonly
 */
class ObjectNode extends AbstractNode implements
    HasPropertiesInterface,
    IsConfigurableInterface
{
    /**
     * @var array<non-empty-string,AbstractNode>
     */
    protected array $items = [];

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
     * @param null|array<string,mixed>|callable(StringNode):void $config
     *
     * @return $this
     */
    public function string(string $key, null|array|callable $config = null): self
    {
        $this->items[$key] = self::applyConfig(new StringNode($key), $config);

        return $this;
    }

    /**
     * @param non-empty-string $key
     * @param null|array<string,mixed>|callable(IntNode):void $config
     *
     * @return $this
     */
    public function int(string $key, null|array|callable $config = null): self
    {
        $this->items[$key] = self::applyConfig(new IntNode($key), $config);

        return $this;
    }

    /**
     * @param non-empty-string $key
     * @param null|array<string,mixed>|callable(BoolNode):void $config
     *
     * @return $this
     */
    public function bool(string $key, null|array|callable $config = null): self
    {
        $this->items[$key] = self::applyConfig(new BoolNode($key), $config);

        return $this;
    }

    /**
     * @param non-empty-string $key
     * @param null|array<string,mixed>|callable(ObjectNode):void $config
     *
     * @return $this
     */
    public function object(string $key, null|array|callable $config = null): self
    {
        $this->items[$key] = self::applyConfig(new ObjectNode($key), $config);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getProperties(): array
    {
        return $this->items;
    }

    /**
     * {@inheritDoc}
     */
    public function configure(array $config): void
    {
        return;
    }

    /**
     * @template T of AbstractNode
     *
     * @param T $node
     * @param null|array<string,mixed>|callable(T):void $config
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
     * @param array<string,mixed> $config
     */
    private static function defaultConfig(
        AbstractNode $node,
        array $config,
    ): void {
        if (isset($config['optional'])) {
            $node->optional((bool) $config['optional']);
        }

        if (isset($config['nullable'])) {
            $node->nullable((bool) $config['nullable']);
        }

        if ($node instanceof IsConfigurableInterface) {
            $node->configure($config);
        }
    }
}
