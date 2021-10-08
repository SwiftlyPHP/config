<?php

namespace Swiftly\Config\Tests\Loader;

use Swiftly\Config\Loader\JsonLoader;
use Swiftly\Config\Store;
use PHPUnit\Framework\TestCase;

use function file_put_contents;
use function json_encode;
use function unlink;

/**
 * @group Unit
 */
Class JsonLoaderTest Extends TestCase
{

    const TEMP_FILE = __DIR__ . '/test.json';

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
        unlink( self::TEMP_FILE );
    }

    protected function setUp() : void
    {
        $this->loader = new JsonLoader( self::TEMP_FILE );
    }

    public function testLoadsValuesIntoStore() : void
    {
        $store = $this->createMock( Store::class );

        $store->expects( $this->exactly( 5 ) )
            ->method( 'set' )
            ->withConsecutive(
                [$this->equalTo( 'id' ), $this->equalTo( 123 )],
                [$this->equalTo( 'name' ), $this->equalTo( 'John' )],
                [$this->equalTo( 'nested.life' ), $this->equalTo( 42 )],
                [$this->equalTo( 'nested.example' ), $this->equalTo( 'some_value' )],
                [$this->equalTo( 'nested' ), $this->equalTo( self::EXAMPLE_JSON['nested'] )]
            );

        $this->loader->load( $store );
    }
}
