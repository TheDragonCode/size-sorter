<?php

declare(strict_types=1);

namespace Tests\Unit\Detectors;

use DragonCode\SizeSorter\Groups\Group as SizeDetector;
use DragonCode\SizeSorter\Groups\OtherGroup;

class OtherTest extends Detector
{
    protected SizeDetector|string $detector = OtherGroup::class;

    public static function valuesData(): array
    {
        return [
            ['XXS', true],
            ['XXS', true],
            ['XXS/XS', true],
            ['XXS-XS', true],
            ['XS', true],
            ['XS/S', true],
            ['S', true],
            ['S/M', true],
            ['M', true],
            ['M/L', true],
            ['L', true],
            ['L/XL', true],
            ['XL', true],
            ['XL/2XL', true],
            ['XXL', true],
            ['1', true],
            ['2', true],
            ['3', true],
            ['21', true],
            [26, true],
            [28, true],
            ['30', true],
            ['32', true],
            ['34', true],
            ['36', true],
            [37, true],
            [38, true],
            ['39', true],
            ['40', true],
            ['44-46', true],
            ['44/46', true],
            ['52-56', true],
            ['54', true],
            ['90/94', true],
            ['94-98', true],
            ['98-102', true],
            ['102-104', true],
            ['102-106', true],
            ['102/106', true],
            ['106', true],
            ['110-112', true],
            ['110-114', true],
            ['70B', true],
            ['70C', true],
            ['75A', true],
            ['75B', true],
            ['75C', true],
            ['80B', true],
            ['39х38х15 см', true],
            ['40х37х19 см', true],
            ['40х37х20 см', true],
            ['40х38х15 см', true],
            ['40х38х19 sm', true],
            ['40х38х19 см', true],
            ['41х38х15 см', true],
            ['ONE SIZE', true],
            ['some', true],
        ];
    }
}
