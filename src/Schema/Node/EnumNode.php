<?php declare(strict_types=1);

namespace Swiftly\Config\Schema\Node;

use BackedEnum;
use Swiftly\Config\Exception\SchemaException;
use Swiftly\Config\Schema\AbstractNode;
use Swiftly\Config\Schema\IsConfigurableInterface;
use Swiftly\Config\Schema\IsEnumBackedInterface;
use Swiftly\Config\Type;

use function is_a;

/**
 * @template T of BackedEnum
 *
 * @implements IsEnumBackedInterface<T>
 *
 * @upgrade:php8.1 Mark property as readonly
 */
final class EnumNode extends AbstractNode implements
    IsConfigurableInterface,
    IsEnumBackedInterface
{
    /**
     * @var class-string<T>
     */
    private string $enumName;

    /**
     * @var T|null
     */
    private ?BackedEnum $defaultCase;

    /**
     * @psalm-assert class-string<T> $enumName
     *
     * @param non-empty-string $key
     * @param class-string<T>|string $enumName
     *
     * @throws SchemaException If the value isn't the name of a backed enum
     */
    public function __construct(
        string $key,
        string $enumName,
    ) {
        parent::__construct($key);

        if (!is_a($enumName, BackedEnum::class, true)) {
            throw SchemaException::invalidUseOfEnum($enumName);
        }

        $this->enumName = $enumName;
        $this->nullable(false);
        $this->optional(false);
    }

    /**
     * @param T&BackedEnum $defaultCase
     *
     * @return $this
     */
    public function defaultCase(?BackedEnum $defaultCase): static
    {
        $this->defaultCase = $defaultCase;
        $this->optional(true);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getEnumName(): string
    {
        return $this->enumName;
    }

    /**
     * {@inheritDoc}
     */
    public function getCases(): array
    {
        return $this->enumName::cases();
    }

    /**
     * {@inheritDoc}
     */
    public function getDefaultCase(): ?BackedEnum
    {
        return $this->defaultCase;
    }

    /**
     * {@inheritDoc}
     */
    public function configure(array $config): static
    {
        parent::configure($config);

        if (isset($config['default'])
            && Type::isEnumCase($config['default'], $this->enumName)
        ) {
            $this->defaultCase($config['default']);
        }

        return $this;
    }
}
