<?php

declare(strict_types=1);

use DragonCode\SizeSorter\SizeSorter;
use Illuminate\Support\Collection;

test('array', function () {
    $actual = SizeSorter::items([])->sort()->all();

    expect($actual)->toBeEmpty()->toBe([]);
});

test('collection', function () {
    $actual = SizeSorter::items(new Collection)->sort()->all();

    expect($actual)->toBeEmpty()->toBe([]);
});
