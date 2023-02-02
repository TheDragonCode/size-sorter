<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Detectors;

use DragonCode\SizeSorter\Contracts\GroupMatcher;
use DragonCode\SizeSorter\Services\Str;

abstract class Base implements GroupMatcher
{
    protected static array|string $pattern;

    public static function detect(string $value): bool
    {
        return Str::match(static::prepare($value), static::$pattern);
    }

    protected static function prepare(string $value): string
    {
        return $value;
    }
}
