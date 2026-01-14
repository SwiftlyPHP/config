<?php

namespace Swiftly\Config\Exception;

use RuntimeException;

/**
 * Thrown when a file cannot be opened or read from.
 */
final class FileReadException extends RuntimeException
{
    /**
     * Indicate the given file is unreadable.
     *
     * @param string $file_path Absolute path to file
     */
    public function __construct(string $file_path)
    {
        parent::__construct(
            "Failed to read file '{$file_path}' are you sure it exists?"
        );
    }
}
