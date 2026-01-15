<?php declare(strict_types=1);

namespace Swiftly\Config;

use function array_all;
use function is_array;

/**
 * @internal
 */
abstract class Type
{
    /**
     * @pure
     *
     * @psalm-assert-if-true int[] $value
     */
    final public static function isIntArray(mixed $value): bool
    {
        return is_array($value) && self::arrayIs($value, 'is_int');
    }

    /**
     * @pure
     *
     * @psalm-assert-if-true string[] $value
     */
    final public static function isStringArray(mixed $value): bool
    {
        return is_array($value) && self::arrayIs($value, 'is_string');
    }

    /**
     * Stops `ArgumentCountError` from the `is_*` family of functions.
     *
     * @pure
     *
     * @param callable(mixed):bool $condition
     */
    private static function arrayIs(array $array, callable $condition): bool
    {
        return array_all(
            $array,
            static fn (mixed $value): bool => $condition($value),
        );
    }
}
