<?php declare(strict_types=1);

namespace Swiftly\Config\Schema;

/**
 * @internal
 */
interface IsConfigurableInterface
{
    /**
     * @param array<string, mixed> $config
     *
     * @return $this
     */
    public function configure(array $config): static;
}
