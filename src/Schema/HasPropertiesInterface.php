<?php declare(strict_types=1);

namespace Swiftly\Config\Schema;

/**
 * @internal
 */
interface HasPropertiesInterface
{
    /**
     * @return array<non-empty-string,AbstractNode>
     */
    public function getProperties(): array;
}
