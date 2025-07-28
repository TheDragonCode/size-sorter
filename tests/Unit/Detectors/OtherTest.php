<?php

declare(strict_types=1);

use DragonCode\SizeSorter\Groups\OtherGroup;

test('detector', function (int|string $value, bool $expected = false) {
    groupDetect(OtherGroup::class, $value, $expected);
})->with('other detector');

test('normalizer', function (string $input, string $output) {
    groupNormalizer(OtherGroup::class, $input, $output);
})->with('other normalizer');
