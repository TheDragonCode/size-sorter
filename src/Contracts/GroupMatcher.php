<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Contracts;

interface GroupMatcher
{
    public static function detect(string $value): bool;
}
