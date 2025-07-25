<?php

declare(strict_types=1);

namespace Tests\Unit\Sorters;

use DragonCode\SizeSorter\Sorter;

test('array', function (array $actual, array $expected) {
    $sorted = Sorter::sort($actual);

    expect($sorted->toArray())->toBe($expected);
})->with('actual sizes', 'expected default');

test('object', function (array $actual, array $expected) {
    $actual = collect($actual)->map(fn (mixed $value, int $key) => (object) [
        'id'     => $key,
        'value'  => $value,
        'active' => true,
    ]);

    $sorted = Sorter::sort($actual);

    expect($sorted->pluck('value', 'id')->toArray())->toBe($expected);
})->with('actual sizes', 'expected default');

test('custom column', function (array $actual, array $expected) {
    $actual = collect($actual)->map(fn (mixed $value, int $key) => (object) [
        'id'   => $key,
        'some' => $value,
    ]);

    $sorted = Sorter::sort($actual, 'some');

    expect($sorted->pluck('some', 'id')->toArray())->toBe($expected);
})->with('actual sizes', 'expected default');

test('with saved keys', function () {
    $actual = [
        840 => 'XL',
        506 => 'XS',
    ];

    $expected = [
        506 => 'XS',
        840 => 'XL',
    ];

    $sorted = Sorter::sort($actual);

    expect($sorted->toArray())->toBe($expected);
});
