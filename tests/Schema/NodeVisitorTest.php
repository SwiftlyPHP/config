<?php declare(strict_types=1);

namespace Swiftly\Config\Tests\Schema;

use PHPUnit\Framework\MockObject\Stub;
use PHPUnit\Framework\TestCase;
use Swiftly\Config\Schema\AbstractNode;
use Swiftly\Config\Schema\HasPropertiesInterface;
use Swiftly\Config\Schema\NodeVisitor;
use Swiftly\Config\Schema\TreeDepth;

use function array_key_last;
use function array_map;
use function explode;

/**
 * @covers \Swiftly\Config\Schema\NodeVisitor
 *
 * @upgrade:php8.1 use intersection types to hint return of `createNodeStub`
 * @upgrade:php8.4 use `array_last` in `nodeKeys()` helper
 * @upgrade:phpunit10 use `createMockForIntersectionOfInterfaces`
 */
final class NodeVisitorTest extends TestCase
{
    /**
     * @var (AbstractNode&Stub)[]
     */
    private array $nodes;

    /**
     * @var string[]
     */
    private array $paths;

    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->nodes = [
            $this->createNodeStub('debug'),
            $this->createParentNodeStub('database', [
                $this->createNodeStub('username'),
                $this->createNodeStub('password'),
            ])
        ];
        $this->paths = [
            'debug',
            'database',
            'username',
            'password',
        ];
    }

    public function testCanWalkTreeOfNodes(): void
    {
        $mockTreeDepth = $this->createMock(TreeDepth::class);
        $mockTreeDepth->expects(self::exactly(4))
            ->method('enter')
            ->withConsecutive(...self::nodeKeys($this->paths))
            ->willReturnOnConsecutiveCalls(...$this->paths);
        $mockTreeDepth->expects(self::exactly(4))
            ->method('toString')
            ->willReturnOnConsecutiveCalls(...$this->paths);
        $mockTreeDepth->expects(self::exactly(4))
            ->method('exit');

        $count = 0;
        $visited = [];

        NodeVisitor::walkNodes(
            $mockTreeDepth,
            $this->nodes,
            function (AbstractNode $node, string $path) use (
                &$count,
                &$visited,
            ): void {
                self::assertStringEndsWith(
                    $node->getKey(),
                    $this->paths[$count],
                );

                $count++;
                $visited[] = $path;
            },
        );

        self::assertSame(4, $count);
        self::assertSame($this->paths, $visited);
    }

    /**
     * @param non-empty-string $key
     *
     * @return AbstractNode&Stub
     */
    private function createNodeStub(string $key): AbstractNode
    {
        $node = $this->createStub(AbstractNode::class);
        $node->method('getKey')->willReturn($key);

        return $node;
    }

    /**
     * @param non-empty-string $key
     * @param AbstractNode[] $nodes
     *
     * @return AbstractNode&HasPropertiesInterface&Stub
     */
    private function createParentNodeStub(
        string $key,
        array $nodes,
    ): AbstractNode {
        $node = $this->createStub(ParentNode::class);
        $node->method('getKey')->willReturn($key);
        $node->method('getProperties')->willReturn($nodes);

        return $node;
    }

    /**
     * Used to support argument format of `withConsecutive`.
     *
     * @param list<string> $paths
     * @param non-empty-string $separator
     *
     * @return list<list{string}>
     */
    private static function nodeKeys(
        array $paths,
        string $separator = '.',
    ): array {
        return array_map(
            static function (string $path) use ($separator): array {
                $components = explode($separator, $path);

                return [$components[array_key_last($components)]];
            },
            $paths,
        );
    }
}

// https://github.com/sebastianbergmann/phpunit/issues/3955
abstract class ParentNode extends AbstractNode implements
    HasPropertiesInterface
{
}
