<?php
declare (strict_types=1);

namespace Alabra\Entity;

interface EntityInterface
{

    /**
     *
     * @param callable $transformer
     * @return array<mixed>
     */
    public function toArray(callable $transformer = null): array;

    /**
     *
     * @param callable $transformer
     * @return string
     */
    public function toJson(callable $transformer = null): string;
}
