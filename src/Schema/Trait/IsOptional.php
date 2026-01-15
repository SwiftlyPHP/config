<?php declare(strict_types=1);

namespace Swiftly\Config\Schema\Trait;

trait IsOptional
{
    protected bool $optional;

    final public function optional(bool $optional = true): static
    {
        $this->optional = $optional;

        return $this;
    }

    public function isOptional(): bool
    {
        return $this->optional;
    }
}
