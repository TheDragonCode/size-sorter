<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Sorters;

class Numbers extends Base
{
    public function callback(string $column, int $arrow = 1): callable
    {
        return function (mixed $a, mixed $b) use ($column, $arrow) {
            $a = $this->number($a, $column);
            $b = $this->number($b, $column);

            if ($a[0] === $b[0]) {
                if (isset($a[1], $b[1])) {
                    if ($a[1] === $b[1]) {
                        return 0;
                    }

                    return $a[1] < $b[1] ? -1 * $arrow : $arrow;
                }
            }

            return $a[0] < $b[0] ? -1 * $arrow : $arrow;
        };
    }

    protected function number(mixed $value, string $column): array
    {
        return $this->resolver->number($value, $column);
    }
}
