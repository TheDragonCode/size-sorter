<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Groups;

use DragonCode\SizeSorter\Enums\GroupEnum;
use Illuminate\Support\Str;

use function implode;

abstract class Group
{
    public const Delimiter = '::';

    protected static GroupEnum $group;

    protected static array|string $pattern;

    protected static array|string|null $exceptPattern = null;

    public static function detect(string $value): bool
    {
        if (static::$exceptPattern && Str::isMatch(static::$exceptPattern, $value)) {
            return false;
        }

        return Str::isMatch(static::$pattern, $value);
    }

    public static function normalize(mixed $value, int|string $key): string
    {
        return implode(static::Delimiter, [static::$group->value, $key, static::prepare($value)]);
    }

    protected static function prepare(mixed $value): string
    {
        return (string) $value;
    }
}
