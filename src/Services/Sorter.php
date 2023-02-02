<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Services;

use DragonCode\SizeSorter\Sorters\Arrow;
use DragonCode\SizeSorter\Sorters\Chars;
use DragonCode\SizeSorter\Sorters\Numbers;

class Sorter
{
    public static function byArrow(string $column, int $arrow = 1): callable
    {
        return Arrow::callback($column, $arrow);
    }

    public static function byChars(string $column, int $arrow = 1): callable
    {
        return Chars::callback($column, $arrow);
    }

    public static function byNumbers(string $column, int $arrow = 1): callable
    {
        return Numbers::callback($column, $arrow);
    }
}
