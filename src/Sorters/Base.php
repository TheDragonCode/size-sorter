<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Sorters;

use DragonCode\SizeSorter\Contracts\Sorter;
use DragonCode\SizeSorter\Services\Resolver;
use DragonCode\SizeSorter\Services\Str;

abstract class Base implements Sorter
{
    public function __construct(
        protected Resolver $resolver = new Resolver(),
        protected Str      $str = new Str()
    ) {
    }

    protected function key(mixed $value, string $column): mixed
    {
        return $this->resolver->key($value, $column);
    }

    protected function sorter(string $sorter): Base
    {
        return new $sorter($this->resolver, $this->str);
    }
}
