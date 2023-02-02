<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter;

use DragonCode\SizeSorter\Enum\Group;
use DragonCode\SizeSorter\Services\Collection;
use DragonCode\SizeSorter\Services\GroupsDetector;
use DragonCode\SizeSorter\Services\Resolver;
use DragonCode\SizeSorter\Services\Sorter as SorterService;
use DragonCode\Support\Helpers\Ables\Stringable;
use Illuminate\Support\Collection as IlluminateCollection;

class Sorter
{
    public static function sort(IlluminateCollection $items, string $column = 'value'): IlluminateCollection
    {
        return static::handle($items, $column);
    }

    protected static function handle(IlluminateCollection $items, string $column = 'value'): IlluminateCollection
    {
        return static::flatten(
            static::sorting($items, $column)
        );
    }

    public static function sorting(IlluminateCollection $items, string $column = 'value'): IlluminateCollection
    {
        return $items
            ->groupBy(static fn (mixed $size) => static::detectGroup(
                static::resolveValue($size, $column)->toString()
            ), true)
            ->sortKeys()
            ->map(static fn (IlluminateCollection $items, int $group) => static::sortByGroup($items, $group, $column));
    }

    public static function sortByGroup(IlluminateCollection $items, int $group, string $column): IlluminateCollection
    {
        return match ($group) {
            Group::GROUP_1() => static::sortChars($items, $column),
            Group::GROUP_2() => static::sortNumbers($items, $column),
            default          => static::sortArrows($items, $column)
        };
    }

    public static function sortChars(IlluminateCollection $values, string $column): IlluminateCollection
    {
        return $values->groupBy(
            static fn (mixed $size) => static::resolveValue($size, $column)
                ->match('/(s|m|l)/')
                ->toString(),
            true
        )
            ->sortKeysDesc()
            ->map(
                static fn (IlluminateCollection $values, string $group) => $group === 's'
                    ? static::sortSmallSizes($values, $column)
                    : static::sortArrows($values, $column)
            );
    }

    public static function sortSmallSizes(IlluminateCollection $values, string $column): IlluminateCollection
    {
        return $values->sort(
            SorterService::byArrow($column, -1)
        )
            ->groupBy(static fn (mixed $size) => static::resolveValue($size, $column)->toString(), true)
            ->map(static fn (IlluminateCollection $values) => static::sortSpecialChars($values, $column));
    }

    public static function sortSpecialChars(IlluminateCollection $values, string $column): IlluminateCollection
    {
        return $values->sort(
            SorterService::byChars($column)
        );
    }

    public static function sortArrows(IlluminateCollection $values, string $column): IlluminateCollection
    {
        return $values->sort(
            SorterService::byArrow($column)
        );
    }

    public static function sortNumbers(IlluminateCollection $items, string $column): IlluminateCollection
    {
        return $items->sort(
            SorterService::byNumbers($column)
        );
    }

    public static function detectGroup(string $value): int
    {
        return GroupsDetector::detect($value);
    }

    public static function flatten(IlluminateCollection $items): IlluminateCollection
    {
        return Collection::flatten($items);
    }

    public static function resolveValue(mixed $value, string $column): Stringable
    {
        return Resolver::value($value, $column);
    }
}
