<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Services;

use DragonCode\Support\Helpers\Ables\Stringable;

class Resolver
{
    public static function key(mixed $value, string $column): mixed
    {
        return $value->{$column} ?? $value[$column] ?? $value;
    }

    public static function value(mixed $value, string $column): Stringable
    {
        return static::prepare($value, $column)
            ->replace(['\\', '-'], '/')
            ->before('/')
            ->lower();
    }

    public static function number(mixed $value, string $column): array
    {
        return static::prepare($value, $column)
            ->replace(['\\', '-'], '/')
            ->explode('/')
            ->map(static fn (mixed $val) => (int) $val)
            ->toArray();
    }

    public static function size(string $value): string
    {
        if (Str::match($value, '/(\d+x)/')) {
            return Str::replace('x', '', $value);
        }

        if ($count = Str::count($value)) {
            return Str::replace($value, Str::pad($count), $count);
        }

        return Str::replace($value, ['s', 'm', 'l'], ['0s', '0m', '0l']);
    }

    public static function callback(callable $callback, mixed ...$parameters): mixed
    {
        return $callback(...$parameters);
    }

    protected static function prepare(mixed $value, string $column): Stringable
    {
        return Str::of(
            static::key($value, $column)
        )
            ->squish()
            ->trim();
    }
}
