<?php declare(strict_types=1);

namespace Swiftly\Config\Schema;

use BackedEnum;

/**
 * @template T of BackedEnum
 */
interface IsEnumBackedInterface
{
    /**
     * @return class-string<T>
     */
    public function getEnumName(): string;

    /**
     * @return T[]
     */
    public function getCases(): array;

    /**
     * @return T|null
     */
    public function getDefaultCase(): ?BackedEnum;
}
