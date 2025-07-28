<?php

declare(strict_types=1);

use DragonCode\SizeSorter\Support\Map;
use Tests\Fixtures\Objects\LaravelModel;
use Tests\Fixtures\Objects\Stringable;

test('string', function () {
    expect(applyMap([
        'foo',
        'bar',
        'baz',
    ]))->toMatchSnapshot();
});

test('stringable', function () {
    expect(applyMap([
        new Stringable('foo'),
        new Stringable('bar'),
        new Stringable('baz'),
    ]))->toMatchSnapshot();
});

test('number', function () {
    expect(applyMap([
        '123',
        '234',
        '345',
    ], [
        345 => 2,
        123 => 0,
        234 => 1,
    ]))->toMatchSnapshot();
});

test('object', function () {
    expect(applyMap([
        (object) ['value' => 'foo'],
        (object) ['value' => 'bar'],
        (object) ['value' => 'baz'],
    ]))->toMatchSnapshot();
});

test('laravel model', function () {
    expect(applyMap([
        new LaravelModel(['id' => 1, 'value' => 'foo']),
        new LaravelModel(['id' => 2, 'value' => 'bar']),
        new LaravelModel(['id' => 3, 'value' => 'baz']),
    ]))->toMatchSnapshot();
});

test('missing count', function () {
    Map::apply(
        collect([1, 2, 3]),
        collect([1, 2])
    );
})->throws(
    LengthException::class,
    'The count of items in the map (2) and collection (3) should be the same.'
);
