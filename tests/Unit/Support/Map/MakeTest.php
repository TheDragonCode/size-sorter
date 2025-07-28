<?php

declare(strict_types=1);

namespace Tests\Unit\Support\Map;

use Tests\Fixtures\Objects\LaravelModel;
use Tests\Fixtures\Objects\Stringable;

test('string', function () {
    expect(makeMap([
        'foo',
        'bar',
        'baz',
    ]))->toMatchSnapshot();
});

test('long string', function () {
    expect(makeMap([
        'foo QWE',
        'bar/RTY',
        'baz-asd',
    ]))->toMatchSnapshot();
});

test('duplicates', function () {
    expect(makeMap([
        'foo',
        'bar',
        'baz',
        'foo',
    ]))->toMatchSnapshot();
});

test('stringable', function () {
    expect(makeMap([
        new Stringable('foo'),
        new Stringable('bar'),
        new Stringable('baz'),
    ]))->toMatchSnapshot();
});

test('number', function () {
    expect(makeMap([
        123,
        234,
        345,
    ]))->toMatchSnapshot();
});

test('object', function () {
    expect(
        makeMap(
            [
                (object) ['value' => 'foo'],
                (object) ['value' => 'bar'],
                (object) ['value' => 'baz'],
            ],
            static fn (object $item) => $item->value
        )
    )->toMatchSnapshot();
});

test('laravel model', function () {
    expect(
        makeMap(
            [
                new LaravelModel(['id' => 1, 'value' => 'foo']),
                new LaravelModel(['id' => 2, 'value' => 'bar']),
                new LaravelModel(['id' => 3, 'value' => 'baz']),
            ],
            static fn (object $item) => $item->value
        )
    )->toMatchSnapshot();
});
