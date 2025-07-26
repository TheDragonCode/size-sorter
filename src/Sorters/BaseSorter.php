<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Sorters;

use DragonCode\SizeSorter\Contracts\Sorter;
use DragonCode\SizeSorter\Services\Resolver;

abstract class BaseSorter implements Sorter
{
    protected static function key(mixed $value, string $column): mixed
    {
        return Resolver::key($value, $column);
    }
}
