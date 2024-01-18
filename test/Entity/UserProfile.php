<?php
declare(strict_types=1);

namespace Alabra\EntityTest\Entity;

use Alabra\Entity\EntityInterface;
use Alabra\Entity\EntityTrait;

// PHP 8.3
//readonly class UserProfile implements EntityInterface
//{
//    use EntityTrait;
//
//    private string $username;
//    private PersonalInfo $personalInfo;
//
//    public function __construct(
//        public string $firstName,
//        public string $lastName,
//        public string $email,
//        public int $age,
//        public bool $isSubscribed
//    )
//    {
//
//    }
//
//    public function setUsername(string $username): void
//    {
//        $this->username = $username;
//    }
//
//    public function setPersonalInfo(PersonalInfo $personalInfo): void
//    {
//        $this->personalInfo = $personalInfo;
//    }
//}

class UserProfile implements EntityInterface
{
    use EntityTrait;

    private string $username;
    private PersonalInfo $personalInfo;
    public string $firstName;
    public string $lastName;
    public string $email;
    public int $age;
    public bool $isSubscribed;

    public function __construct(
        string $firstName,
        string $lastName,
        string $email,
        int $age,
        bool $isSubscribed
    )
    {
        $this->firstName    = $firstName;
        $this->lastName     = $lastName;
        $this->email        = $email;
        $this->age          = $age;
        $this->isSubscribed = $isSubscribed;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function setPersonalInfo(PersonalInfo $personalInfo): void
    {
        $this->personalInfo = $personalInfo;
    }
}
