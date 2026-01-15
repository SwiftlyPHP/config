<?php declare(strict_types=1);

use Swiftly\Config\Schema\Node\ObjectNode;
use Swiftly\Config\Schema\Node\RootNode;

require __DIR__ . '/vendor/autoload.php';

$schema = new RootNode();
$schema
    ->string('environment', ['oneOf' => ['prod', 'dev']])
    ->bool('debug')
    ->object('database', static function (ObjectNode $database): void {
        $database
            ->string('username', ['optional' => true])
            ->string('password', ['optional' => true])
            ->int('port', ['range' => [0, 255]]);
    });

var_dump($schema);
echo PHP_EOL;
