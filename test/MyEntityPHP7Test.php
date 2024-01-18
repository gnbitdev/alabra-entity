<?php

namespace Alabra\EntityTest;

use PHPUnit\Framework\TestCase;
use Alabra\EntityTest\Entity\MyEntityPHP7;

class MyEntityPHP7Test extends TestCase
{

    private $myEntity;

    protected function setUp(): void
    {
        parent::setUp();

        $this->myEntity = new MyEntityPHP7('A', 'B');
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
