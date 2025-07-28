<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Services;

use Closure;
use DragonCode\SizeSorter\Enums\GroupEnum;
use DragonCode\SizeSorter\Groups\Group;
use DragonCode\SizeSorter\Support\Map;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Processor
{
    public function __construct(
        protected Sort $sort = new Sort
    ) {}

    public function run(Collection $items, Closure $column, array $orderBy): Collection
    {
        $sorted = $this->sortItems($items, $column);

        $map = $this->sortGroups($sorted, $orderBy);

        return Map::apply($items, $map);
    }

    protected function sortItems(Collection $items, Closure $column): Collection
    {
        return $this->map($items, $column)
            ->groupBy(fn (mixed $value, string $key) => $this->detectGroup($key), true)
            ->map(fn (Collection $values, int $group) => $this->sortPerGroup($values, $group));
    }

    protected function sortGroups(Collection $items, array $orderBy): Collection
    {
        return Collection::make($orderBy)->map(
            fn (GroupEnum $group) => $items->get($group->value)
        )->collapseWithKeys();
    }

    protected function sortPerGroup(Collection $items, int $group): Collection
    {
        return $group === GroupEnum::OtherSizes->value
            ? $this->sort->byAlphabet($items)
            : $this->sort->byNumber($items);
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
