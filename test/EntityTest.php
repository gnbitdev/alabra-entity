<?php

namespace Alabra\EntityTest;

use PHPUnit\Framework\TestCase;

class EntityTest extends TestCase
{

    private $myEntity;

    protected function setUp()
    {
        $this->myEntity = new MyEntity('A', 'B');
    }

    public function testToArray()
    {
        $result = $this->myEntity->toArray();

        self::assertEquals(['val1' => 'A', 'val2' => 'B'], $result);
    }

    public function testToJson()
    {
        $result = $this->myEntity->toJson();

        self::assertEquals(json_encode(['val1' => 'A', 'val2' => 'B']), $result);
    }

    public function testGetProperty()
    {
        self::assertEquals('A', $this->myEntity->val1);
    }

   
}
