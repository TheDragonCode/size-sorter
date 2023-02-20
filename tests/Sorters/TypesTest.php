<?php

declare(strict_types=1);

namespace Tests\Sorters;

use DragonCode\SizeSorter\Sorter;
use DragonCode\Support\Facades\Helpers\Str as DragonStr;
use Illuminate\Support\Str as IlluminateStr;
use Tests\Fixtures\StringValue;
use Tests\TestCase;

class TypesTest extends TestCase
{
    public function testString(): void
    {
        $items = collect([
            104 => 'ONE SIZE',
            105 => 'XXS',
            106 => '2',
            110 => 'M',
            113 => 'XL/2XL',
            116 => '80B',
            118 => '70B',
            130 => '44-46',
            131 => 'some',
            132 => '1',
            133 => '30',
            136 => '44/46',
            137 => 'XXS/XS',
            139 => '52-56',
            149 => '21',
            150 => '3',
            155 => '41х38х15 см',
            156 => '39х38х15 см',
        ]);

        $this->assertSame(
            [
                // 1
                105 => 'XXS',
                137 => 'XXS/XS',
                110 => 'M',
                113 => 'XL/2XL',
                // 2
                132 => '1',
                106 => '2',
                150 => '3',
                149 => '21',
                133 => '30',
                130 => '44-46',
                136 => '44/46',
                139 => '52-56',
                // 3
                118 => '70B',
                116 => '80B',
                // 4
                156 => '39х38х15 см',
                155 => '41х38х15 см',
                // 5
                104 => 'ONE SIZE',
                131 => 'some',
            ],
            Sorter::sort($items)->toArray()
        );
    }

    public function testIlluminateStringable(): void
    {
        $items = collect([
            104 => IlluminateStr::of('ONE SIZE'),
            105 => IlluminateStr::of('XXS'),
            106 => IlluminateStr::of('2'),
            110 => IlluminateStr::of('M'),
            113 => IlluminateStr::of('XL/2XL'),
            116 => IlluminateStr::of('80B'),
            118 => IlluminateStr::of('70B'),
            130 => IlluminateStr::of('44-46'),
            131 => IlluminateStr::of('some'),
            132 => IlluminateStr::of('1'),
            133 => IlluminateStr::of('30'),
            136 => IlluminateStr::of('44/46'),
            137 => IlluminateStr::of('XXS/XS'),
            139 => IlluminateStr::of('52-56'),
            149 => IlluminateStr::of('21'),
            150 => IlluminateStr::of('3'),
            155 => IlluminateStr::of('41х38х15 см'),
            156 => IlluminateStr::of('39х38х15 см'),
        ]);

        $this->assertSame(
            [
                // 1
                105 => $items[105],
                137 => $items[137],
                110 => $items[110],
                113 => $items[113],
                // 2
                132 => $items[132],
                106 => $items[106],
                150 => $items[150],
                149 => $items[149],
                133 => $items[133],
                130 => $items[130],
                136 => $items[136],
                139 => $items[139],
                // 3
                118 => $items[118],
                116 => $items[116],
                // 4
                156 => $items[156],
                155 => $items[155],
                // 5
                104 => $items[104],
                131 => $items[131],
            ],
            Sorter::sort($items)->toArray()
        );
    }

    public function testDragonStringable(): void
    {
        $items = collect([
            104 => DragonStr::of('ONE SIZE'),
            105 => DragonStr::of('XXS'),
            106 => DragonStr::of('2'),
            110 => DragonStr::of('M'),
            113 => DragonStr::of('XL/2XL'),
            116 => DragonStr::of('80B'),
            118 => DragonStr::of('70B'),
            130 => DragonStr::of('44-46'),
            131 => DragonStr::of('some'),
            132 => DragonStr::of('1'),
            133 => DragonStr::of('30'),
            136 => DragonStr::of('44/46'),
            137 => DragonStr::of('XXS/XS'),
            139 => DragonStr::of('52-56'),
            149 => DragonStr::of('21'),
            150 => DragonStr::of('3'),
            155 => DragonStr::of('41х38х15 см'),
            156 => DragonStr::of('39х38х15 см'),
        ]);

        $this->assertSame(
            [
                // 1
                105 => $items[105],
                137 => $items[137],
                110 => $items[110],
                113 => $items[113],
                // 2
                132 => $items[132],
                106 => $items[106],
                150 => $items[150],
                149 => $items[149],
                133 => $items[133],
                130 => $items[130],
                136 => $items[136],
                139 => $items[139],
                // 3
                118 => $items[118],
                116 => $items[116],
                // 4
                156 => $items[156],
                155 => $items[155],
                // 5
                104 => $items[104],
                131 => $items[131],
            ],
            Sorter::sort($items)->toArray()
        );
    }

