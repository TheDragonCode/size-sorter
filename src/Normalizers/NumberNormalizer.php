<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Normalizers;

class NumberNormalizer extends BaseNormalizer
{
    public static function get(mixed $value, ?string $column = null): array
    {
        return static::prepare($value, $column)
            ->replace(['\\', '-'], '/')
            ->explode('/')
            ->map(static fn (mixed $val) => (int) $val)
            ->all();
    }
}
