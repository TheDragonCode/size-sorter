<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Contracts;

interface Sorter
{
    public static function callback(string $column, int $arrow = 1): callable;
}
