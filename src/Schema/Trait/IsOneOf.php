<?php declare(strict_types=1);

namespace Swiftly\Config\Schema\Trait;

/**
 * @template T
 */
trait IsOneOf
{
    /**
     * @var null|T[]
     */
    protected ?array $allowed;

    /**
     * @param null|T[] $values
     */
    final public function oneOf(?array $values): static
    {
        $this->allowed = $values;

        return $this;
    }

    /**
     * @return null|T[]
     */
    public function getAllowed(): ?array
    {
        return $this->allowed;
    }
}
