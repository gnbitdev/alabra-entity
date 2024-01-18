<?php

namespace Alabra\EntityTest;

use PHPUnit\Framework\TestCase;
use Alabra\EntityTest\Entity\PersonalInfo;
use Alabra\EntityTest\Entity\UserProfile;

class UserProfileTest extends TestCase
{

    private $userProfile;
    private $values = [
        'firstName'    => 'Jhon',
        'lastName'     => 'Smith',
        'email'        => 'test@example.com',
        'age'          => 40,
        'isSubscribed' => true,
        'username'     => 'other',
        'personalInfo' => ['address' => '123 Main St', 'phoneNumber' => '555-1234']
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $personalInfo = new PersonalInfo('123 Main St', '555-1234');

        $this->userProfile = new UserProfile('Jhon', 'Smith', 'test@example.com', 40, true);
        $this->userProfile->setUsername('other');
        $this->userProfile->setPersonalInfo($personalInfo);
    }

    public function testToArray()
    {
        $result = $this->userProfile->toArray();

        self::assertEquals($this->values, $result);
    }

    public function testToJson()
    {
        $result = $this->userProfile->toJson();

        self::assertEquals($this->values, json_decode($result, true));
    }

    public function testGetProperty()
    {
        self::assertEquals('Jhon', $this->userProfile->firstName);
    }

    public function testCallable()
    {
        $result = $this->userProfile->toArray(function ($value) {
            if ($value === 'Jhon') {
                return 'Mike';
            }
            if ($this->userProfile->hasArrayMethod($value)) {
                return $value->toArray();
            }
        });

        self::assertEquals('Mike', $result['firstName']);
    }

    public function testIterator()
    {
        $arrayIterator = $this->userProfile->getIterator();

        // Add a new element
        $arrayIterator->offsetSet('gender', 'Male');

        self::assertEquals('Male', $arrayIterator['gender']);

        // Modify an existing element
        $arrayIterator->offsetSet('gender', 'Female');
        self::assertEquals('Female', $arrayIterator['gender']);

        // Remove an element
        $arrayIterator->offsetUnset('gender');
        self::assertArrayNotHasKey('gender', $arrayIterator);
    }
}
