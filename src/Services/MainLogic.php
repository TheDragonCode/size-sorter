<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Services;

use DragonCode\SizeSorter\Enum\Group;
use DragonCode\SizeSorter\Sorters\SorterManager;
use DragonCode\Support\Helpers\Ables\Stringable;
use Illuminate\Support\Collection as IC;

class MainLogic
{
    public static function sort(iterable $items, string $column = 'value', ?array $groupsOrder = null): IC
    {
        return static::flatten(
            static::handle(collect($items), $column, $groupsOrder)
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
            Group::LetterClothingSize->value => static::sortChars($items, $column),
            Group::ClothesAndShoes->value    => static::sortNumbers($items, $column),
            default                          => static::sortArrows($items, $column)
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
            SorterManager::byArrow($column, -1)
        )
            ->groupBy(static fn (mixed $size) => static::resolveValue($size, $column)->toString(), true)
            ->map(static fn (IC $values) => static::sortSpecialChars($values, $column));
    }

    protected static function sortSpecialChars(IC $values, string $column): IC
    {
        return $values->sort(
            SorterManager::byChars($column)
        );
    }

    protected static function sortArrows(IC $values, string $column): IC
    {
        return $values->sort(
            SorterManager::byArrow($column)
        );
    }

    protected static function sortNumbers(IC $items, string $column): IC
    {
        return $items->sort(
            SorterManager::byNumbers($column)
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
