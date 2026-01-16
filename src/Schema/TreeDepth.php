<?php declare(strict_types=1);

namespace Swiftly\Config\Schema;

use function array_pop;
use function implode;

/**
 * @internal
 */
class TreeDepth
{
    /**
     * @var list<non-empty-string>
     */
    private array $levels;

    /**
     * @param non-empty-string $separator
     */
    public function __construct(
        private readonly string $separator,
    ) {
        $this->levels = [];
    }

    /**
     * @param non-empty-string $level
     */
    public function enter(string $level): void
    {
        $this->levels[] = $level;
    }

    public function exit(): void
    {
        array_pop($this->levels);
    }

    public function toString(): string
    {
        return implode($this->separator, $this->levels);
    }
}
