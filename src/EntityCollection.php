<?php
declare(strict_types=1);

namespace Alabra\Entity;

use ArrayIterator;
use Alabra\Entity\EntityTrait;
use Alabra\Entity\EntityInterface;

/**
 * @template TKey
 * @template TValue
 * @implements \ArrayAccess<TKey, TValue>
 * @implements \IteratorAggregate<TKey, TValue>
 */
class EntityCollection implements \ArrayAccess, \IteratorAggregate, \Countable
{

    /**
     *
     * @var array<mixed>
     */
    private array $items = [];

    /**
     *
     * @var string|null
     */
    private ?string $keyPropertyName = null;

    /**
     * Sets the property name to be used as a key for objects within the collection.
     *
     * @param string $keyPropertyName
     * @return $this
     */
    public function setKeyPropertyName($keyPropertyName): self
    {
        $this->keyPropertyName = $keyPropertyName;
        return $this;
    }

    /**
     * Gets the key from an object based on the specified property name.
     *
     * @param EntityInterface $entity
     * @return mixed
     */
    private function getKeyFromObject(EntityInterface $entity)
    {
        if ($this->keyPropertyName && property_exists($entity, $this->keyPropertyName)) {
            return $entity->{$this->keyPropertyName};
        }

        return count($this->items);
    }

    /**
     * Sets the value at the specified offset.
     *
     * @param mixed $offset
     * @param EntityInterface $value
     * @return void
     */
    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {

            $key = $this->getKeyFromObject($value);

            $this->items[$key] = $value;
        } else {
            $this->items[$offset] = $value;
        }
    }

    /**
     * Merges an array of objects into the EntityCollection.
     * If a keyPropertyName is specified, it uses the property value as the key for each object.
     * If no keyPropertyName is set, it merges the array directly.
     *
     * @param array<EntityInterface> $arrayOfObjects The array of objects to merge into the EntityCollection.
     * @return void
     */
    public function merge(array $arrayOfObjects): void
    {
        if ($this->keyPropertyName) {
            foreach ($arrayOfObjects as $object) {
                $key               = $this->getKeyFromObject($object);
                $this->items[$key] = $object;
            }
        } else {
            $this->items = array_merge($this->items, $arrayOfObjects);
        }
    }

    /**
     * Checks if the offset exists in the collection.
     *
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return isset($this->items[$offset]);
    }

    /**
     * Unsets the value at the specified offset.
     *
     * @param mixed $offset
     * @return void
     */
    public function offsetUnset($offset): void
    {
        unset($this->items[$offset]);
    }

    /**
     * Gets the value at the specified offset.
     *
     * @param mixed $offset
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        return $this->items[$offset] ?? null;
    }

    /**
     * Gets an iterator for the collection.
     *
     * @return ArrayIterator<int|string, mixed>
     */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->items);
    }

    /**
     * Gets the number of items in the collection.
     *
     * @return int
     */
    public function count(): int
    {
        return count($this->items);
    }

    /**
     * Converts the EntityCollection and its items to a recursive associative array.
     * This method uses an anonymous class to temporarily encapsulate the collection items.
     *
     * @return array<int|string, mixed>
     */
    public function toRecursiveArray(): array
    {
        $entityCollection = new class($this->items) {
            use EntityTrait;

            /**
             *
             * @var array<mixed>
             */
            private $items = [];

            /**
             *
             * @param array<mixed> $items
             */
            public function __construct(array $items)
            {
                $this->items = $items;
            }

            /**
             * @return array<mixed, mixed>
             */
            public function getRecursiveArray(): array
            {
                return $this->toArray()['items'];
            }
        };

        return $entityCollection->getRecursiveArray();
    }
}
