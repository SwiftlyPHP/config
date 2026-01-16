<?php declare(strict_types=1);

namespace Swiftly\Config\Tests\Trait;

use Swiftly\Config\Tests\Constraint\ConsecutiveConstraint;

trait WithConsecutiveTrait
{
    /**
     * @template T
     *
     * @param T[] $values
     *
     * @return ConsecutiveConstraint<T>
     */
    public static function withConsecutive(array $values): ConsecutiveConstraint
    {
        return new ConsecutiveConstraint($values);
    }
}
