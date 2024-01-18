<?php

use PHPUnit\Framework\TestCase;
use Alabra\Entity\EntityInterface;

class EntityInterfaceTest extends TestCase
{

    public function testToArrayMethodExists()
    {
        $this->assertTrue(method_exists(EntityInterface::class, 'toArray'));
    }

    public function testToJsonMethodExists()
    {
        $this->assertTrue(method_exists(EntityInterface::class, 'toJson'));
    }
}
