<?php

use PHPUnit\Framework\TestCase;
use Alabra\EntityTest\Entity\Cat;
use Alabra\Entity\EntityCollection;

class CatCollectionTest extends TestCase
{

    private EntityCollection $collection;
    private array $catArray;

    protected function setUp(): void
    {
        parent::setUp();

        $this->catArray = [
            new Cat('1a3f35aa-26e5-4de2-8bf5-3cb87a1d607a', 'Whiskers'),
            new Cat('2b4f35aa-26e5-4de2-8bf5-3cb87a1d607b', 'Mittens'),
            new Cat('3c5f35aa-26e5-4de2-8bf5-3cb87a1d607c', 'Fluffy'),
            new Cat('4d6f35aa-26e5-4de2-8bf5-3cb87a1d607d', 'Shadow'),
            new Cat('5e7f35aa-26e5-4de2-8bf5-3cb87a1d607e', 'Tiger'),
            new Cat('6f8f35aa-26e5-4de2-8bf5-3cb87a1d607f', 'Smokey'),
            new Cat('7g9f35aa-26e5-4de2-8bf5-3cb87a1d607g', 'Luna'),
            new Cat('8h0f35aa-26e5-4de2-8bf5-3cb87a1d607h', 'Simba'),
            new Cat('9i1f35aa-26e5-4de2-8bf5-3cb87a1d607i', 'Oreo'),
            new Cat('10j2f35aa-26e5-4de2-8bf5-3cb87a1d607j', 'Charlie'),
        ];

        $this->collection = new EntityCollection;
    }

    public function xtestGetNameByPropertyValueKey()
    {
        $this->collection
            ->setKeyPropertyName("id")
            ->merge($this->catArray);

        $this->collection[] = new Cat('ca16c5af-c995-4df8-9c40-ad86d14af6a0', 'Tokio');
        self::assertEquals('Tokio', $this->collection['ca16c5af-c995-4df8-9c40-ad86d14af6a0']->name);
    }

    public function testGetNameByNativeKey()
    {
        $this->collection->merge($this->catArray);

        self::assertEquals('Whiskers', $this->collection[0]->name);
        self::assertEquals('Whiskers', $this->collection->offsetGet(0)->name);
    }

    public function xtestOffsetExists()
    {
        $collection = new EntityCollection();
        $collection->offsetSet('key1', 'value1');

        $this->assertTrue($collection->offsetExists('key1'));
        $this->assertFalse($collection->offsetExists('nonexistent_key'));
    }

    public function xtestOffsetExistsEntity()
    {
        $this->collection
            ->setKeyPropertyName("id")
            ->merge($this->catArray);

        $this->assertTrue($this->collection->offsetExists('8h0f35aa-26e5-4de2-8bf5-3cb87a1d607h'));
        $this->assertFalse($this->collection->offsetExists('nonexistent_key'));
    }

    public function xtestOffsetUnset()
    {
        $collection = new EntityCollection();
        $collection->offsetSet('key1', 'value1');

        $this->assertTrue($collection->offsetExists('key1'));

        $collection->offsetUnset('key1');

        $this->assertFalse($collection->offsetExists('key1'));
    }

    public function xtestOffsetGet()
    {
        $collection = new EntityCollection();
        $collection->offsetSet('key1', 'value1');

        $this->assertEquals('value1', $collection->offsetGet('key1'));
        $this->assertNull($collection->offsetGet('nonexistent_key'));
    }

    public function xtestToArray()
    {
        $this->collection
            ->setKeyPropertyName("id")
            ->merge($this->catArray);

        $array = $this->collection->toRecursiveArray();

        $this->assertEquals('Mittens', $array[1]['name']);
    }
}
