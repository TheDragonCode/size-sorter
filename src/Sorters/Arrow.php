<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Sorters;

class Arrow extends Base
{
    public function callback(string $column, int $arrow = 1): callable
    {
        return function (mixed $a, mixed $b) use ($arrow, $column) {
            $a = $this->key($a, $column);
            $b = $this->key($b, $column);

            if ($a === $b) {
                return 0;
            }

            return $a < $b ? -1 * $arrow : $arrow;
        };
    }
}
