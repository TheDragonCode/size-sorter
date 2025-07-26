<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Normalizers;

use Illuminate\Support\Str;

class SizeNormalizer extends BaseNormalizer
{
    public static function get(mixed $value, ?string $column = null): string
    {
        if (Str::match($value, '/(\d+x)/')) {
            return Str::replace('x', '', $value);
        }

        if ($count = Str::substrCount($value, 'x')) {
            return Str::replace(Str::padRight('', $count, 'x'), $count, $value);
        }

        return Str::replace(['s', 'm', 'l'], ['0s', '0m', '0l'], $value);
    }
}
