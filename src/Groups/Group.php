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

    public static function detect(string $value): bool
    {
        return Str::isMatch(static::$pattern, $value);
    }

    public static function normalize(mixed $value, int|string $key): string
    {
        return implode(static::Delimiter, [static::$group->value, $key, static::prepare($value)]);
    }

    protected static function prepare(mixed $value): string
    {
        return $value;
    }
}
