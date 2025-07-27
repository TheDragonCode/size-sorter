<?php

declare(strict_types=1);

namespace Tests\Unit\Support\GroupOrder;

use DragonCode\SizeSorter\Enums\GroupEnum;
use DragonCode\SizeSorter\Support\GroupOrder;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class GetTest extends TestCase
{
    #[DataProvider('groupsData')]
    public function testFill(array $expected, ?array $input): void
    {
        $this->assertSame($expected, GroupOrder::get($input));
    }

    public static function groupsData(): array
    {
        return [
            'empty' => [
                'expected' => GroupEnum::sorted(),
                'input'    => null,
            ],

            'full' => [
                'expected' => GroupEnum::sorted(),
                'input'    => GroupEnum::sorted(),
            ],

            'partial' => [
                'expected' => [
                    GroupEnum::OtherSizes,
                    GroupEnum::BraSize,
                    GroupEnum::LetterClothingSize,
                    GroupEnum::ClothesAndShoes,
                    GroupEnum::OverallDimensions,
                ],

                'input' => [
                    GroupEnum::OtherSizes,
                    GroupEnum::BraSize,
                ],
            ],

            'full random' => [
                'expected' => [
                    GroupEnum::OtherSizes,
                    GroupEnum::BraSize,
                    GroupEnum::ClothesAndShoes,
                    GroupEnum::OverallDimensions,
                    GroupEnum::LetterClothingSize,
                ],

                'input' => [
                    GroupEnum::OtherSizes,
                    GroupEnum::BraSize,
                    GroupEnum::ClothesAndShoes,
                    GroupEnum::OverallDimensions,
                    GroupEnum::LetterClothingSize,
                ],
            ],
        ];
    }
}
