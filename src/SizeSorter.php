<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter;

use Closure;
use DragonCode\SizeSorter\Enums\GroupEnum;
use DragonCode\SizeSorter\Services\Processor;
use DragonCode\SizeSorter\Support\GroupOrder;
use DragonCode\SizeSorter\Support\Resolve;
use DragonCode\SizeSorter\Support\Validator;
use Illuminate\Support\Collection;

class SizeSorter
{
    protected Closure|string $column = 'value';

    protected ?iterable $orderBy = null;

    public static function items(iterable $items): static
    {
        return new static($items);
    }

    public function __construct(
        protected readonly iterable $items,
        protected readonly Processor $processor = new Processor,
    ) {}

    public function column(Closure|string $name): static
    {
        $this->column = $name;

        return $this;
    }

    /**
     * @param  GroupEnum[]|null  $order
     * @return $this
     */
    public function orderBy(?iterable $order): static
    {
        if (empty($order)) {
            return $this;
        }

        Validator::ensure($order, GroupEnum::class);

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

    protected function getColumn(): Closure
    {
        if ($this->column instanceof Closure) {
            return $this->column;
        }

        return fn (mixed $item) => Resolve::value($item, $this->column);
    }

    protected function getOrderBy(): array
    {
        return GroupOrder::get(
            $this->orderBy
        );
    }
}
