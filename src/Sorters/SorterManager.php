<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Sorters;

class SorterManager
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
