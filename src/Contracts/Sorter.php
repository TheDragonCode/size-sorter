<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Contracts;

interface Sorter
{
    public static function get(string $column, int $arrow = 1): callable;
}
