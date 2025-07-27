<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Support;

use Illuminate\Support\Collection;
use LengthException;
use UnexpectedValueException;

use function get_debug_type;

class Validator
{
    /**
     * @template TEnsureOfType
     *
     * @param  class-string<TEnsureOfType>|array<array-key, class-string<TEnsureOfType>>|'string'|'int'|'float'|'bool'|'array'|'null'  $class
     */
    public static function ensure(iterable $items, string $class): void
    {
        foreach ($items as $index => $value) {
            if ($value instanceof $class) {
                continue;
            }

            $type = get_debug_type($value);

            throw new UnexpectedValueException(
                vsprintf("Collection should only include [%s] items, but '%s' found at position %d.", [
                    $class,
                    $type,
                    $index,
                ])
            );
        }
    }

    public static function mapCount(Collection $items, Collection $map): void
    {
        $itemsCount = $items->count();
        $mapCount   = $map->count();

        if ($itemsCount === $mapCount) {
            return;
        }

        throw new LengthException(
            vsprintf('The count of items in the map (%d) and collection (%d) should be the same.', [
                $mapCount,
                $itemsCount,
            ])
        );
    }
}
