<?php declare(strict_types=1);

namespace Swiftly\Config\Tests;

use PHPUnit\Framework\TestCase;
use Swiftly\Config\Store;

final class StoreTest extends TestCase
{
    private Store $store;

    public function setUp(): void
    {
        $this->store = new Store([
            'name' => 'Douglas',
            'age' => 42,
            'friends' => [
                'arthur' => [
                    'planet' => 'Earth',
                    'friendly' => true,
                    'is_robot' => false
                ],
                'marvin' => [
                    'is_robot' => true
                ]
            ],
            'null' => null,
            'bool' => false
        ]);
    }

    /**
     * @covers \Swiftly\Config\Store::__construct
     * @covers \Swiftly\Config\Store::get
     */
    public function testCanGetValue(): void
    {
        self::assertEquals('Douglas', $this->store->get('name'));
        self::assertEquals(42, $this->store->get('age'));
        self::assertIsArray($this->store->get('friends'));

        self::assertNull($this->store->get('towel'));
        self::assertNull($this->store->get('poetry'));
    }

    /**
     * @covers \Swiftly\Config\Store::__construct
     * @covers \Swiftly\Config\Store::get
     */
    public function testCanGetNestedValue(): void
    {
        self::assertEquals('Earth', $this->store->get('friends.arthur.planet'));
        self::assertTrue($this->store->get('friends.arthur.friendly'));

        self::assertNull($this->store->get('friends.zaphod'));
        self::assertNull($this->store->get('friends.ford'));
    }

    /**
     * @covers \Swiftly\Config\Store::__construct
     * @covers \Swiftly\Config\Store::has
     */
    public function testCanCheckValueExists(): void
    {
        self::assertTrue($this->store->has('name'));
        self::assertTrue($this->store->has('age'));
        self::assertTrue($this->store->has('friends'));
        self::assertTrue($this->store->has('null'));
        self::assertTrue($this->store->has('bool'));

        self::assertFalse($this->store->has('missing'));
        self::assertFalse($this->store->has('unknown'));
    }

    /**
     * @covers \Swiftly\Config\Store::__construct
     * @covers \Swiftly\Config\Store::has
     */
    public function testCanCheckNestedValueExists(): void
    {
        self::assertTrue($this->store->has('friends.arthur.planet'));
        self::assertTrue($this->store->has('friends.arthur.friendly'));
        self::assertTrue($this->store->has('friends.arthur.is_robot'));

        self::assertFalse($this->store->has('friends.marvin.friendly'));
        self::assertFalse($this->store->has('enemies.zaphod'));
    }
}
