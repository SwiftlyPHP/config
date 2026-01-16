<?php declare(strict_types=1);

namespace Swiftly\Config\Tests\Schema\Node;

use PHPUnit\Framework\Attributes\CoversClass;
use Swiftly\Config\Schema\AbstractNode;
use Swiftly\Config\Schema\Node\StringNode;
use Swiftly\Config\Schema\Trait\IsNullable;
use Swiftly\Config\Schema\Trait\IsOptional;
use Swiftly\Config\Tests\Schema\AbstractNodeTestCase;

/**
 * @extends parent<StringNode>
 */
#[CoversClass(StringNode::class)]
#[CoversClass(AbstractNode::class)]
#[CoversClass(IsNullable::class)]
#[CoversClass(IsOptional::class)]
final class StringNodeTest extends AbstractNodeTestCase
{
    protected function setUp(): void
    {
        $this->node = new StringNode('username');
    }
}
