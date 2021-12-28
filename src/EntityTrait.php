<?php
declare(strict_types=1);

namespace Alabra\Entity;

use Entity\Exception\InvalidArgumentException;
use ArrayIterator;
use Traversable;

trait EntityTrait
{

    /**
     * Get value the $property
     *
     * @param string $property
     * @return $property
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
     * Returns Entity in json format
     * @return json string
     */
    public function toJson(): string
    {
        return json_encode($this->toArray());
    }

    /**
     * Returns Entity in an array key->value
     * @return array
     */
    public function toArray(): array
    {
        return array_filter(get_object_vars($this), function ($key) {
            return $key;
        }, ARRAY_FILTER_USE_KEY);
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->toArray());
    }
}
