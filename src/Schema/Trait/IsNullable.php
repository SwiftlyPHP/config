<?php declare(strict_types=1);

namespace Swiftly\Config\Schema\Trait;

trait IsNullable
{
    protected bool $nullable;

    final public function nullable(bool $nullable = true): static
    {
        $this->nullable = $nullable;

        return $this;
    }

    public function isNullable(): bool
    {
        return $this->nullable;
    }
}
