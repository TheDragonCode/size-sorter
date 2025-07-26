<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Support;

use Closure;
use DragonCode\SizeSorter\Groups\BraGroup;
use DragonCode\SizeSorter\Groups\ClothesAndShoesGroup;
use DragonCode\SizeSorter\Groups\LetterClothingGroup;
use DragonCode\SizeSorter\Groups\OtherGroup;
use DragonCode\SizeSorter\Groups\OverallDimensionsGroup;
use DragonCode\SizeSorter\Normalizers\KeyNormalizer;
use Illuminate\Support\Collection;
use Stringable;

class Map
{
    public static function make(Collection $items, Closure $column): Collection
    {
        $result = [];

        foreach ($items as $key => $value) {
            $normalized = static::normalize($column($value));

            $name = static::group($normalized, $key);

            $result[$name] = $key;
        }

        return new Collection($result);
    }

    public static function apply(Collection $items, Collection $map): Collection
    {
        Validator::mapCount($items, $map);

        return $map->mapWithKeys(fn (string|int $index) => [
            $index => $items->get($index),
        ]);
    }

    protected static function group(int|string $value, int|string $key): string
    {
        return match (true) {
            LetterClothingGroup::detect($value)    => LetterClothingGroup::normalize($value, $key),
            ClothesAndShoesGroup::detect($value)   => ClothesAndShoesGroup::normalize($value, $key),
            BraGroup::detect($value)               => BraGroup::normalize($value, $key),
            OverallDimensionsGroup::detect($value) => OverallDimensionsGroup::normalize($value, $key),
            default                                => OtherGroup::normalize($value, $key)
        };
    }

    protected static function normalize(int|float|string|Stringable $value): string
    {
        return KeyNormalizer::normalize($value);
    }
}
