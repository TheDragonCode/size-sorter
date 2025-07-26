<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter;

use DragonCode\SizeSorter\Enum\Group;
use DragonCode\SizeSorter\Services\MainLogic;
use DragonCode\SizeSorter\Services\Order;
use DragonCode\SizeSorter\Support\Validator;

class SizeSorter
{
    protected string $column = 'value';

    protected ?array $orderBy = null;

    public static function items(iterable $items): static
    {
        return new static($items);
    }

    public function __construct(
        protected readonly iterable $items,
        protected readonly Order $order = new Order()
    ) {}

    public function column(string $name): static
    {
        $this->column = $name;

        return $this;
    }

    /**
     * @param  Group[]|null  $order
     *
     * @return $this
     */
    public function orderBy(?array $order): static
    {
        Validator::ensure($order, Group::class);

        $this->orderBy = $this->order->resolve($order);

        return $this;
    }

    public function sort(): iterable
    {
        return MainLogic::sort($this->items, $this->column, $this->getOrderBy());
    }

    protected function getOrderBy(): ?array
    {
        return $this->orderBy ?? $this->order->resolve();
    }
}
