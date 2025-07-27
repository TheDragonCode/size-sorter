<?php

declare(strict_types=1);

use DragonCode\SizeSorter\Support\Map;

function applyMap(array $items, ?array $map = null): array
{
    $map ??= [
        'baz' => 2,
        'foo' => 0,
        'bar' => 1,
    ];

    return Map::apply(collect($items), collect($map))
        ->map(fn (mixed $value) => match (true) {
            $value instanceof Stringable          => (string) $value,
            is_object($value) || is_array($value) => json_encode($value, JSON_THROW_ON_ERROR),
            default                               => $value
        })
        ->all();
}
