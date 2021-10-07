<?php

namespace Swiftly\Config\Tests\Loader;

use Swiftly\Config\Loader\JsonLoader;
use Swiftly\Config\Store;
use PHPUnit\Framework\TestCase;

use function file_put_contents;
use function json_encode;

/**
 * @group Unit
 */
Class JsonLoaderTest Extends TestCase
{

    const TEMP_FILE = 'php://memory';

    const EXAMPLE_JSON = [
        'id' => 123,
        'name' => 'John',
        'nested' => [
            'life' => 42,
            'example' => 'some_value'
        ]
    ];

    /** @var JsonLoader $loader */
    private $loader;

    public static function setUpBeforeClass() : void
    {
        file_put_contents( self::TEMP_FILE, json_encode( self::EXAMPLE_JSON ));
    }

    public static function tearDownAfterClass(): void
    {
        file_put_contents( self::TEMP_FILE, '' );
    }

    protected function setUp() : void
    {
        $this->loader = new JsonLoader( self::TEMP_FILE );
    }

    public function testLoadsValuesFromJsonFile() : void
    {
        $store = $this->createMock( Store::class );

        $store->expects( $this->once() )
            ->method( 'set' )
            ->with(
                $this->equalTo( 'id' ),
                $this->equalTo( 123 )
            );

        // TODO:

        $this->loader->load( $store );
    }
}
