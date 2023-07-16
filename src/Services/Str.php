<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Services;

use DragonCode\Support\Facades\Helpers\Str as DS;
use DragonCode\Support\Helpers\Ables\Stringable;

class Str
{
    public static function of(mixed $value): Stringable
    {
        return DS::of((string) $value);
    }

    public static function pad(int $length, string $pad = 'x'): string
    {
        return str_pad('', $length, $pad);
    }

    public static function replace(string $value, array|string $search, array|int|string $replace): string
    {
        return DS::replace($value, $search, $replace);
    }

    public static function contains(string $value, string $needle): bool
    {
        return DS::contains($value, $needle);
    }

    public static function match(string $value, array|string $pattern): bool
    {
        return DS::matchContains($value, $pattern);
    }

    public static function slug(string $value): string
    {
        return DS::slug($value);
    }

    public static function count(string $value, string $needle = 'x'): int
    {
        return DS::count($value, $needle);
    }
}
