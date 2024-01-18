# Alabra Entity

**Alabra Entity** is a PHP package that provides a flexible and extensible way to work with object collections. It includes an `EntityCollection` class that implements common array interfaces such as `ArrayAccess`, `IteratorAggregate`, and `Countable`. This allows for easy manipulation and traversal of collections of objects.

## Installation

You can install this package via [Composer](https://getcomposer.org/):

```bash
composer require alabra/alabra-entity


## Usage
### Basic Usage

Creating Entity 

```php
class UserProfile implements EntityInterface
{
    use EntityTrait;

    private string $username;
    private PersonalInfo $personalInfo;

    public function __construct(
        private string $firstName,
        private string $lastName,
        private string $email,
        private int $age,
        private bool $isSubscribed
    )
    {

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
```

```php
        $personalInfo = new PersonalInfo('123 Main St', '555-1234');
        $this->userProfile = new UserProfile('Jhon', 'Smith', 'test@example.com', 40, true);
        $this->userProfile->setUsername('other');
        $this->userProfile->setPersonalInfo($personalInfo);

        //Methods 
        $this->userProfile->toArray();
        $this->userProfile->toJson();
        $this->userProfile->getIterator();

```


### Create Collections 

```php
use Alabra\Entity\EntityCollection;

// Create an instance of EntityCollection
$collection = new EntityCollection();

// Add objects to the collection
$object1 = new YourEntityClass();
$object2 = new YourEntityClass();

$collection[] = $object1;
$collection[] = $object2;

// Access objects by key or iterate through the collection
foreach ($collection as $key => $object) {
    // Do something with each object
}

// Check if an offset exists
if (isset($collection['some_key'])) {
    // Object with key 'some_key' exists
}

// Remove an object by key
unset($collection['some_key']);

// Get the number of objects in the collection
$count = count($collection);
```


### Advanced Usage

#### Using a Key Property

If your objects have a specific property that should be used as the key in the collection, you can set it using the setKeyPropertyName method:

```php
use Alabra\Entity\EntityCollection;

// Create an instance of EntityCollection
$collection = new EntityCollection();

// Set the key property name
$collection->setKeyPropertyName('id');

// Add objects to the collection
$object1 = new YourEntityClass('A', 'B', 1, true, 1.5, 'key1');
$object2 = new YourEntityClass('C', 'D', 2, false, 2.5, 'key2');

$collection[] = $object1;
$collection[] = $object2;

// Access objects by their key property
$objectByKey = $collection['key1']; // Returns $object1
```

#### Merging Collections
You can merge two collections, either using a key property or by a simple merge:

```php
use Alabra\Entity\EntityCollection;

// Create two instances of EntityCollection
$collection1 = new EntityCollection();
$collection2 = new EntityCollection();

// Merge collections
$collection1->merge($collection2->toArray());
```


#### Transforming Collections to Arrays
You can easily convert the collection and its objects to an associative array:

```php
use Alabra\Entity\EntityCollection;

// Create an instance of EntityCollection
$collection = new EntityCollection();

// Add objects to the collection
$object1 = new YourEntityClass('A', 'B', 1, true, 1.5);
$object2 = new YourEntityClass('C', 'D', 2, false, 2.5);

$collection[] = $object1;
$collection[] = $object2;

// Convert the collection to an array
$arrayRepresentation = $collection->toArray();
```


## License
This package is open-sourced software licensed under the MIT license.