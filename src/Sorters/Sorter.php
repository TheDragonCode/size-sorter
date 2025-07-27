<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Sorters;

use Closure;

abstract class Sorter
{
    abstract public static function callback(int $arrow = 1): Closure;
}
