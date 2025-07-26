<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Contracts;

interface Detector
{
    public static function detect(string $value): bool;
}
