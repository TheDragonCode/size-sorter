<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Sorters;

use Closure;
use DragonCode\SizeSorter\Groups\Group;
use Illuminate\Support\Str;

class NumberSorter extends Sorter
{
    public static function callback(int $arrow = 1): Closure
    {
        return static function (mixed $a, mixed $b) use ($arrow) {
            $a = static::extract($a);
            $b = static::extract($b);

            if ($a[0] !== $b[0]) {
                return $a[0] < $b[0] ? -1 * $arrow : $arrow;
            }

            if (! isset($a[1], $b[1])) {
                return 0;
            }

            if ($a[1] === $b[1]) {
                return 0;
            }

            return $a[1] < $b[1] ? -1 * $arrow : $arrow;
        };
    }

    protected static function extract(int|string $value): array
    {
        return Str::of($value)
            ->afterLast(Group::Delimiter)
            ->explode('_')
            ->map(static fn (int|string $value) => (int) $value)
            ->all();
    }
}
