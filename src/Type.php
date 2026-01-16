<?php declare(strict_types=1);

namespace Swiftly\Config;

use UnitEnum;

use function array_all;
use function is_a;
use function is_array;
use function is_object;

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
     * @pure
     *
     * @template T of UnitEnum
     *
     * @psalm-assert-if-true T $value
     *
     * @param class-string<T> $enumName
     */
    final public static function isEnumCase(mixed $value, string $enumName): bool
    {
        return is_object($value) && is_a($value, $enumName);
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
