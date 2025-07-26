<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Services;

use ArrayAccess;
use BackedEnum;
use DragonCode\Support\Facades\Helpers\Arr;
use DragonCode\Support\Helpers\Ables\Stringable;
use Stringable as BaseStringable;

class Resolver
{
    public static function key(mixed $value, string $column): mixed
    {
        return match (true) {
            $value instanceof BackedEnum => self::fromEnum($value),
            $value instanceof ArrayAccess,
            is_array($value)                 => self::fromArray($value, $column),
            $value instanceof BaseStringable => self::fromStringable($value),
            default                          => $value->{$column} ?? $value
        };
    }

    public static function value(mixed $value, string $column): Stringable
    {
        return static::prepare($value, $column)
            ->replace(['\\', '-'], '/')
            ->before('/')
            ->lower();
    }

    public static function callback(callable $callback, mixed ...$parameters): mixed
    {
        return $callback(...$parameters);
    }

    protected static function prepare(mixed $value, string $column): Stringable
    {
        return Str::of(
            static::key($value, $column)
        )->squish()->trim();
    }

    protected static function fromEnum(BackedEnum $item): mixed
    {
        return $item->value ?? $item->name;
    }

    protected static function fromStringable(BaseStringable $item): mixed
    {
        return method_exists($item, 'toString') ? $item->toString() : (string) $item;
    }

    protected static function fromArray(mixed $item, string $column): mixed
    {
        return Arr::get($item, $column, $item);
    }
}
