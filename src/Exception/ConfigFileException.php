<?php declare(strict_types=1);

namespace Swiftly\Config\Exception;

use RuntimeException;
use Swiftly\Config\ExceptionInterface;

use function sprintf;

class ConfigFileException extends RuntimeException implements ExceptionInterface
{
    final public static function fileReadError(string $filePath): self
    {
        return new self(sprintf(
            'Failure when attempting to read file "%s", make sure it exists and'
            . ' has the correct permissions',
            $filePath,
        ));
    }

    final public static function fileParseError(string $filePath): self
    {
        return new self(sprintf(
            'Failed to parse file "%s", please check for sytax errors and make'
            . ' sure it is properly encoded',
            $filePath,
        ));
    }
}
