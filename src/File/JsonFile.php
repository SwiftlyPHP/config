<?php declare(strict_types=1);

namespace Swiftly\Config\File;

use Swiftly\Config\ConfigFileInterface;
use Swiftly\Config\Exception\ConfigFileException;
use Swiftly\Config\Store;

use function file_get_contents;
use function is_array;
use function is_file;
use function json_decode;

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
            throw ConfigFileException::fileReadError($this->filePath);
        }

        $contents = file_get_contents($this->filePath);
        $contents = $contents ?: '';
        $decoded = json_decode($contents, true);

        if (!is_array($decoded)) {
            throw ConfigFileException::fileParseError($this->filePath);
        }

        return new Store($decoded);
    }
}
