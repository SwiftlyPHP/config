<?php declare(strict_types=1);

namespace Swiftly\Config\Tests\File;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Swiftly\Config\Exception\ConfigFileException;
use Swiftly\Config\File\JsonFile;
use Swiftly\Config\Store;

use function dirname;

#[CoversClass(JsonFile::class)]
#[CoversClass(ConfigFileException::class)]
final class JsonFileTest extends TestCase
{
    public function testCanLoadValuesFromFile(): void
    {
        $file = new JsonFile(dirname(__DIR__) . '/assets/example.json');
        $config = $file->load();

        self::assertInstanceOf(Store::class, $config);
        self::assertSame('Example Json', $config->get('name'));
        self::assertSame('nested values', $config->get('nested.some'));
    }

    public function testThrowsOnUnreadableFile(): void
    {
        self::expectException(ConfigFileException::class);

        $file = new JsonFile(dirname(__DIR__ . '/assets/missing.json'));
        $file->load();
    }

    public function testThrowsOnUnparsableFile(): void
    {
        self::expectException(ConfigFileException::class);

        $file = new JsonFile(dirname(__DIR__) . '/assets/invalid.json');
        $file->load();
    }
}
