<?php

declare(strict_types=1);

namespace Tests\Unit\Support\Map;

use Closure;
use DragonCode\SizeSorter\Normalizers\KeyNormalizer;
use DragonCode\SizeSorter\Support\Map;
use Illuminate\Support\Collection;
use Tests\Fixtures\Objects\LaravelModel;
use Tests\Fixtures\Objects\Stringable;
use Tests\TestCase;

class MakeTest extends TestCase
{
    protected array $map = [
        'foo' => 0,
        'bar' => 1,
        'baz' => 2,
    ];

    public function testString(): void
    {
        $input = collect([
            'foo',
            'bar',
            'baz',
        ]);

        $this->assertSame([
            $this->prefix('foo', 0) => 0,
            $this->prefix('bar', 1) => 1,
            $this->prefix('baz', 2) => 2,
        ], $this->makeMap($input));
    }

    public function testLongString(): void
    {
        $input = collect([
            'foo QWE',
            'bar/RTY',
            'baz-asd',
        ]);

        $this->assertSame([
            $this->prefix('foo_qwe', 0) => 0,
            $this->prefix('bar_rty', 1) => 1,
            $this->prefix('baz_asd', 2) => 2,
        ], $this->makeMap($input));
    }

    public function testDuplicates(): void
    {
        $input = collect([
            'foo',
            'bar',
            'baz',
            'foo',
        ]);

        $this->assertSame([
            $this->prefix('foo', 0) => 0,
            $this->prefix('bar', 1) => 1,
            $this->prefix('baz', 2) => 2,
            $this->prefix('foo', 3) => 3,
        ], $this->makeMap($input));
    }

    public function testStringable(): void
    {
        $input = collect([
            new Stringable('foo'),
            new Stringable('bar'),
            new Stringable('baz'),
        ]);

        $this->assertSame([
            $this->prefix('foo', 0) => 0,
            $this->prefix('bar', 1) => 1,
            $this->prefix('baz', 2) => 2,
        ], $this->makeMap($input));
    }

    public function testNumber(): void
    {
        $input = collect([
            123,
            234,
            345,
        ]);

        $this->assertSame([
            $this->prefix('123', 0) => 0,
            $this->prefix('234', 1) => 1,
            $this->prefix('345', 2) => 2,
        ], $this->makeMap($input));
    }

    public function testObject(): void
    {
        $column = static fn (object $item) => $item->value;

        $input = collect([
            (object) ['value' => 'foo'],
            (object) ['value' => 'bar'],
            (object) ['value' => 'baz'],
        ]);

        $this->assertSame([
            $this->prefix('foo', 0) => 0,
            $this->prefix('bar', 1) => 1,
            $this->prefix('baz', 2) => 2,
        ], $this->makeMap($input, $column));
    }

    public function testLaravelModel(): void
    {
        $column = static fn (object $item) => $item->value;

        $input = collect([
            new LaravelModel(['id' => 1, 'value' => 'foo']),
            new LaravelModel(['id' => 2, 'value' => 'bar']),
            new LaravelModel(['id' => 3, 'value' => 'baz']),
        ]);

        $this->assertSame([
            $this->prefix('foo', 0) => 0,
            $this->prefix('bar', 1) => 1,
            $this->prefix('baz', 2) => 2,
        ], $this->makeMap($input, $column));
    }

    protected function makeMap(Collection $items, ?Closure $column = null): array
    {
        $column ??= static fn (int|string|Stringable $value) => $value;

        return Map::make($items, $column)->all();
    }

    protected function prefix(string $key, int|string $prefix): string
    {
        return $prefix . KeyNormalizer::Delimiter . $key;
    }
}
