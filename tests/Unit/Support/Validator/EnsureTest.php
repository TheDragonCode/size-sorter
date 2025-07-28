<?php

declare(strict_types=1);

use DragonCode\SizeSorter\Support\Validator;

test('success', function () {
    Validator::ensure([
        (object) ['value' => 'foo'],
        (object) ['value' => 'bar'],
    ], stdClass::class);

    expect(true)->toBeTrue();
});

test('wrong', function () {
    Validator::ensure([
        (object) ['value' => 'foo'],
        'bar',
    ], stdClass::class);
})->throws(
    UnexpectedValueException::class,
    "Collection should only include [stdClass] items, but 'string' found at position 1."
);
