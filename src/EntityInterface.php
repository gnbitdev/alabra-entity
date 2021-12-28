<?php
declare (strict_types=1);

namespace Alabra\Entity;

use Iterator;

interface EntityInterface extends Iterator
{
    public function toArray(): array;

    public function toJson(): string;
}
