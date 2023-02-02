<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Detectors;

use DragonCode\SizeSorter\Services\Resolver;
use DragonCode\SizeSorter\Services\Str;

class Group4 extends Base
{
    protected static array|string $pattern = [
        '/^([\d\-hx\*]*0s0m)$/',
        '/^(\d+[a-f])$/',
    ];

    protected static function prepare(string $value): string
    {
        return Str::of($value)
            ->squish()
            ->trim()
            ->replace('\\', '/')
            ->explode('/')
            ->map(static fn (string $value) => static::compact($value))
            ->implode('/')
            ->toString();
    }

    protected static function compact(string $value): string
    {
        return Str::of($value)
            ->slug()
            ->explode('-')
            ->map(static fn (string $value) => Resolver::size($value))
            ->implode('-')
            ->toString();
    }
}