    public function testInteger(): void
    {
        $items = collect([
            104 => 'ONE SIZE',
            105 => 'XXS',
            106 => 2,
            110 => 'M',
            113 => 'XL/2XL',
            116 => '80B',
            118 => '70B',
            130 => '44-46',
            131 => 'some',
            132 => 1,
            133 => 30,
            136 => '44/46',
            137 => 'XXS/XS',
            139 => '52-56',
            149 => 21,
            150 => 3,
            155 => '41х38х15 см',
            156 => '39х38х15 см',
        ]);

        $this->assertSame(
            [
                // 1
                105 => 'XXS',
                137 => 'XXS/XS',
                110 => 'M',
                113 => 'XL/2XL',
                // 2
                132 => 1,
                106 => 2,
                150 => 3,
                149 => 21,
                133 => 30,
                130 => '44-46',
                136 => '44/46',
                139 => '52-56',
                // 3
                118 => '70B',
                116 => '80B',
                // 4
                156 => '39х38х15 см',
                155 => '41х38х15 см',
                // 5
                104 => 'ONE SIZE',
                131 => 'some',
            ],
            Sorter::sort($items)->toArray()
        );
    }

    public function testFloat(): void
    {
        $items = collect([
            104 => 'ONE SIZE',
            105 => 'XXS',
            106 => 2.2,
            110 => 'M',
            113 => 'XL/2XL',
            116 => '80B',
            118 => '70B',
            130 => '44-46',
            131 => 'some',
            132 => 1.3,
            133 => 30.5,
            136 => '44/46',
            137 => 'XXS/XS',
            139 => '52-56',
            149 => 21.8,
            150 => 3.0,
            155 => '41х38х15 см',
            156 => '39х38х15 см',
        ]);

        $this->assertSame(
            [
                // 1
                105 => 'XXS',
                137 => 'XXS/XS',
                110 => 'M',
                113 => 'XL/2XL',
                // 2
                132 => 1.3,
                106 => 2.2,
                150 => 3.0,
                149 => 21.8,
                133 => 30.5,
                130 => '44-46',
                136 => '44/46',
                139 => '52-56',
                // 3
                118 => '70B',
                116 => '80B',
                // 4
                156 => '39х38х15 см',
                155 => '41х38х15 см',
                // 5
                104 => 'ONE SIZE',
                131 => 'some',
            ],
            Sorter::sort($items)->toArray()
        );
    }

    public function testEnumString(): void
    {
        $items = collect([
            104 => StringValue::VALUE_ONE_SIZE,
            105 => StringValue::VALUE_XXS,
            106 => StringValue::VALUE_2,
            110 => StringValue::VALUE_M,
            113 => StringValue::VALUE_XL_2XL,
            116 => StringValue::VALUE_80B,
            118 => StringValue::VALUE_70B,
            130 => StringValue::VALUE_44_46,
            131 => StringValue::VALUE_SOME,
            132 => StringValue::VALUE_1,
            133 => StringValue::VALUE_30,
            137 => StringValue::VALUE_XXS_XS,
            139 => StringValue::VALUE_52_56,
            149 => StringValue::VALUE_21,
            150 => StringValue::VALUE_3,
            155 => StringValue::VALUE_41_38_15,
            156 => StringValue::VALUE_39_38_15,
        ]);

        $this->assertSame(
            [
                // 1
                105 => StringValue::VALUE_XXS,
                137 => StringValue::VALUE_XXS_XS,
                110 => StringValue::VALUE_M,
                113 => StringValue::VALUE_XL_2XL,
                // 2
                132 => StringValue::VALUE_1,
                106 => StringValue::VALUE_2,
                150 => StringValue::VALUE_3,
                149 => StringValue::VALUE_21,
                133 => StringValue::VALUE_30,
                130 => StringValue::VALUE_44_46,
                139 => StringValue::VALUE_52_56,
                // 3
                118 => StringValue::VALUE_70B,
                116 => StringValue::VALUE_80B,
                // 4
                156 => StringValue::VALUE_39_38_15,
                155 => StringValue::VALUE_41_38_15,
                // 5
                104 => StringValue::VALUE_ONE_SIZE,
                131 => StringValue::VALUE_SOME,
            ],
            Sorter::sort($items)->toArray()
        );
    }

