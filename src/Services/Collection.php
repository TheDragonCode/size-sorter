<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Services;

use Illuminate\Support\Collection as IC;

class Collection
{
    public function make(array $items = []): IC
    {
        return new IC($items);
    }

    public function flatten(IC $items): IC
    {
        $result = $this->make();

        $items->each(function (mixed $value, mixed $key) use (&$result) {
            if (! $value instanceof IC) {
                $result->put($key, $value);

                return;
            }

            $result = $this->merge($result, $this->flatten($value));
        });

        return $result;
    }

    public function merge(IC $result, IC $second): IC
    {
        $second->each(
            fn (mixed $value, mixed $key) => $result->put($key, $value)
        );

        return $result;
    }
}
