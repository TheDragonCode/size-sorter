<?php

declare(strict_types=1);

namespace Tests\Unit\Detectors;

use DragonCode\SizeSorter\Groups\Group as SizeDetector;
use DragonCode\SizeSorter\Groups\OverallDimensionsGroup;

class OverallDimensionsTest extends Detector
{
    protected SizeDetector|string $detector = OverallDimensionsGroup::class;

    public static function valuesData(): array
    {
        return [
            ['39х38х15 см', true],
            ['40х37х19 см', true],
            ['40х37х20 см', true],
            ['40х38х15 см', true],
            ['40х38х19 sm', true],
            ['40х38х19 см', true],
            ['41х38х15 см', true],

            ['1a'],
            ['1b'],
            ['1c'],
            ['XXS'],
            ['XXS'],
            ['XXS/XS'],
            ['XXS-XS'],
            ['XS'],
            ['XS/S'],
            ['S'],
            ['S/M'],
            ['M'],
            ['M/L'],
            ['L'],
            ['L/XL'],
            ['XL'],
            ['XL/2XL'],
            ['XXL'],
            ['1'],
            ['2'],
            ['3'],
            ['21'],
            [26],
            [28],
            ['30'],
            ['32'],
            ['34'],
            ['36'],
            [37],
            [38],
            ['39'],
            ['40'],
            ['44-46'],
            ['44/46'],
            ['52-56'],
            ['54'],
            ['90/94'],
            ['94-98'],
            ['98-102'],
            ['102-104'],
            ['102-106'],
            ['102/106'],
            ['106'],
            ['110-112'],
            ['110-114'],
            ['70B'],
            ['70C'],
            ['75A'],
            ['75B'],
            ['75C'],
            ['80B'],
            ['ONE SIZE'],
            ['some'],
        ];
    }
}
