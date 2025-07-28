<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Sorters;

use Closure;

use function array_sum;

abstract class Sorter
{
    protected static array $multiplier = [
        0 => 1000000,
        1 => 1000,
        2 => 1,
    ];

    abstract protected static function extract(int|string $value): array;

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

    protected static function normalize(array $values): int
    {
        foreach ($values as $key => &$value) {
            $value *= static::$multiplier[$key] ?? 1;
        }

        return array_sum($values);
    }
}
