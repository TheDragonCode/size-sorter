<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Services;

use DragonCode\Support\Helpers\Ables\Stringable;

class Resolver
{
    public function __construct(
        protected Str $str = new Str()
    ) {
    }

    public function key(mixed $value, string $column): mixed
    {
        return $value->$column ?? $value[$column] ?? $value;
    }

    public function value(mixed $value, string $column): Stringable
    {
        return $this->prepare($value, $column)
            ->replace(['\\', '-'], '/')
            ->before('/')
            ->lower();
    }

    public function number(mixed $value, string $column): array
    {
        return $this->prepare($value, $column)
            ->replace(['\\', '-'], '/')
            ->explode('/')
            ->map(fn (mixed $val) => (int) $val)
            ->toArray();
    }

    public function size(string $value): string
    {
        if ($this->str->match($value, '/(\d+x)/')) {
            return $this->str->replace('x', '', $value);
        }

        if ($count = $this->str->count($value)) {
            return $this->str->replace($value, $this->str->pad($count), $count);
        }

        return $this->str->replace($value, ['s', 'm', 'l'], ['0s', '0m', '0l']);
    }

    public function callback(callable $callback, mixed ...$parameters): mixed
    {
        return $callback(...$parameters);
    }

    protected function prepare(mixed $value, string $column): Stringable
    {
        return $this->str->of(
            $this->key($value, $column)
        )
            ->squish()
            ->trim();
    }
}
