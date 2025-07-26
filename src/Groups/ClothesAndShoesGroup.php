<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Groups;

use DragonCode\SizeSorter\Enums\GroupEnum;

class ClothesAndShoesGroup extends Group
{
    protected static GroupEnum $group = GroupEnum::ClothesAndShoes;

    protected static array|string $pattern = '/^(\d+_?\d*)$/';
}
