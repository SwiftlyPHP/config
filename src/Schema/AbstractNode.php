<?php declare(strict_types=1);

namespace Swiftly\Config\Schema;

use Swiftly\Config\Exception\SchemaException;
use Swiftly\Config\Schema\Trait\IsNullable;
use Swiftly\Config\Schema\Trait\IsOptional;

use function assert;

/**
 * @internal Should not implement most interfaces to allow subclass flexibility
 */
abstract class AbstractNode implements NodeInterface
{
    use IsNullable;
    use IsOptional;

    /**
     * @param non-empty-string $key
     */
    public function __construct(
        private readonly string $key,
    ) {
    }

    /**
     * @return non-empty-string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @internal No `IsConfigurableInterface` to allow subclass flexibility
     *
     * @param array<string, mixed> $config
     *
     * @return $this
     */
    public function configure(array $config): static
    {
        assert(
            $this instanceof IsConfigurableInterface,
            SchemaException::invalidInheritanceOfConfigure($this),
        );

        if (isset($config['optional'])) {
            $this->optional((bool) $config['optional']);
        }

        if (isset($config['nullable'])) {
            $this->nullable((bool) $config['nullable']);
        }

        return $this;
    }
}
