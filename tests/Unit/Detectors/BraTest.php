<?php

declare(strict_types=1);

namespace Tests\Unit\Detectors;

use DragonCode\SizeSorter\Groups\BraGroup;
use DragonCode\SizeSorter\Groups\Group as SizeDetector;

class BraTest extends Detector
{
    protected SizeDetector|string $detector = BraGroup::class;

    public static function valuesData(): array
    {
        return [
            ['70B', true],
            ['70C', true],
            ['75A', true],
            ['75B', true],
            ['75C', true],
            ['80B', true],

            ['XXS'],
            ['XXS'],
            ['XXS/XS'],
            ['XXS-XS'],
            ['1'],
            ['2'],
            [26],
            [28],
            ['44-46'],
            ['44/46'],
            ['52-56'],
            ['40х38х15 см'],
            ['40х38х19 sm'],
            ['ONE SIZE'],
            ['some'],
        ];
    }
}
