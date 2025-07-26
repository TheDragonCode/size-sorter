<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Sorters;

use DragonCode\SizeSorter\Services\Resolver;
use DragonCode\SizeSorter\Services\Str;

class CharSorter extends BaseSorter
{
    public static function get(string $column, int $arrow = 1): callable
    {
        return static function (mixed $a, mixed $b) use ($column, $arrow) {
            $a = static::key($a, $column);
            $b = static::key($b, $column);

            $arrow = static::contains($a, '/') && static::contains($b, '-') ? -1 : 1;

            return Resolver::callback(static::resolveArrow($arrow, $column), $a, $b);
        };
    }

    protected static function resolveArrow(int $arrow, string $column): callable
    {
        return ArrowSorter::get($column, $arrow);
    }

    protected static function contains(string $value, string $needle): bool
    {
        return Str::contains($value, $needle);
    }
}
