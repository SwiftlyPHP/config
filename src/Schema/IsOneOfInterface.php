<?php declare(strict_types=1);

namespace Swiftly\Config\Schema;

/**
 * @internal
 *
 * @template T
 */
interface IsOneOfInterface
{
    /**
     * @param null|T[] $values
     *
     * @return $this
     */
    public function oneOf(?array $values): static;

    /**
     * @return null|T[]
     */
    public function getAllowed(): ?array;
}
