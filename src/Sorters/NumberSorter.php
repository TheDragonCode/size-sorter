<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Sorters;

use DragonCode\SizeSorter\Normalizers\NumberNormalizer;

class NumberSorter extends BaseSorter
{
    public static function get(string $column, int $arrow = 1): callable
    {
        return static function (mixed $a, mixed $b) use ($column, $arrow) {
            $a = static::number($a, $column);
            $b = static::number($b, $column);

            if ($a[0] !== $b[0]) {
                return $a[0] < $b[0] ? -1 * $arrow : $arrow;
            }

            if (isset($a[1], $b[1])) {
                if ($a[1] === $b[1]) {
                    return 0;
                }

                return $a[1] < $b[1] ? -1 * $arrow : $arrow;
            }

            return 0;
        };
    }

    protected static function number(mixed $value, string $column): array
    {
        return NumberNormalizer::get($value, $column);
    }
}
