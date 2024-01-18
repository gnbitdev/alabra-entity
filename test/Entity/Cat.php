<?php
declare(strict_types=1);

namespace Alabra\EntityTest\Entity;

use Alabra\Entity\EntityInterface;
use Alabra\Entity\EntityTrait;

//class Cat implements EntityInterface
//{
//    use EntityTrait;
//
//    public function __construct(
//        private string $id,
//        private string $name,
//    )
//    {
//
//    }
//}


class Cat implements EntityInterface
{
    use EntityTrait;

    private string $id;
    private string $name;

    public function __construct(
        string $id,
        string $name
    )
    {
        $this->id = $id;
        $this->name = $name;
    }

}
