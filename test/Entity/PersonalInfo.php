<?php
declare(strict_types=1);

namespace Alabra\EntityTest\Entity;

use Alabra\Entity\EntityInterface;
use Alabra\Entity\EntityTrait;

class PersonalInfo implements EntityInterface
{
    use EntityTrait;

    private string $address;
    private string $phoneNumber;

    public function __construct(string $address, string $phoneNumber)
    {
        $this->address     = $address;
        $this->phoneNumber = $phoneNumber;
    }
}
