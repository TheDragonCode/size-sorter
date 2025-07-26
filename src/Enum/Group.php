<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Enum;

enum Group: int
{
    case LetterClothingSize = 1;
    case ClothesAndShoes    = 2;
    case BraSize            = 3;
    case OverallDimensions  = 4;
    case OtherSizes         = 5;
}
