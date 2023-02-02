<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Detectors;

use DragonCode\SizeSorter\Services\Str;

class Group2 extends Base
{
    protected static array|string $pattern = '/^(\d+-?\d*)$/';

    protected static function prepare(string $value): string
    {
        return Str::slug($value);
    }
}
