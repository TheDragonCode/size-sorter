<?php

declare(strict_types=1);

use DragonCode\SizeSorter\SizeSorter;
use Tests\Fixtures\Objects\LaravelModel;

test('array', function () {
    $actual = SizeSorter::items([
        ['some' => '222'],
        ['some' => '111'],
    ])
        ->column(static fn (array $item) => $item['some'])
        ->sort()
        ->all();

    expect($actual)->toMatchSnapshot();
});

test('object', function () {
    $actual = SizeSorter::items([
        (object) ['some' => '222'],
        (object) ['some' => '111'],
    ])
        ->column(fn (object $item) => $item->some)
        ->sort()
        ->all();

    expect($actual)->toMatchSnapshot();
});

test('laravel model', function () {
    $actual = SizeSorter::items([
        new LaravelModel(['id' => 1, 'some' => '222']),
        new LaravelModel(['id' => 2, 'some' => '111']),
    ])
        ->column(static fn (LaravelModel $item) => $item->some)
        ->sort()
        ->all();

    expect($actual)->toMatchSnapshot();
});
