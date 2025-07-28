<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Groups;

use DragonCode\SizeSorter\Enums\GroupEnum;
use Illuminate\Support\Str;

use function is_numeric;

class OverallDimensionsGroup extends Group
{
    protected static GroupEnum $group = GroupEnum::OverallDimensions;

    protected static array|string $pattern = '/^([\d]+x?){1,3}([_\sms]+)$/';

    protected static function prepare(mixed $value): string
    {
        return Str::of($value)
            ->replace('x', '_')
            ->explode('_')
            ->filter(static fn (int|string $item) => is_numeric($item))
            ->implode('_');
    }
}
