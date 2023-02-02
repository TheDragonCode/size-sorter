<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Detectors;

class Group2 extends Base
{
    protected array|string $pattern = '/^(\d+-?\d*)$/';

    protected function prepare(string $value): string
    {
        return $this->str->slug($value);
    }
}