    public function testEnumInteger(): void
    {
        $items = collect([
            106 => StringValue::VALUE_2,
            132 => StringValue::VALUE_1,
            133 => StringValue::VALUE_30,
            149 => StringValue::VALUE_21,
            150 => StringValue::VALUE_3,
        ]);

        $this->assertSame(
            [
                // 2
                132 => StringValue::VALUE_1,
                106 => StringValue::VALUE_2,
                150 => StringValue::VALUE_3,
                149 => StringValue::VALUE_21,
                133 => StringValue::VALUE_30,
            ],
            Sorter::sort($items)->toArray()
        );
    }

    public function testNestedArray(): void
    {
        $items = collect([
            104 => ['foo' => 'Foo', 'bar' => ['some' => ['nested' => 'ONE SIZE']]],
            105 => ['foo' => 'Foo', 'bar' => ['some' => ['nested' => 'XXS']]],
            106 => ['foo' => 'Foo', 'bar' => ['some' => ['nested' => '2']]],
            110 => ['foo' => 'Foo', 'bar' => ['some' => ['nested' => 'M']]],
            113 => ['foo' => 'Foo', 'bar' => ['some' => ['nested' => 'XL/2XL']]],
            116 => ['foo' => 'Foo', 'bar' => ['some' => ['nested' => '80B']]],
            118 => ['foo' => 'Foo', 'bar' => ['some' => ['nested' => '70B']]],
            130 => ['foo' => 'Foo', 'bar' => ['some' => ['nested' => '44-46']]],
            131 => ['foo' => 'Foo', 'bar' => ['some' => ['nested' => 'some']]],
            132 => ['foo' => 'Foo', 'bar' => ['some' => ['nested' => '1']]],
            133 => ['foo' => 'Foo', 'bar' => ['some' => ['nested' => '30']]],
            136 => ['foo' => 'Foo', 'bar' => ['some' => ['nested' => '44/46']]],
            137 => ['foo' => 'Foo', 'bar' => ['some' => ['nested' => 'XXS/XS']]],
            139 => ['foo' => 'Foo', 'bar' => ['some' => ['nested' => '52-56']]],
            149 => ['foo' => 'Foo', 'bar' => ['some' => ['nested' => '21']]],
            150 => ['foo' => 'Foo', 'bar' => ['some' => ['nested' => '3']]],
            155 => ['foo' => 'Foo', 'bar' => ['some' => ['nested' => '41х38х15 см']]],
            156 => ['foo' => 'Foo', 'bar' => ['some' => ['nested' => '39х38х15 см']]],
        ]);

        $this->assertSame(
            [
                // 1
                105 => ['foo' => 'Foo', 'bar' => ['some' => ['nested' => 'XXS']]],
                137 => ['foo' => 'Foo', 'bar' => ['some' => ['nested' => 'XXS/XS']]],
                110 => ['foo' => 'Foo', 'bar' => ['some' => ['nested' => 'M']]],
                113 => ['foo' => 'Foo', 'bar' => ['some' => ['nested' => 'XL/2XL']]],
                // 2
                132 => ['foo' => 'Foo', 'bar' => ['some' => ['nested' => '1']]],
                106 => ['foo' => 'Foo', 'bar' => ['some' => ['nested' => '2']]],
                150 => ['foo' => 'Foo', 'bar' => ['some' => ['nested' => '3']]],
                149 => ['foo' => 'Foo', 'bar' => ['some' => ['nested' => '21']]],
                133 => ['foo' => 'Foo', 'bar' => ['some' => ['nested' => '30']]],
                130 => ['foo' => 'Foo', 'bar' => ['some' => ['nested' => '44-46']]],
                136 => ['foo' => 'Foo', 'bar' => ['some' => ['nested' => '44/46']]],
                139 => ['foo' => 'Foo', 'bar' => ['some' => ['nested' => '52-56']]],
                // 3
                118 => ['foo' => 'Foo', 'bar' => ['some' => ['nested' => '70B']]],
                116 => ['foo' => 'Foo', 'bar' => ['some' => ['nested' => '80B']]],
                // 4
                156 => ['foo' => 'Foo', 'bar' => ['some' => ['nested' => '39х38х15 см']]],
                155 => ['foo' => 'Foo', 'bar' => ['some' => ['nested' => '41х38х15 см']]],
                // 5
                104 => ['foo' => 'Foo', 'bar' => ['some' => ['nested' => 'ONE SIZE']]],
                131 => ['foo' => 'Foo', 'bar' => ['some' => ['nested' => 'some']]],
            ],
            Sorter::sort($items, 'bar.some.nested')->toArray()
        );
    }
}
