<?php

declare(strict_types=1);

namespace Tests\Unit\Support\Map;

use DragonCode\SizeSorter\Support\Map;
use Illuminate\Support\Collection;
use LengthException;
use Tests\Fixtures\Objects\LaravelModel;
use Tests\Fixtures\Objects\Stringable;
use Tests\TestCase;

class ApplyTest extends TestCase
{
    protected array $map = [
        'baz' => 2,
        'foo' => 0,
        'bar' => 1,
    ];

    public function testString(): void
    {
        $input = collect([
            'foo',
            'bar',
            'baz',
        ]);

        $this->assertSame([
            2 => 'baz',
            0 => 'foo',
            1 => 'bar',
        ], $this->applyMap($input));
    }

    public function testStringable(): void
    {
        $obj1 = new Stringable('foo');
        $obj2 = new Stringable('bar');
        $obj3 = new Stringable('baz');

        $input = collect([
            $obj1,
            $obj2,
            $obj3,
        ]);

        $this->assertSame([
            2 => $obj3,
            0 => $obj1,
            1 => $obj2,
        ], $this->applyMap($input));
    }

    public function testNumber(): void
    {
        $input = collect([
            123,
            234,
            345,
        ]);

        $this->assertSame([
            2 => 345,
            0 => 123,
            1 => 234,
        ], $this->applyMap($input));
    }

    public function testObject(): void
    {
        $obj1 = (object) ['value' => 'foo'];
        $obj2 = (object) ['value' => 'bar'];
        $obj3 = (object) ['value' => 'baz'];

        $input = collect([
            $obj1,
            $obj2,
            $obj3,
        ]);

        $this->assertSame([
            2 => $obj3,
            0 => $obj1,
            1 => $obj2,
        ], $this->applyMap($input));
    }

    public function testLaravelModel(): void
    {
        $obj1 = new LaravelModel(['id' => 1, 'value' => 'foo']);
        $obj2 = new LaravelModel(['id' => 2, 'value' => 'bar']);
        $obj3 = new LaravelModel(['id' => 3, 'value' => 'baz']);

        $input = collect([
            $obj1,
            $obj2,
            $obj3,
        ]);

        $this->assertSame([
            2 => $obj3,
            0 => $obj1,
            1 => $obj2,
        ], $this->applyMap($input));
    }

    public function testMissingCount(): void
    {
        $this->expectException(LengthException::class);
        $this->expectExceptionMessage('The count of items in the map (2) and collection (3) should be the same.');

        Map::apply(
            collect([1, 2, 3]),
            collect([1, 2])
        );
    }

    protected function applyMap(Collection $items): array
    {
        return Map::apply($items, collect($this->map))->all();
    }
}
