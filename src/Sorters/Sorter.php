<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Sorters;

use Closure;

abstract class Sorter
{
    abstract protected static function extract(int|string $value): array;

    abstract protected static function normalize(array $values): int|string;

    public static function callback(int $arrow = 1): Closure
    {
        return static function (mixed $a, mixed $b) use ($arrow) {
            $a = static::normalize(static::extract($a));
            $b = static::normalize(static::extract($b));

            if ($a === $b) {
                return 0;
            }

            return $a < $b ? -1 * $arrow : $arrow;
        };
    }
}
