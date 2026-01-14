<?php declare(strict_types=1);

namespace Swiftly\Config;

use function array_key_exists;
use function explode;
use function is_array;

/**
 * Represents a generic config object.
 *
 * @api
 *
 * @upgrade:php8.1 Mark property as readonly
 */
class Store
{
    /**
     * Creates a new data store around a collection of values.
     */
    public function __construct(
        private array $data,
    ) {
    }

    /**
     * Retrieve a value from the store.
     *
     * @template T
     *
     * @param non-empty-string $key
     * @param T $default
     *
     * @return T
     */
    public function get(string $key, mixed $default = null): mixed
    {
        $data = $this->data;

        foreach (explode('.', $key) as $subkey) {
            if (!is_array($data) || !array_key_exists($subkey, $data)) {
                return $default;
            }

            /** @psalm-suppress MixedAssignment */
            $data = $data[$subkey];
        }

        return $data;
    }

    /**
     * Determine if a value exists in the store.
     *
     * @param non-empty-string $key
     */
    public function has(string $key): bool
    {
        $data = $this->data;

        foreach (explode('.', $key) as $subkey) {
            if (!is_array($data) || !array_key_exists($subkey, $data)) {
                return false;
            }

            /** @psalm-suppress MixedAssignment */
            $data = $data[$subkey];
        }

        return true;
    }
}
