<?php

declare(strict_types=1);

use DragonCode\SizeSorter\Groups\BraGroup;

test('detector', function (int|string $value, bool $expected = false) {
    groupDetect(BraGroup::class, $value, $expected);
})->with('bra detector');

test('normalizer', function (string $input, string $output) {
    groupNormalizer(BraGroup::class, $input, $output);
})->with('bra normalizer');
