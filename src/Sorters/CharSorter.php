<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Sorters;

use DragonCode\SizeSorter\Groups\Group;
use Illuminate\Support\Str;

use function implode;

class CharSorter extends Sorter
{
    protected static function extract(int|string $value): array
    {
        return Str::of($value)
            ->afterLast(Group::Delimiter)
            ->explode('_')
            ->map(static fn (int|string $value) => (string) $value)
            ->all();
    }

    protected static function normalize(array $values): string
    {
        return implode('_', $values);
    }
}
