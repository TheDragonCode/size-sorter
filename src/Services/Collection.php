<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Services;

use Illuminate\Support\Collection as IC;

class Collection
{
    public static function make(array $items = []): IC
    {
        return new IC($items);
    }

    public static function flatten(IC $items): IC
    {
        $result = static::make();

        $items->each(static function (mixed $value, mixed $key) use (&$result) {
            if (! $value instanceof IC) {
                $result->put($key, $value);

                return;
            }

            $result = static::merge($result, static::flatten($value));
        });

        return $result;
    }

    public static function merge(IC $result, IC $second): IC
    {
        $second->each(
            static fn (mixed $value, mixed $key) => $result->put($key, $value)
        );

        return $result;
    }
}
