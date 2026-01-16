<?php declare(strict_types=1);

namespace Swiftly\Config\Tests\Schema;

use PHPUnit\Framework\TestCase;
use Swiftly\Config\Schema\AbstractNode;

/**
 * @template T of AbstractNode
 */
abstract class AbstractNodeTestCase extends TestCase
{
    /**
     * @var T
     */
    protected readonly AbstractNode $node;

    public function testCanDefineNodeAsNullable(): void
    {
        self::assertFalse($this->node->isNullable());

        $this->node->nullable();

        self::assertTrue($this->node->isNullable());
    }

    public function testCanDefineNodeAsOptional(): void
    {
        self::assertFalse($this->node->isOptional());

        $this->node->optional();

        self::assertTrue($this->node->isOptional());
    }
}
