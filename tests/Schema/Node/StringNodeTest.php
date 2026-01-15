<?php declare(strict_types=1);

namespace Swiftly\Config\Tests\Schema\Node;

use Swiftly\Config\Schema\Node\StringNode;
use Swiftly\Config\Tests\Schema\AbstractNodeTestCase;

/**
 * @extends parent<StringNode>
 */
final class StringNodeTest extends AbstractNodeTestCase
{
    protected function setUp(): void
    {
        $this->node = new StringNode('username');
    }
}
