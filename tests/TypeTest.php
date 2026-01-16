<?php declare(strict_types=1);

namespace Swiftly\Config\Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use stdClass;
use Swiftly\Config\Type;

#[CoversClass(Type::class)]
final class TypeTest extends TestCase
{
    public function testCanDetermineIfArrayContainsOnlyInt(): void
    {
        self::assertFalse(Type::isIntArray(123));
        self::assertFalse(Type::isIntArray(3.14));
        self::assertFalse(Type::isIntArray(null));
        self::assertFalse(Type::isIntArray('hello'));
        self::assertFalse(Type::isIntArray(new stdClass()));
        self::assertFalse(Type::isIntArray(['red', 'green', 'blue']));
        self::assertFalse(Type::isIntArray([null, 'one', 2.0]));
        self::assertFalse(Type::isIntArray([1, 2, 3.14]));
        self::assertTrue(Type::isIntArray([]));
        self::assertTrue(Type::isIntArray([1, 2, 3]));
    }

    public function testCanDetermineIfArrayContainsOnlyString(): void
    {
        self::assertFalse(Type::isStringArray(123));
        self::assertFalse(Type::isStringArray(3.14));
        self::assertFalse(Type::isStringArray(null));
        self::assertFalse(Type::isStringArray('hello'));
        self::assertFalse(Type::isStringArray(new stdClass()));
        self::assertFalse(Type::isStringArray([null, 'one', 2.0]));
        self::assertFalse(Type::isStringArray([1, 2, 3]));
        self::assertFalse(Type::isStringArray([1, 2, 3.14]));
        self::assertTrue(Type::isStringArray([]));
        self::assertTrue(Type::isStringArray(['red', 'green', 'blue']));
    }
}
