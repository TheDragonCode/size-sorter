<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Groups;

use DragonCode\SizeSorter\Enums\GroupEnum;

class OverallDimensionsGroup extends Group
{
    protected static GroupEnum $group = GroupEnum::OverallDimensions;

    protected static array|string $pattern = '/^([\d]+x?){1,3}([_\sms]+)$/';
}
