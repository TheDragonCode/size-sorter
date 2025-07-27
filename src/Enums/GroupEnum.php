<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Enums;

enum GroupEnum: int
{
    case LetterClothingSize = 1;
    case ClothesAndShoes    = 2;
    case BraSize            = 3;
    case OverallDimensions  = 4;
    case OtherSizes         = 5;

    public static function sorted(): array
    {
        return [
            self::LetterClothingSize,
            self::ClothesAndShoes,
            self::BraSize,
            self::OverallDimensions,
            self::OtherSizes,
        ];
    }
}
