<?php

declare(strict_types=1);

use DragonCode\SizeSorter\Groups\LetterClothingGroup;

test('detector', function (int|string $value, bool $expected = false) {
    groupDetect(LetterClothingGroup::class, $value, $expected);
})->with('letter clothing detector');

test('normalizer', function (string $input, string $output) {
    groupNormalizer(LetterClothingGroup::class, $input, $output);
})->with('letter clothing normalizer');
