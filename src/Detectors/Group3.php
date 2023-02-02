<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Detectors;

use DragonCode\SizeSorter\Services\Str;

class Group3 extends Base
{
    protected static array|string $pattern = '/^(\d+[a-f]{1,2})$/';

    protected static function prepare(string $value): string
    {
        return Str::slug($value);
    }
}
