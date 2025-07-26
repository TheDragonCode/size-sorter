<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter;

use DragonCode\SizeSorter\Enum\Group;
use DragonCode\SizeSorter\Services\MainLogic;

class Sorter
{
    protected string $column = 'value';

    protected ?array $groupsOrder = null;

    public static function same(iterable $items): static
    {
        return new static($items);
    }

    public function __construct(
        protected readonly iterable $items
    ) {}

    public function column(string $name): static
    {
        $this->column = $name;

        return $this;
    }

    /**
     * @param  Group[]|null  $order
     * @return $this
     */
    public function groupsOrder(?array $order): static
    {
        $this->groupsOrder = $order;

        return $this;
    }

    public function sort1(): iterable
    {
        return MainLogic::sort($this->items, $this->column, $this->groupsOrder);
    }
}
