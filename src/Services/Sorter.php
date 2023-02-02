<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Services;

use DragonCode\SizeSorter\Sorters\Arrow;
use DragonCode\SizeSorter\Sorters\Base;
use DragonCode\SizeSorter\Sorters\Chars;
use DragonCode\SizeSorter\Sorters\Numbers;

class Sorter
{
    protected array $registry = [];

    public function __construct(
        protected Resolver $resolver = new Resolver(),
        protected Str $str = new Str()
    ) {
    }

    public function byArrow(string $column, int $arrow = 1): callable
    {
        return $this->resolve(Arrow::class)->callback($column, $arrow);
    }

    public function byChars(string $column, int $arrow = 1): callable
    {
        return $this->resolve(Chars::class)->callback($column, $arrow);
    }

    public function byNumbers(string $column, int $arrow = 1): callable
    {
        return $this->resolve(Numbers::class)->callback($column, $arrow);
    }

    protected function resolve(string $class): Base
    {
        if (isset($this->registry[$class])) {
            return $this->registry[$class];
        }

        return $this->registry[$class] = new $class($this->resolver, $this->str);
    }
}
