<?php

namespace Swiftly\Config\File;

use Swiftly\Config\ConfigFileInterface;
use Swiftly\Config\Store;
use Swiftly\Config\Exception\FileReadException;
use Swiftly\Config\Exception\FileParseException;

use function is_file;
use function file_get_contents;
use function json_decode;
use function is_array;


/**
 * Class used to load config values from JSON files.
 *
 * @api
 *
 * @upgrade:php8.1 Mark property as readonly
 */
final class JsonFile implements ConfigFileInterface
{
    /**
     * Create a new loader around the given JSON file.
     *
     * @param non-empty-string $filePath Absolute file path
     */
    public function __construct(
        private string $filePath,
    ) {
    }

    /** {@inheritDoc} */
    public function load(): Store
    {
        if (!is_file($this->filePath)) {
            throw new FileReadException($this->filePath);
        }

        $contents = file_get_contents($this->filePath);
        $contents = $contents ?: '';
        $decoded = json_decode($contents, true);

        if (!is_array($decoded)) {
            throw new FileParseException($this->filePath);
        }

        return new Store($decoded);
    }
}
