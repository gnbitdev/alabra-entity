<?php
declare(strict_types=1);

namespace Alabra\Entity;

use Alabra\Entity\Exception\InvalidArgumentException;
use ArrayIterator;
use Traversable;
use Alabra\Entity\EntityInterface;

trait EntityTrait
{

    /**
     * Get value the $property
     *
     * @param string $property
     * @return mixed
     * @throws Exception\InvalidArgumentException
     */
    public function __get($property)
    {
        if (property_exists(__CLASS__, $property)) {
            return $this->{$property};
        } else {
            throw new InvalidArgumentException('Undefined property: '.__CLASS__."::\$$property");
        }
    }

    /**
     *  Retrieve the entity in JSON format.
     *
     * @param callable|null $transformer
     * @return string
     * @throws \RuntimeException
     */
    public function toJson(?callable $transformer = null): string
    {
        $jsonData = json_encode($this->toArray($transformer));

        if ($jsonData === false) {
            throw new \RuntimeException('Error encoding data to JSON.');
        }
        return $jsonData;
    }

    /**
     * Convert the object and its properties to an associative array.
     *
     * @param callable|null $transformer
     * @return array<int|string, mixed> Associative array representing the object's properties.
     */
    public function toArray(?callable $transformer = null): array
    {
        $collection = get_object_vars($this);

        array_walk($collection, function (&$value) use ($transformer) {

            // If a transformer function is provided and is callable, apply it to the property value.
            if ($transformer && is_callable($transformer)) {
                $value = call_user_func($transformer, $value);
            } else if ($this->hasArrayMethod($value)) {
                $value = $value->toArray();
            } else if (is_array($value)) {

                $items = [];
                foreach ($value as $item) {
                    $items[] = $this->hasArrayMethod($item) ? $item->toArray() : $item;
                }
                $value = $items;
            }
        });

        return $collection;
    }

    /**
     * Checks if the given value is an object with a 'toArray' method.
     *
     * @param mixed $value The value to check.
     * @return bool True if the value is an object with a 'toArray' method, false otherwise.
     */
    public function hasArrayMethod($value): bool
    {
        return is_object($value) && method_exists($value, 'toArray');
    }

    /**
     * Provides an iterator for the object using its associative array representation.
     *
     * @param callable|null $transformer optional
     * @return Traversable<mixed>
     */
    public function getIterator(?callable $transformer = null): Traversable
    {
        return new ArrayIterator($this->toArray($transformer));
    }

    public function equals(?object $entity): bool
    {
        if ($entity === null || !($entity instanceof EntityInterface)) {
            return false;
        }

        if (get_class($this) !== get_class($entity)) {
            return false;
        }

        if ($this === $entity) {
            return true;
        }

        return false;
    }
}
