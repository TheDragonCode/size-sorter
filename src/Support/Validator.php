<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Support;

use Illuminate\Support\Collection;

class Validator
{
    public static function ensure(?iterable $items, string $class): void
    {
        (new Collection($items))->ensure($class);
    }
}
