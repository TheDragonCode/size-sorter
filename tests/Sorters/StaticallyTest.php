<?php

declare(strict_types=1);

namespace Tests\Sorters;

use DragonCode\SizeSorter\Sorter;
use Tests\TestCase;

class StaticallyTest extends TestCase
{
    private array $values = [
        100 => 'XXL',
        101 => '26',
        102 => '28',
        103 => 'XL',
        104 => 'ONE SIZE',
        105 => 'XXS',
        106 => '2',
        107 => '54',
        108 => 'XS',
        109 => 'S',
        110 => 'M',
        111 => 'L',
        112 => 'L/XL',
        113 => 'XL/2XL',
        114 => 'XS/S',
        115 => 'M/L',
        116 => '80B',
        117 => '75C',
        118 => '70B',
        119 => '75A',
        120 => '75B',
        121 => '36',
        122 => 'XXS-XS',
        123 => '37',
        124 => '38',
        125 => '39',
        126 => '40',
        127 => 'S/M',
        128 => '40х38х19 см',
        129 => '70C',
        130 => '44-46',
        131 => 'some',
        132 => '1',
        133 => '30',
        134 => '32',
        135 => '34',
        136 => '44/46',
        137 => 'XXS/XS',
        138 => 'XXS',
        139 => '52-56',
        140 => '102-104',
        141 => '102-106',
        142 => '102/106',
        143 => '106',
        145 => '110-112',
        144 => '110-114',
        146 => '90/94',
        147 => '94-98',
        148 => '98-102',
        149 => '21',
        150 => '3',
        151 => '40х38х19 sm',
        152 => '40х37х19 см',
        153 => '40х37х20 см',
        154 => '40х38х15 см',
        155 => '41х38х15 см',
        156 => '39х38х15 см',
    ];

    private array $expected = [
        // 1
        105 => 'XXS',
        138 => 'XXS',
        137 => 'XXS/XS',
        122 => 'XXS-XS',
        108 => 'XS',
        114 => 'XS/S',
        109 => 'S',
        127 => 'S/M',
        110 => 'M',
        115 => 'M/L',
        111 => 'L',
        112 => 'L/XL',
        103 => 'XL',
        113 => 'XL/2XL',
        100 => 'XXL',
        // 2
        132 => '1',
        106 => '2',
        150 => '3',
        149 => '21',
        101 => '26',
        102 => '28',
        133 => '30',
        134 => '32',
        135 => '34',
        121 => '36',
        123 => '37',
        124 => '38',
        125 => '39',
        126 => '40',
        130 => '44-46',
        136 => '44/46',
        139 => '52-56',
        107 => '54',
        146 => '90/94',
        147 => '94-98',
        148 => '98-102',
        140 => '102-104',
        141 => '102-106',
        142 => '102/106',
        143 => '106',
        145 => '110-112',
        144 => '110-114',
        // 3
        118 => '70B',
        129 => '70C',
        119 => '75A',
        120 => '75B',
        117 => '75C',
        116 => '80B',
        // 4
        156 => '39х38х15 см',
        152 => '40х37х19 см',
        153 => '40х37х20 см',
        154 => '40х38х15 см',
        151 => '40х38х19 sm',
        128 => '40х38х19 см',
        155 => '41х38х15 см',
        // 5
        104 => 'ONE SIZE',
        131 => 'some',
    ];

    public function testArray(): void
    {
        $this->assertSame(
            $this->expected,
            Sorter::sort(collect($this->values))->toArray()
        );
    }

    public function testObjects(): void
    {
        $items = collect($this->values)->map(fn (string $value, int $key) => (object) [
            'id'     => $key,
            'value'  => $value,
            'active' => true,
        ]);

        $this->assertSame(
            $this->expected,
            Sorter::sort($items)->pluck('value', 'id')->toArray()
        );
    }

    public function testCustomColumn(): void
    {
        $items = collect($this->values)->map(fn (string $value, int $key) => (object) [
            'id'   => $key,
            'some' => $value,
        ]);

        $this->assertSame(
            $this->expected,
            Sorter::sort($items, 'some')->pluck('some', 'id')->toArray()
        );
    }

    public function testWithSaveKeys(): void
    {
        $values = [
            840 => 'XL',
            506 => 'XS',
        ];

        $expected = [
            506 => 'XS',
            840 => 'XL',
        ];

        $this->assertSame($expected, Sorter::sort(collect($values))->toArray());
    }
}
