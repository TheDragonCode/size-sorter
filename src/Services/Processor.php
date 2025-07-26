<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Services;

use DragonCode\SizeSorter\Enum\Group;
use DragonCode\SizeSorter\Sorters\ArrowSorter;
use DragonCode\SizeSorter\Sorters\CharSorter;
use DragonCode\SizeSorter\Sorters\NumberSorter;
use DragonCode\Support\Helpers\Ables\Stringable;
use Illuminate\Support\Collection;

class Processor
{
    public function run(Collection $items, string $column = 'value', ?array $groupsOrder = null): Collection
    {
        return static::flatten(
            static::handle($items, $column, $groupsOrder)
        );
    }

    protected static function handle(Collection $items, string $column, array $groupsOrder): Collection
    {
        return static::orderGroups(static::sorting($items, $column), $groupsOrder);
    }

    protected static function orderGroups(Collection $items, array $order): Collection
    {
        $result = static::collect();

        foreach ($order as $key) {
            if ($items->has($key)) {
                $result->put($key, $items->get($key));
            }
        }

        return $result;
    }

    protected static function sorting(Collection $items, string $column = 'value'): Collection
    {
        return $items
            ->groupBy(static fn (mixed $size) => static::detectGroup(
                static::resolveValue($size, $column)->toString()
            ), true)
            ->map(static fn (Collection $items, int $group) => static::sortByGroup($items, $group, $column));
    }

    protected static function sortByGroup(Collection $items, int $group, string $column): Collection
    {
        return match ($group) {
            Group::LetterClothingSize->value => static::sortChars($items, $column),
            Group::ClothesAndShoes->value    => static::sortNumbers($items, $column),
            default                          => static::sortArrows($items, $column)
        };
    }

    protected static function sortChars(Collection $values, string $column): Collection
    {
        return $values->groupBy(
            static fn (mixed $size) => static::resolveValue($size, $column)
                ->match('/(s|m|l)/')
                ->toString(),
            true
        )
            ->sortKeysDesc()
            ->map(
                static fn (Collection $values, string $group) => $group === 's'
                    ? static::sortSmallSizes($values, $column)
                    : static::sortArrows($values, $column)
            );
    }

    protected static function sortSmallSizes(Collection $values, string $column): Collection
    {
        return $values->sort(
            ArrowSorter::get($column, -1)
        )
            ->groupBy(static fn (mixed $size) => static::resolveValue($size, $column)->toString(), true)
            ->map(static fn (Collection $values) => static::sortSpecialChars($values, $column));
    }

    protected static function sortSpecialChars(Collection $values, string $column): Collection
    {
        return $values->sort(
            CharSorter::get($column)
        );
    }

    protected static function sortArrows(Collection $values, string $column): Collection
    {
        return $values->sort(
            ArrowSorter::get($column)
        );
    }

    protected static function sortNumbers(Collection $items, string $column): Collection
    {
        return $items->sort(
            NumberSorter::get($column)
        );
    }

    protected static function detectGroup(string $value): int
    {
        return GroupsDetector::detect($value);
    }

    protected static function collect(): Collection
    {
        return Collection1::make();
    }

    protected static function flatten(Collection $items): Collection
    {
        return Collection1::flatten($items);
    }

    protected static function resolveValue(mixed $value, string $column): Stringable
    {
        return Resolver::value($value, $column);
    }
}
