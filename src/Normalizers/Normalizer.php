<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Normalizers;

abstract class Normalizer
{
    abstract public static function normalize(mixed $value): string;
}
