<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Normalizers;

use ArrayAccess;
use BackedEnum;
use DragonCode\SizeSorter\Contracts\Normalizer;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

abstract class BaseNormalizer implements Normalizer
{
    protected static function prepare(mixed $value, string $column): Stringable
    {
        return Str::of(
            static::key($value, $column)
        )->squish()->trim();
    }

    protected static function key(mixed $value, string $column): mixed
    {
        return match (true) {
            $value instanceof BackedEnum => self::fromEnum($value),
            $value instanceof ArrayAccess,
            is_array($value)              => self::fromArray($value, $column),
            $value instanceof \Stringable => self::fromStringable($value),
            default                       => $value->{$column} ?? $value
        };
    }

    protected static function fromEnum(BackedEnum $item): int|string
    {
        return $item->value ?? $item->name;
    }

    protected static function fromStringable(\Stringable $item): mixed
    {
        return method_exists($item, 'toString') ? $item->toString() : (string) $item;
    }

    protected static function fromArray(mixed $item, string $column): mixed
    {
        return Arr::get($item, $column, $item);
    }
}
