<?php declare(strict_types=1);

namespace Swiftly\Config\Schema;

/**
 * @internal
 */
interface HasRangeInterface
{
    /**
     * @return $this
     */
    public function minimum(float|int|null $minimum): static;

    /**
     * @return $this
     */
    public function maximum(float|int|null $maximum): static;

    /**
     * @return $this
     */
    public function range(float|int $minumum, float|int $maximum): static;

    public function getMaximum(): float|int|null;

    public function getMinimum(): float|int|null;
}
