<?php

declare(strict_types=1);

use DragonCode\SizeSorter\Enums\GroupEnum;

dataset('groups', [
    'empty' => [
        'input'  => null,
        'output' => GroupEnum::sorted(),
    ],

    'full' => [
        'input'  => GroupEnum::sorted(),
        'output' => GroupEnum::sorted(),
    ],

    'partial' => [
        [
            GroupEnum::OtherSizes,
            GroupEnum::BraSize,
        ],

        'output' => [
            GroupEnum::OtherSizes,
            GroupEnum::BraSize,
            GroupEnum::LetterClothingSize,
            GroupEnum::ClothesAndShoes,
            GroupEnum::OverallDimensions,
            GroupEnum::VolumeGroup,
        ],
    ],

    'full random' => [
        [
            GroupEnum::OtherSizes,
            GroupEnum::BraSize,
            GroupEnum::ClothesAndShoes,
            GroupEnum::OverallDimensions,
            GroupEnum::LetterClothingSize,
        ],

        'output' => [
            GroupEnum::OtherSizes,
            GroupEnum::BraSize,
            GroupEnum::ClothesAndShoes,
            GroupEnum::OverallDimensions,
            GroupEnum::LetterClothingSize,
            GroupEnum::VolumeGroup,
        ],
    ],
]);

dataset('input groups', [
    'empty' => [
        null,
    ],

    'full' => [
        GroupEnum::sorted(),
    ],

    'partial' => [
        [
            GroupEnum::OtherSizes,
            GroupEnum::BraSize,
        ],
    ],

    'full random' => [
        [
            GroupEnum::OtherSizes,
            GroupEnum::BraSize,
            GroupEnum::ClothesAndShoes,
            GroupEnum::OverallDimensions,
            GroupEnum::LetterClothingSize,
            GroupEnum::VolumeGroup,
        ],
    ],
]);
