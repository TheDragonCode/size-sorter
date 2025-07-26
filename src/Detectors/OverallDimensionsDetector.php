<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Detectors;

use DragonCode\SizeSorter\Normalizers\SizeNormalizer;
use Illuminate\Support\Str;

class OverallDimensionsDetector extends BaseDetector
{
    protected static array|string $pattern = [
        '/^([\d\-hx\*]*0s0m)$/',
        '/^(\d+[a-f])$/',
    ];

    protected static function prepare(string $value): string
    {
        return Str::of($value)
            ->squish()
            ->trim()
            ->replace('\\', '/')
            ->explode('/')
            ->map(static fn (string $value) => static::compact($value))
            ->implode('/');
    }

    protected static function compact(string $value): string
    {
        return Str::of($value)
            ->slug()
            ->explode('-')
            ->map(static fn (string $value) => SizeNormalizer::get($value))
            ->implode('-');
    }
}
