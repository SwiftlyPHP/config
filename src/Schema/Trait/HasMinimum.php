<?php declare(strict_types=1);

namespace Swiftly\Config\Schema\Trait;

trait HasMinimum
{
    protected null|int|float $minimumValue;

    final public function minimum(null|int|float $minimum): static
    {
        $this->minimumValue = $minimum;

        return $this;
    }

    public function getMinimum(): null|int|float
    {
        return $this->minimumValue;
    }
}
