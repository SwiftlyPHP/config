<?php

namespace Swiftly\Config;

use function explode;
use function is_array;
use function array_key_exists;

/**
 * Represents a generic config object
 * 
 * @api
 */
class Store
{
    /** @var array $data */
    private array $data;

    /**
     * Creates a new data store around a collection of values
     * 
     * @param array $data Config values
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Retrieve a value from the store
     *
     * @php:8.0 Use mixed type hint
     * @template T
     * @param string $key Config option key
     * @param T $default  Value to return if key not found
     * @return mixed|T    Config value
     */
    public function get(string $key, $default = null)// :mixed
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
     * Determine if a value exists in the store
     * 
     * @param string $key Config option key
     * @return bool       Value exists in store
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
