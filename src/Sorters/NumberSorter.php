<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Sorters;

use DragonCode\SizeSorter\Groups\Group;
use Illuminate\Support\Str;

class NumberSorter extends Sorter
{
    protected static array $multiplier = [
        0 => 1000000,
        1 => 1000,
        2 => 1,
    ];

    protected static function extract(int|string $value): array
    {
        return Str::of($value)
            ->afterLast(Group::Delimiter)
            ->explode('_')
            ->map(static fn (int|string $value) => (int) $value)
            ->all();
    }

    protected static function normalize(array $values): int
    {
        foreach ($values as $key => &$value) {
            $value *= static::$multiplier[$key] ?? 1;
        }

        return array_sum($values);
    }
}
