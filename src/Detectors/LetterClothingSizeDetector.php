<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Detectors;

class LetterClothingSizeDetector extends BaseDetector
{
    protected static array|string $pattern = '/^(x*[sml])$/';
}
