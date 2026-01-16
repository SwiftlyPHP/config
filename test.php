<?php declare(strict_types=1);

use Swiftly\Config\Schema\Node\ObjectNode;
use Swiftly\Config\Schema\Node\RootNode;

require __DIR__ . '/vendor/autoload.php';

enum Environment: string
{
    case Development = 'development';
    case Production = 'production';
}

$schema = RootNode::define()
    ->enum('environment', Environment::class, ['default' => Environment::Development])
    ->bool('debug', ['optional' => true])
    ->object('database', static function (ObjectNode $database): void {
        $database
            ->optional()
            ->string('username', ['optional' => true])
            ->string('password', ['optional' => true])
            ->int('port', ['range' => [0, 255]]);
    })
    ->object('cache', static function (ObjectNode $cache): void {
        $cache
            ->optional()
            ->string('type', ['oneOf' => ['file', 'redis']])
            ->int('lifetime', ['optional' => true, 'range' => [0, 3600]]);
    });

var_dump($schema);
echo PHP_EOL;
