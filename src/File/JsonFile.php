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
 * Class used to load config values from JSON files
 *
 * @api
 */
final class JsonFile implements ConfigFileInterface
{
    /** @var non-empty-string $file_path */
    private string $file_path;

    /**
     * Create a new loader around the given JSON file
     *
     * @param non-empty-string $file_path Absolute file path
     */
    public function __construct(string $file_path)
    {
        $this->file_path = $file_path;
    }

    /** {@inheritDoc} */
    public function load(): Store
    {
        if (!is_file($this->file_path)) {
            throw new FileReadException($this->file_path);
        }

        $contents = file_get_contents($this->file_path);
        $contents = $contents ?: '';
        $decoded = json_decode($contents, true);

        if (!is_array($decoded)) {
            throw new FileParseException($this->file_path);
        }

        return new Store($decoded);
    }
}
