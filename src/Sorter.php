<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter;

use DragonCode\SizeSorter\Enum\Groups;
use DragonCode\SizeSorter\Services\Collection;
use DragonCode\SizeSorter\Services\GroupsDetector;
use DragonCode\SizeSorter\Services\Resolver;
use DragonCode\SizeSorter\Services\Sorter as SorterService;
use DragonCode\Support\Helpers\Ables\Stringable;
use Illuminate\Support\Collection as IlluminateCollection;

class Sorter
{
    public function __construct(
        protected GroupsDetector $groupsDetector = new GroupsDetector(),
        protected Collection $collection = new Collection(),
        protected Resolver $resolver = new Resolver(),
        protected SorterService $sorter = new SorterService()
    ) {
    }

    public static function sort(IlluminateCollection $items, string $column = 'value'): IlluminateCollection
    {
        return (new static())->handle($items, $column);
    }

    protected function handle(IlluminateCollection $items, string $column = 'value'): IlluminateCollection
    {
        return $this->flatten(
            $this->sorting($items, $column)
        );
    }

    protected function sorting(IlluminateCollection $items, string $column = 'value'): IlluminateCollection
    {
        return $items
            ->groupBy(fn (mixed $size) => $this->detectGroup(
                $this->resolveValue($size, $column)->toString()
            ), true)
            ->sortKeys()
            ->map(fn (IlluminateCollection $items, int $group) => $this->sortByGroup($items, $group, $column));
    }

    protected function sortByGroup(IlluminateCollection $items, int $group, string $column): IlluminateCollection
    {
        return match ($group) {
            Groups::GROUP_1() => $this->sortChars($items, $column),
            Groups::GROUP_2() => $this->sortNumbers($items, $column),
            default           => $this->sortArrows($items, $column)
        };
    }

    protected function sortChars(IlluminateCollection $values, string $column): IlluminateCollection
    {
        return $values->groupBy(
            fn (mixed $size) => $this->resolveValue($size, $column)
                ->match('/(s|m|l)/')
                ->toString(),
            true
        )
            ->sortKeysDesc()
            ->map(
                fn (IlluminateCollection $values, string $group) => $group === 's'
                ? $this->sortSmallSizes($values, $column)
                : $this->sortArrows($values, $column)
            );
    }

    protected function sortSmallSizes(IlluminateCollection $values, string $column): IlluminateCollection
    {
        return $values->sort(
            $this->sorter->byArrow($column, -1)
        )
            ->groupBy(fn (mixed $size) => $this->resolveValue($size, $column)->toString(), true)
            ->map(fn (IlluminateCollection $values) => $this->sortSpecialChars($values, $column));
    }

    protected function sortSpecialChars(IlluminateCollection $values, string $column): IlluminateCollection
    {
        return $values->sort(
            $this->sorter->byChars($column)
        );
    }

    protected function sortArrows(IlluminateCollection $values, string $column): IlluminateCollection
    {
        return $values->sort(
            $this->sorter->byArrow($column)
        );
    }

    protected function sortNumbers(IlluminateCollection $items, string $column): IlluminateCollection
    {
        return $items->sort(
            $this->sorter->byNumbers($column)
        );
    }

    protected function detectGroup(string $value): int
    {
        return $this->groupsDetector->detect($value);
    }

    protected function flatten(IlluminateCollection $items): IlluminateCollection
    {
        return $this->collection->flatten($items);
    }

    protected function resolveValue(mixed $value, string $column): Stringable
    {
        return $this->resolver->value($value, $column);
    }
}
