<?php

declare(strict_types=1);

use DragonCode\SizeSorter\Groups\OverallDimensionsGroup;

test('detector', function (int|string $value, bool $expected = false) {
    groupDetect(OverallDimensionsGroup::class, $value, $expected);
})->with([
    ['39x38x15 см', true], // latin X
    ['40х37х19 см', true], // cyrillic X
    ['40x38x19 sm', true], // latin X
    ['40х38х19 sm', true], // cyrillic X

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
]);

test('normalizer', function (string $input, string $output) {
    groupNormalizer(OverallDimensionsGroup::class, $input, $output);
})->with([
    ['39x38x15 см', '39x38x15_sm'], // latin X
    ['40х37х19 см', '40x37x19_sm'], // cyrillic X
    ['40x38x19 sm', '40x38x19_sm'], // latin X
    ['40х38х19 sm', '40x38x19_sm'], // cyrillic X
]);
