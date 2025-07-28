<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Groups;

use DragonCode\SizeSorter\Enums\GroupEnum;
use Illuminate\Support\Str;

use function ord;

class BraGroup extends Group
{
    protected static GroupEnum $group = GroupEnum::BraSize;

    protected static array|string $pattern = '/^(\d+[a-f]{1,2})$/';

    protected static function prepare(mixed $value): string
    {
        return Str::of($value)
            ->explode('_')
            ->map(static fn (mixed $value) => static::convert($value))
            ->implode('_');
    }

    protected static function convert(mixed $value): string
    {
        $char = Str::match('/\D/', $value);

        return Str::replace($char, static::charToNumber($char), $value);
    }

    protected static function charToNumber(string $char): int
    {
        return ord($char) - ord('a') + 1;
    }
}
