<?php

declare(strict_types=1);

use DragonCode\SizeSorter\Groups\ClothesAndShoesGroup;

test('detector', function (int|string $value, bool $expected = false) {
    groupDetect(ClothesAndShoesGroup::class, $value, $expected);
})->with('clothes and shoes detector');

test('normalizer', function (int|string $input, string $output) {
    groupNormalizer(ClothesAndShoesGroup::class, $input, $output);
})->with('clothes and shoes normalizer');
