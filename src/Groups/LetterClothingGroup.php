<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Groups;

use DragonCode\SizeSorter\Enums\GroupEnum;
use Illuminate\Support\Str;

use function in_array;
use function preg_match;
use function strlen;

class LetterClothingGroup extends Group
{
    protected static GroupEnum $group = GroupEnum::LetterClothingSize;

    protected static array|string $pattern = '/^(?\'size\'(([2-9]?[x]{1,9}[sml]{1})|([sml])))(_(?1))?$/';

    protected static array $multiplier = [
        's' => 100,
        'm' => 1000,
        'l' => 10000,
    ];

    protected static function prepare(mixed $value): string
    {
        return Str::of($value)
            ->explode('_')
            ->map(static fn (mixed $value) => static::convert($value))
            ->implode('_');
    }

    protected static function convert(mixed $value): string
    {
        if (in_array($value, ['s', 'm', 'l'])) {
            return (string) static::multiply($value, 1);
        }

        if (preg_match('/^(x+)?s$/', $value, $matches)) {
            $count = isset($matches[1]) ? strlen($matches[1]) : 1;

            return (string) static::multiply('s', $count);
        }

        if (preg_match('/^(\d+)xs$/', $value, $matches)) {
            return (string) static::multiply('s', (int) $matches[1], 1);
        }

        if (preg_match('/^(x+)l$/', $value, $matches)) {
            $count = strlen($matches[1]);

            return (string) static::multiply('l', $count);
        }

        if (preg_match('/^(\d+)xl$/', $value, $matches)) {
            return (string) static::multiply('l', (int) $matches[1], 1);
        }

        return '0';
    }

    protected static function multiply(string $key, int $count, int $plus = 0): int
    {
        return static::$multiplier[$key] * $count + $plus;
    }
}
