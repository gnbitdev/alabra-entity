<?php
declare (strict_types=1);

namespace Alabra\Entity;

interface EntityInterface
{
    public function toArray(): array;

    public function toJson(): string;
}
