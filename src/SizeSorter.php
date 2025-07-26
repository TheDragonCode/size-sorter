<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter;

use DragonCode\SizeSorter\Enum\Group;
use DragonCode\SizeSorter\Services\Order;
use DragonCode\SizeSorter\Services\Processor;
use DragonCode\SizeSorter\Support\Validator;
use Illuminate\Support\Collection;

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
        protected readonly Order $order = new Order,
        protected readonly Processor $processor = new Processor,
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
    public function orderBy(?array $order): static
    {
        Validator::ensure($order, Group::class);

        $this->orderBy = $order;

        return $this;
    }

    public function sort(): Collection
    {
        return $this->processor->run(
            $this->getItems(),
            $this->getColumn(),
            $this->getOrderBy()
        );
    }

    protected function getItems(): Collection
    {
        return new Collection($this->items);
    }

    protected function getColumn(): string
    {
        return $this->column;
    }

    protected function getOrderBy(): ?array
    {
        return $this->order->resolve(
            $this->orderBy
        );
    }
}
