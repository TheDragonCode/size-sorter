<?php

declare(strict_types=1);


use DragonCode\SizeSorter\Groups\LetterClothingGroup;

test('detector', function (int|string $value, bool $expected = false) {
    groupDetect(LetterClothingGroup::class, $value, $expected);
})->with([
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
]);

test('normalizer', function (string $input, string $output) {
    groupNormalizer(LetterClothingGroup::class, $input, $output);
})->with([
    ['2XS', '301'],
    ['XXS', '300'],
    ['XXS/XS', '300_200'],
    ['XXS-XS', '300_200'],
    ['XS', '200'],
    ['XS/S', '200_100'],
    ['S', '100'],
    ['S/M', '100_1000'],
    ['M', '1000'],
    ['M/L', '1000_10000'],
    ['L', '10000'],
    ['L/XL', '10000_20000'],
    ['XL', '20000'],
    ['XL/2XL', '20000_30001'],
    ['XXL', '30000'],
]);
