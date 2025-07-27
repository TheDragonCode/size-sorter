<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Sorters;

use Closure;

class ArrowSorter extends Sorter
{
    public static function callback(int $arrow = 1): Closure
    {
        return static function (mixed $a, mixed $b) use ($arrow) {
            if ($a === $b) {
                return 0;
            }

            return $a < $b ? -1 * $arrow : $arrow;
        };
    }
}
