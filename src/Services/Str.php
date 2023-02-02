<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Services;

use DragonCode\Support\Facades\Helpers\Str as DS;
use DragonCode\Support\Helpers\Ables\Stringable;

class Str
{
    public function of(?string $value): Stringable
    {
        return DS::of($value);
    }

    public function pad(int $length, string $pad = 'x'): string
    {
        return str_pad('', $length, $pad);
    }

    public function replace(string $value, array|string $search, array|string|int $replace): string
    {
        return DS::replace($value, $search, $replace);
    }

    public function contains(string $value, string $needle): bool
    {
        return DS::contains($value, $needle);
    }

    public function match(string $value, array|string $pattern): bool
    {
        return DS::matchContains($value, $pattern);
    }

    public function slug(string $value): string
    {
        return DS::slug($value);
    }

    public function count(string $value, string $needle = 'x'): int
    {
        return DS::count($value, $needle);
    }
}
