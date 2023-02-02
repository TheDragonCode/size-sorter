<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter;

use DragonCode\SizeSorter\Enum\Group;
use DragonCode\SizeSorter\Services\Collection;
use DragonCode\SizeSorter\Services\GroupsDetector;
use DragonCode\SizeSorter\Services\Order;
use DragonCode\SizeSorter\Services\Resolver;
use DragonCode\SizeSorter\Services\Sorter as SorterService;
use DragonCode\Support\Helpers\Ables\Stringable;
use Illuminate\Support\Collection as IC;

class Sorter
{
    public static function sort(IC $items, string $column = 'value', ?array $groupsOrder = null): IC
    {
        return static::flatten(
            static::handle($items, $column, Order::resolve($groupsOrder))
        );
    }

    protected static function handle(IC $items, string $column, array $groupsOrder): IC
    {
        return static::orderGroups(static::sorting($items, $column), $groupsOrder);
    }

    protected static function orderGroups(IC $items, array $order): IC
    {
        $result = static::collect();

        foreach ($order as $key) {
            if ($items->has($key)) {
                $result->put($key, $items->get($key));
            }
        }

        return $result;
    }

    protected static function sorting(IC $items, string $column = 'value'): IC
    {
        return $items
            ->groupBy(static fn (mixed $size) => static::detectGroup(
                static::resolveValue($size, $column)->toString()
            ), true)
            ->map(static fn (IC $items, int $group) => static::sortByGroup($items, $group, $column));
    }

    protected static function sortByGroup(IC $items, int $group, string $column): IC
    {
        return match ($group) {
            Group::GROUP_1() => static::sortChars($items, $column),
            Group::GROUP_2() => static::sortNumbers($items, $column),
            default          => static::sortArrows($items, $column)
        };
    }

    protected static function sortChars(IC $values, string $column): IC
    {
        return $values->groupBy(
            static fn (mixed $size) => static::resolveValue($size, $column)
                ->match('/(s|m|l)/')
                ->toString(),
            true
        )
            ->sortKeysDesc()
            ->map(
                static fn (IC $values, string $group) => $group === 's'
                    ? static::sortSmallSizes($values, $column)
                    : static::sortArrows($values, $column)
            );
    }

    protected static function sortSmallSizes(IC $values, string $column): IC
    {
        return $values->sort(
            SorterService::byArrow($column, -1)
        )
            ->groupBy(static fn (mixed $size) => static::resolveValue($size, $column)->toString(), true)
            ->map(static fn (IC $values) => static::sortSpecialChars($values, $column));
    }

    protected static function sortSpecialChars(IC $values, string $column): IC
    {
        return $values->sort(
            SorterService::byChars($column)
        );
    }

    protected static function sortArrows(IC $values, string $column): IC
    {
        return $values->sort(
            SorterService::byArrow($column)
        );
    }

    protected static function sortNumbers(IC $items, string $column): IC
    {
        return $items->sort(
            SorterService::byNumbers($column)
        );
    }

    protected static function detectGroup(string $value): int
    {
        return GroupsDetector::detect($value);
    }

    protected static function collect(): IC
    {
        return Collection::make();
    }

    protected static function flatten(IC $items): IC
    {
        return Collection::flatten($items);
    }

    protected static function resolveValue(mixed $value, string $column): Stringable
    {
        return Resolver::value($value, $column);
    }
}
