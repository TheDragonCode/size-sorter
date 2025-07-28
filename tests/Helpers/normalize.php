<?php

declare(strict_types=1);

use DragonCode\SizeSorter\Normalizers\KeyNormalizer;

function normalizeSize(mixed $value): string
{
    return KeyNormalizer::normalize($value);
}
