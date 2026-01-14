<?php

namespace Swiftly\Config\Exception;

use RuntimeException;

/**
 * Thrown when a file is readable but its content cannot be parsed.
 */
final class FileParseException extends RuntimeException
{
    /**
     * Indicate the given file is unparsable.
     *
     * @param string $file_path Absolute path to file
     */
    public function __construct(string $file_path)
    {
        parent::__construct(
            "Failed to parse file '{$file_path}' please check for syntax errors"
        );
    }
}
