<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Groups;

use DragonCode\SizeSorter\Enums\GroupEnum;
use Illuminate\Support\Str;

use function array_keys;
use function array_values;
use function preg_replace_callback;
use function str_repeat;

class LetterClothingGroup extends Group
{
    protected static GroupEnum $group = GroupEnum::LetterClothingSize;

    protected static array|string $pattern = '/^(?\'size\'(([2-9]?[x]{1,9}[sml]{1})|([sml])))(_(?1))?$/';

    public static function normalize(mixed $value, int|string $key): string
    {
        if (! static::containsNumber($value)) {
            return parent::normalize($value . '0', $key);
        }

        $matches = static::match($value);

        $value = Str::replace(
            array_keys($matches),
            array_values($matches),
            $value
        );

        return parent::normalize($value . '1', $key);
    }

    protected static function containsNumber(string $value): bool
    {
        return Str::isMatch('/\d/', $value);
    }

    protected static function match(string $value): array
    {
        return Str::of($value)
            ->matchAll('/\dx/')
            ->mapWithKeys(static function (string $item) {
                $replace = preg_replace_callback('/(\d)x/', function (array $matches) {
                    return str_repeat('x', (int) $matches[1]);
                }, $item);

                return [$item => $replace];
            })
            ->all();
    }
}
