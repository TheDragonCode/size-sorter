<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Enum;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Values;

/**
 * @method static int GROUP_1()
 * @method static int GROUP_2()
 * @method static int GROUP_3()
 * @method static int GROUP_4()
 * @method static int GROUP_5()
 */
enum Groups: int
{
    use InvokableCases;
    use Values;

    // Letter clothing size
    case GROUP_1 = 1;
    // Numerical size of clothes and shoes
    case GROUP_2 = 2;
    // Bra size
    case GROUP_3 = 3;
    // Overall dimensions of items
    case GROUP_4 = 4;
    // Other values
    case GROUP_5 = 5;

    public static function exists(Groups|string|int $group): bool
    {
        $value = $group->value ?? (int) $group;

        return in_array($value, self::values(), true);
    }
}
