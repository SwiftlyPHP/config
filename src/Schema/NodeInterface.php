<?php declare(strict_types=1);

namespace Swiftly\Config\Schema;

/**
 * @internal
 */
interface NodeInterface
{
    /**
     * @return non-empty-string
     */
    public function getKey(): string;

    public function isNullable(): bool;

    public function isOptional(): bool;
}
