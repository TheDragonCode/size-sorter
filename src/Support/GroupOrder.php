<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Support;

use DragonCode\SizeSorter\Enums\GroupEnum;
use Illuminate\Support\Collection;

use function in_array;

class GroupOrder
{
    public static function get(?iterable $groups): array
    {
        $result = static::normalize($groups);

        foreach (static::fallback() as $group) {
            if (! in_array($group, $result, true)) {
                $result[] = $group;
            }
        }

        return $result;
    }

    protected static function fallback(): array
    {
        return GroupEnum::sorted();
    }

    protected static function normalize(?iterable $groups): array
    {
        return Collection::make($groups)->all();
    }
}
