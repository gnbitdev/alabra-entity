<?php
declare(strict_types=1);

namespace Alabra\EntityTest;

use Alabra\Entity\EntityInterface;
use Alabra\Entity\EntityTrait;

class MyEntity implements EntityInterface
{
    use EntityTrait;

    private $val1;
    private $val2;

    public function __construct(string $val1, string $val2)
    {
        $this->val1 = $val1;
        $this->val2 = $val2;
    }
}
