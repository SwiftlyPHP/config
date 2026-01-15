<?php declare(strict_types=1);

namespace Swiftly\Config;

use Swiftly\Config\Exception\ConfigFileException;
use Swiftly\Config\Store;

/**
 * Interface for all classes capable of reading config values from files.
 *
 * @api
 */
interface ConfigFileInterface
{
    /**
     * Load the config values of this file into a store object.
     *
     * @throws ConfigFileException If the file cannot be read or parsed.
     */
    public function load(): Store;
}
