<?php

declare(strict_types=1);

use DragonCode\SizeSorter\Groups\OtherGroup;

test('detector', function (int|string $value, bool $expected = false) {
    groupDetect(OtherGroup::class, $value, $expected);
})->with([
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
    ['1', true],
    [26, true],
    ['44-46', true],
    ['44/46', true],
    ['75A', true],
    ['40х38х15 см', true],
    ['40х38х19 sm', true],
    ['ONE SIZE', true],
    ['some', true],
]);

test('normalizer', function (string $input, string $output) {
    groupNormalizer(OtherGroup::class, $input, $output);
})->with([
    ['XXS', 'xxs'],
    ['XXS/XS', 'xxs_xs'],
    ['XXS-XS', 'xxs_xs'],
    ['XS', 'xs'],
    ['XS/S', 'xs_s'],
    ['S', 's'],
    ['S/M', 's_m'],
    ['M', 'm'],
    ['M/L', 'm_l'],
    ['L', 'l'],
    ['L/XL', 'l_xl'],
    ['XL', 'xl'],
    ['XL/2XL', 'xl_2xl'],
    ['XXL', 'xxl'],
    ['1', '1'],
    ['26', '26'],
    ['44-46', '44_46'],
    ['44/46', '44_46'],
    ['75A', '75a'],
    ['40х38х15 см', '40x38x15_sm'],
    ['40х38х19 sm', '40x38x19_sm'],
    ['ONE SIZE', 'one_size'],
    ['some', 'some'],
]);
