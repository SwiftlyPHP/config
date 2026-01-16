<?php declare(strict_types=1);

namespace Swiftly\Config\Tests\Schema;

use PHPUnit\Framework\TestCase;
use Swiftly\Config\Schema\TreeDepth;

/**
 * @covers \Swiftly\Config\Schema\TreeDepth
 */
final class TreeDepthTest extends TestCase
{
    private TreeDepth $depth;

    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->depth = new TreeDepth('.');
    }

    public function testCanNavigateUpAndDown(): void
    {
        self::assertSame('', $this->depth->toString());

        $this->depth->enter('config');

        self::assertSame('config', $this->depth->toString());

        $this->depth->enter('database');

        self::assertSame('config.database', $this->depth->toString());

        $this->depth->enter('username');

        self::assertSame('config.database.username', $this->depth->toString());

        $this->depth->exit();

        self::assertSame('config.database', $this->depth->toString());

        $this->depth->exit();

        self::assertSame('config', $this->depth->toString());

        $this->depth->exit();

        self::assertSame('', $this->depth->toString());
    }

    public function testCanConfigurePathSeparator(): void
    {
        $depth = new TreeDepth('/');
        $depth->enter('users');
        $depth->enter('local');
        $depth->enter('documents');

        self::assertSame('users/local/documents', $depth->toString());

        $depth->exit();

        self::assertSame('users/local', $depth->toString());
    }
}
