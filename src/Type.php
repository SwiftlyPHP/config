<?php declare(strict_types=1);

namespace Swiftly\Config;

use function array_all;
use function is_array;
use function is_float;
use function is_int;
use function is_string;

abstract class Type
{
    /**
     * @pure
     *
     * @psalm-assert-if-true int|float $value
     */
    final public static function isIntOrFloat(mixed $value): bool
    {
        return is_int($value) || is_float($value);
    }

    /**
     * @pure
     *
     * @psalm-assert-if-true array<int|float> $value
     */
    final public static function isIntOrFloatArray(mixed $value): bool
    {
        return is_array($value) && array_all($value, [self::class, 'isIntOrFloat']);
    }

    /**
     * @pure
     *
     * @psalm-assert-if-true string[] $value
     */
    final public static function isStringArray(mixed $value): bool
    {
        return is_array($value)
            && array_all(
                $value,
                static fn (mixed $item) => is_string($item),
            );
    }
}
