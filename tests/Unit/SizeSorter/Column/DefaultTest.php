<?php

declare(strict_types=1);

use DragonCode\SizeSorter\SizeSorter;
use Tests\Fixtures\Objects\LaravelModel;

test('array', function () {
    $actual = SizeSorter::items([
        ['value' => '222'],
        ['value' => '111'],
    ])
        ->sort()
        ->all();

    expect($actual)->toMatchSnapshot();
});

test('object', function () {
    $actual = SizeSorter::items([
        (object) ['value' => '222'],
        (object) ['value' => '111'],
    ])
        ->sort()
        ->all();

    expect($actual)->toMatchSnapshot();
});

test('laravel model', function () {
    $actual = SizeSorter::items([
        new LaravelModel(['id' => 1, 'value' => '222']),
        new LaravelModel(['id' => 2, 'value' => '111']),
    ])
        ->sort()
        ->all();

    expect($actual)->toMatchSnapshot();
});
