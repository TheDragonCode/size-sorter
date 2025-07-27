<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Sorters;

use Closure;
use Illuminate\Support\Str;

class CharSorter extends Sorter
{
    public static function callback(int $arrow = 1): Closure
    {
        return static function (mixed $a, mixed $b) use ($arrow) {
            $arrow = static::contains($a, '_') ? -1 : 1;

            return ArrowSorter::callback($arrow)($a, $b);
        };
    }

    protected static function contains(string $haystack, string $needle): bool
    {
        return Str::contains($haystack, $needle);
    }
}
