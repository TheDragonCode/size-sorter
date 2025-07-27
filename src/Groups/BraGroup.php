<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Groups;

use DragonCode\SizeSorter\Enums\GroupEnum;

class BraGroup extends Group
{
    protected static GroupEnum $group = GroupEnum::BraSize;

    protected static array|string $pattern = '/^(\d+[a-f]{1,2})$/';
}
