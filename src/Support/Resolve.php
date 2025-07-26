<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Support;

use BackedEnum;
use Illuminate\Support\Arr;
use Stringable;
use UnitEnum;

use function is_array;
use function is_object;

class Resolve
{
    public static function value(mixed $item, string $column): mixed
    {
        if ($item instanceof BackedEnum) {
            return $item->value;
        }

        if ($item instanceof UnitEnum) {
            return $item->name;
        }

        if ($item instanceof Stringable) {
            return (string) $item;
        }

        if (is_object($item)) {
            return $item->{$column};
        }

        if (is_array($item)) {
            return Arr::get($item, $column);
        }

        return $item;
    }
}
