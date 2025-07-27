<?php

declare(strict_types=1);

use DragonCode\SizeSorter\Groups\OverallDimensionsGroup;

test('detector', function (int|string $value, bool $expected = false) {
    groupDetect(OverallDimensionsGroup::class, $value, $expected);
})->with('overall dimensions detector');

test('normalizer', function (string $input, string $output) {
    groupNormalizer(OverallDimensionsGroup::class, $input, $output);
})->with('overall dimensions normalizer');
