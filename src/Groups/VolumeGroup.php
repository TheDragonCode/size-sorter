<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Groups;

use DragonCode\SizeSorter\Enums\GroupEnum;
use Illuminate\Support\Str;

class VolumeGroup extends Group
{
    protected static GroupEnum $group = GroupEnum::VolumeGroup;

    protected static array|string $pattern = '/^(\d+)_?[ml]{1,2}$/';

    protected static function prepare(mixed $value): string
    {
        return Str::of($value)
            ->explode('_')
            ->map(static fn (int|string $item) => (int) Str::match('/(\d+)/', $item))
            ->implode('_');
    }
}
