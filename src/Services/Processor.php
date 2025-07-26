<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Services;

use Closure;
use DragonCode\SizeSorter\Enums\GroupEnum;
use DragonCode\SizeSorter\Groups\Group;
use DragonCode\SizeSorter\Sorters\CharSorter;
use DragonCode\SizeSorter\Support\Map;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Processor
{
    public function run(Collection $items, Closure $column, array $orderBy): Collection
    {
        return $this->map($items, $column)
            ->groupBy(fn (mixed $value, string $key) => $this->detectGroup($key), true)
            ->map(fn (Collection $values, int $group) => $values->sortKeysUsing(
                $this->sort($group)
            ))
            ->dd();
    }

    protected function sort(int $group): Closure
    {
        return match ($group) {
            GroupEnum::LetterClothingSize->value => CharSorter::callback(),
            GroupEnum::ClothesAndShoes->value    => 2,
            GroupEnum::BraSize->value            => 3,
            GroupEnum::OverallDimensions->value  => 4,
            GroupEnum::OtherSizes->value         => 5,
        };
    }

    protected function detectGroup(string $key): int
    {
        return (int) Str::before($key, Group::Delimiter);
    }

    protected function map(Collection $items, Closure $column): Collection
    {
        return Map::make($items, $column);
    }
}
