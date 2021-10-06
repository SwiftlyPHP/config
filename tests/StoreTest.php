<?php

namespace Swiftly\Config\Tests;

use Swiftly\Config\Store;
use Swiftly\Config\LoaderInterface;
use PHPUnit\Framework\TestCase;

/**
 * @group Unit
 */
Class StoreTest Extends TestCase
{

    /** @var Store $store */
    private $store;

    protected function setUp() : void
    {
        $this->store = new Store([
            'id' => 123,
            'test' => 'value',
            'array' => [1, 2, 3]
        ]);
    }

    public function testCanGetConfigValue() : void
    {
        self::assertSame( 123, $this->store->get( 'id' ) );
        self::assertSame( 'value', $this->store->get( 'test' ) );
        self::assertSame( [1, 2, 3], $this->store->get( 'array' ) );
    }

    public function testCanGetDefaultValue() : void
    {
        self::assertSame( 42, $this->store->get( 'life', 42 ) );
        self::assertSame( 'John', $this->store->get( 'name', 'John' ) );
        self::assertNull( $this->store->get( 'invalid' ) );
    }

    public function testCanSetConfigValue() : void
    {
        $this->store->set( 'example', 'some_value' );

        self::assertSame( 'some_value', $this->store->get( 'example' ) );
    }

    public function testCanCheckKeyExists() : void
    {
        self::assertTrue( $this->store->has( 'test' ) );
        self::assertFalse( $this->store->has( 'invalid' ) );
    }

    public function testLoadsValuesFromLoader() : void
    {
        $loader = $this->createMock( LoaderInterface::class );

        $loader->expects( $this->once() )
            ->method( 'load' )
            ->with( $this->equalTo( $this->store ) );

        $this->store->load( $loader );
    }
}
