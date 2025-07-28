<?php

declare(strict_types=1);

use DragonCode\SizeSorter\Groups\VolumeGroup;

test('detector', function (int|string $value, bool $expected = false) {
    groupDetect(VolumeGroup::class, $value, $expected);
})->with('volume detector');

test('normalizer', function (string $input, string $output) {
    groupNormalizer(VolumeGroup::class, $input, $output);
})->with('volume normalizer');
