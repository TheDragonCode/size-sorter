<?php

declare(strict_types=1);

use DragonCode\SizeSorter\Support\Validator;

test('success', function () {
    $items = collect([1, 2, 3]);

    Validator::mapCount($items, $items);

    expect(true)->toBeTrue();
});

test('wrong', function () {
    Validator::mapCount(
        collect([1, 2, 3]),
        collect([1, 2]),
    );
})->throws(
    LengthException::class,
    'The count of items in the map (2) and collection (3) should be the same.'
);
