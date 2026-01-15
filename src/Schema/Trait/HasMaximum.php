<?php declare(strict_types=1);

namespace Swiftly\Config\Schema\Trait;

trait HasMaximum
{
    protected float|int|null $maximumValue;

    final public function maximum(float|int|null $maximum): static
    {
        $this->maximumValue = $maximum;

        return $this;
    }

    public function getMaximum(): float|int|null
    {
        return $this->maximumValue;
    }
}
