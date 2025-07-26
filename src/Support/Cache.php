<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Support;

use Closure;
use Stringable;

class Cache
{
    public static array $registry = [];

    public static function remember(string|Stringable $value, Closure $callback): string
    {
        return static::$registry[(string) $value] ??= $callback();
    }

    public static function clear(): void
    {
        static::$registry = [];
    }
}
