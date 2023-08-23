<?php

namespace Swiftly\Config\Tests\File;

use PHPUnit\Framework\TestCase;
use Swiftly\Config\File\JsonFile;
use Swiftly\Config\Store;
use Swiftly\Config\Exception\FileReadException;
use Swiftly\Config\Exception\FileParseException;

use function dirname;

final class JsonFileTest extends TestCase
{
    /**
     * @covers \Swiftly\Config\File\JsonFile::__construct
     * @covers \Swiftly\Config\File\JsonFile::load
     */
    public function testCanLoadValuesFromFile(): void
    {
        $file = new JsonFile(dirname(__DIR__) . '/assets/example.json');
        $config = $file->load();

        self::assertInstanceOf(Store::class, $config);
        self::assertSame('Example Json', $config->get('name'));
        self::assertSame('nested values', $config->get('nested.some'));
    }

    /**
     * @covers \Swiftly\Config\File\JsonFile::__construct
     * @covers \Swiftly\Config\File\JsonFile::load
     * @covers \Swiftly\Config\Exception\FileReadException
     */
    public function testThrowsOnUnreadableFile(): void
    {
        self::expectException(FileReadException::class);

        // File doesn't exist
        $file = new JsonFile(dirname(__DIR__ . '/assets/missing.json'));
        $file->load();
    }

    /**
     * @covers \Swiftly\Config\File\JsonFile::__construct
     * @covers \Swiftly\Config\File\JsonFile::load
     * @covers \Swiftly\Config\Exception\FileParseException
     */
    public function testThrowsOnUnparsableFile(): void
    {
        self::expectException(FileParseException::class);

        // File contains invalid content
        $file = new JsonFile(dirname(__DIR__) . '/assets/invalid.json');
        $file->load();
    }
}
