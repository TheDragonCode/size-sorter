<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Contracts;

interface Normalizer
{
    public static function get(mixed $value, ?string $column = null): mixed;
}
