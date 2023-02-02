<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Sorters;

class Chars extends Base
{
    public function callback(string $column, int $arrow = 1): callable
    {
        return function (mixed $a, mixed $b) use ($column, $arrow) {
            $a = $this->key($a, $column);
            $b = $this->key($b, $column);

            $arrow = $this->contains($a, '/') && $this->contains($b, '-') ? -1 : 1;

            return $this->resolver->callback($this->resolveArrow($arrow, $column), $a, $b);
        };
    }

    protected function resolveArrow(int $arrow, string $column): callable
    {
        return $this->sorter(Arrow::class)->callback($column, $arrow);
    }

    protected function contains(string $value, string $needle): bool
    {
        return $this->str->contains($value, $needle);
    }
}
