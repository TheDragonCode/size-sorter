<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Detectors;

class Group3 extends Base
{
    protected array|string $pattern = '/^(\d+[a-f]{1,2})$/';

    protected function prepare(string $value): string
    {
        return $this->str->slug($value);
    }
}
