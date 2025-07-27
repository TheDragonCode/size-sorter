<?php

declare(strict_types=1);

use DragonCode\SizeSorter\Groups\BraGroup;

test('detector', function (int|string $value, bool $expected = false) {
    groupDetect(BraGroup::class, $value, $expected);
})->with([
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
]);

test('normalizer', function (string $input, string $output) {
    groupNormalizer(BraGroup::class, $input, $output);
})->with([
    ['70B', '70b'],
    ['70C', '70c'],
    ['75A', '75a'],
    ['75B', '75b'],
    ['75C', '75c'],
    ['80B', '80b'],
]);
