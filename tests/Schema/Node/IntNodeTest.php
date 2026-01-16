<?php declare(strict_types=1);

namespace Swiftly\Config\Tests\Schema\Node;

use PHPUnit\Framework\Attributes\CoversClass;
use Swiftly\Config\Schema\AbstractNode;
use Swiftly\Config\Schema\Node\IntNode;
use Swiftly\Config\Schema\Trait\IsNullable;
use Swiftly\Config\Schema\Trait\IsOptional;
use Swiftly\Config\Tests\Schema\AbstractNodeTestCase;

/**
 * @extends parent<IntNode>
 */
#[CoversClass(IntNode::class)]
#[CoversClass(AbstractNode::class)]
#[CoversClass(IsNullable::class)]
#[CoversClass(IsOptional::class)]
final class IntNodeTest extends AbstractNodeTestCase
{
    protected function setUp(): void
    {
        $this->node = new IntNode('port');
    }

    public function testCanSetMaximumAllowedValue(): void
    {
        self::assertNull($this->node->getMaximum());

        $this->node->maximum(255);

        self::assertSame(255, $this->node->getMaximum());
    }

    public function testCanSetMinimumAllowedValue(): void
    {
        self::assertNull($this->node->getMinimum());

        $this->node->minimum(0);

        self::assertSame(0, $this->node->getMinimum());
    }
}
