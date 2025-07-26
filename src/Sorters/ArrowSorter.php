<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Sorters;

class ArrowSorter extends BaseSorter
{
    public static function get(string $column, int $arrow = 1): callable
    {
        return static function (mixed $a, mixed $b) use ($arrow, $column) {
            $a = static::key($a, $column);
            $b = static::key($b, $column);

            if ($a === $b) {
                return 0;
            }

            return $a < $b ? -1 * $arrow : $arrow;
        };
    }
}
