<?php

namespace Swiftly\Config;

use Swiftly\Config\Exception\FileReadException;
use Swiftly\Config\Exception\FileParseException;
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
     * @throws FileReadException  If the file does not exist or is unreadable
     * @throws FileParseException If the file cannot be parsed
     */
    public function load(): Store;
}
