<?php

declare(strict_types=1);

namespace Tests\Sorters;

use DragonCode\SizeSorter\Enum\Group;
use DragonCode\SizeSorter\Sorter;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class SortTest extends TestCase
{
    #[DataProvider('sorterData')]
    public function testArray(?array $order, array $expected): void
    {
        $actual = Sorter::same($this->values)
            ->groupsOrder($order)
            ->sort1()
            ->toArray();

        $this->assertSame($expected, $actual);
    }

    #[DataProvider('sorterData')]
    public function testObjects(?array $order, array $expected): void
    {
        $items = collect($this->values)->map(fn (mixed $value, int $key) => (object) [
            'id'     => $key,
            'value'  => $value,
            'active' => true,
        ]);

        $actual = Sorter::same($items)
            ->groupsOrder($order)
            ->sort1()
            ->pluck('value', 'id')
            ->toArray();

        $this->assertSame($expected, $actual);
    }

    #[DataProvider('sorterData')]
    public function testCustomColumn(?array $order, array $expected): void
    {
        $items = collect($this->values)->map(fn (mixed $value, int $key) => (object) [
            'id'   => $key,
            'some' => $value,
        ]);

        $actual = Sorter::same($items)
            ->groupsOrder($order)
            ->column('some')
            ->sort1()
            ->pluck('some', 'id')
            ->toArray();

        $this->assertSame($expected, $actual);
    }

    #[DataProvider('sorterData')]
    public function testWithSaveKeys(?array $order, array $expected): void
    {
        $values = [
            840 => 'XL',
            506 => 'XS',
        ];

        $expected = [
            506 => 'XS',
            840 => 'XL',
        ];

        $actual = Sorter::same($values)
            ->groupsOrder($order)
            ->sort1()
            ->toArray();

        $this->assertSame($expected, $actual);
    }

    public static function sorterData(): array
    {
        return [
            'simple' => [
                'order' => null,

                'expected' => [
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
                    101 => 26,
                    102 => 28,
                    133 => '30',
                    134 => '32',
                    135 => '34',
                    121 => '36',
                    123 => 37,
                    124 => 38,
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
                ],
            ],

            'full groups' => [
                'order' => [
                    Group::BraSize,
                    Group::OtherSizes,
                    Group::OverallDimensions,
                    Group::ClothesAndShoes,
                    Group::LetterClothingSize,
                ],

                'expected' => [
                    // 3
                    118 => '70B',
                    129 => '70C',
                    119 => '75A',
                    120 => '75B',
                    117 => '75C',
                    116 => '80B',
                    // 5
                    104 => 'ONE SIZE',
                    131 => 'some',
                    // 4
                    156 => '39х38х15 см',
                    152 => '40х37х19 см',
                    153 => '40х37х20 см',
                    154 => '40х38х15 см',
                    151 => '40х38х19 sm',
                    128 => '40х38х19 см',
                    155 => '41х38х15 см',
                    // 2
                    132 => '1',
                    106 => '2',
                    150 => '3',
                    149 => '21',
                    101 => 26,
                    102 => 28,
                    133 => '30',
                    134 => '32',
                    135 => '34',
                    121 => '36',
                    123 => 37,
                    124 => 38,
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
                ],
            ],

            'partial groups' => [
                'order' => [
                    Group::BraSize,
                    Group::OtherSizes,
                ],

                'expected' => [
                    // 3
                    118 => '70B',
                    129 => '70C',
                    119 => '75A',
                    120 => '75B',
                    117 => '75C',
                    116 => '80B',
                    // 5
                    104 => 'ONE SIZE',
                    131 => 'some',
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
                    101 => 26,
                    102 => 28,
                    133 => '30',
                    134 => '32',
                    135 => '34',
                    121 => '36',
                    123 => 37,
                    124 => 38,
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
                    // 4
                    156 => '39х38х15 см',
                    152 => '40х37х19 см',
                    153 => '40х37х20 см',
                    154 => '40х38х15 см',
                    151 => '40х38х19 sm',
                    128 => '40х38х19 см',
                    155 => '41х38х15 см',
                ],
            ],
        ];
    }
}
