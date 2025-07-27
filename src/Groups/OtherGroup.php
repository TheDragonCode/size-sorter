<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Groups;

use DragonCode\SizeSorter\Enums\GroupEnum;

class OtherGroup extends Group
{
    protected static GroupEnum $group = GroupEnum::OtherSizes;

    public static function detect(string $value): bool
    {
        return true;
    }
}
