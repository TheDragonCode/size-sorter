<?php

declare(strict_types=1);

namespace Tests\Unit\Detectors;

use DragonCode\SizeSorter\Groups\Group as SizeDetector;
use DragonCode\SizeSorter\Groups\LetterClothingGroup;

class LetterClothingTest extends Detector
{
    protected SizeDetector|string $detector = LetterClothingGroup::class;

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
