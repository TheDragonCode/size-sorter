<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Enum;

use function array_column;

enum Group: int
{
    case LetterClothingSize = 1;
    case ClothesAndShoes    = 2;
    case BraSize            = 3;
    case OverallDimensions  = 4;
    case OtherSizes         = 5;

    public static function exists(Group|int|string $group): bool
    {
        if ($group instanceof self) {
            return true;
        }

        return self::tryFrom((int) $group) !== null;
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
