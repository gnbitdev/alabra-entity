<?php

use PHPUnit\Framework\TestCase;
use Alabra\Entity\EntityTrait;

class EntityTraitTest extends TestCase
{

    private $entity;

    protected function setUp(): void
    {
        $this->entity = $this->getMockForTrait(EntityTrait::class);
    }

    public function testToArrayMethodExists()
    {
        $this->assertTrue(method_exists($this->entity, 'toArray'));
    }

    public function testToJsonMethodExists()
    {
        $this->assertTrue(method_exists($this->entity, 'toJson'));
    }
}
