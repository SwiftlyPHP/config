<?php declare(strict_types=1);

namespace Swiftly\Config\Tests\Constraint;

use PHPUnit\Framework\Constraint\Constraint;
use PHPUnit\Util\Exporter;

use function array_key_exists;

/**
 * @template T
 */
final class ConsecutiveConstraint extends Constraint
{
    private int $index = 0;

    /**
     * @param T[] $values
     */
    public function __construct(
        private readonly array $values,
    ) {
    }

    /**
     * {@inheritDoc}
     *
     * @psalm-assert-if-true T $other
     *
     * @param mixed $other
     */
    public function matches(mixed $other): bool
    {
        if (!array_key_exists($this->index, $this->values)) {
            return false;
        }

        return $other === $this->values[$this->index++];
    }

    /**
     * {@inheritDoc}
     */
    public function toString(): string
    {
        if (!array_key_exists($this->index, $this->values)) {
            return 'is an expected consecutive argument';
        }

        $value = $this->values[$this->index];

        return 'is identical to ' . Exporter::export($value);
    }
}
