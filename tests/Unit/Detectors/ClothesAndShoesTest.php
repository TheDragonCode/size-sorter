<?php

declare(strict_types=1);

namespace Tests\Unit\Detectors;

use DragonCode\SizeSorter\Groups\ClothesAndShoesGroup;
use DragonCode\SizeSorter\Groups\Group as SizeDetector;

class ClothesAndShoesTest extends Detector
{
    protected SizeDetector|string $detector = ClothesAndShoesGroup::class;

    public static function valuesData(): array
    {
        return [
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
            ['70B'],
            ['70C'],
            ['75A'],
            ['75B'],
            ['75C'],
            ['80B'],
            ['39х38х15 см'],
            ['40х37х19 см'],
            ['40х37х20 см'],
            ['40х38х15 см'],
            ['40х38х19 sm'],
            ['40х38х19 см'],
            ['41х38х15 см'],
            ['ONE SIZE'],
            ['some'],
        ];
    }
}
