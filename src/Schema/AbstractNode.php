<?php declare(strict_types=1);

namespace Swiftly\Config\Schema;

use Swiftly\Config\Schema\Trait\IsNullable;
use Swiftly\Config\Schema\Trait\IsOptional;

/**
 * @internal
 */
abstract class AbstractNode
{
    use IsNullable;
    use IsOptional;

    /**
     * @param non-empty-string $key
     */
    public function __construct(
        private string $key,
    ) {
    }

    /**
     * @return non-empty-string
     */
    public function getKey(): string
    {
        return $this->key;
    }
}
