<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Detectors;

class Group4 extends Base
{
    protected array|string $pattern = [
        '/^([\d\-hx\*]*0s0m)$/',
        '/^(\d+[a-f])$/',
    ];

    protected function prepare(string $value): string
    {
        return $this->str->of($value)
            ->squish()
            ->trim()
            ->replace('\\', '/')
            ->explode('/')
            ->map(fn (string $value) => $this->compact($value))
            ->implode('/')
            ->toString();
    }

    protected function compact(string $value): string
    {
        return $this->str->of($value)
            ->slug()
            ->explode('-')
            ->map(fn (string $value) => $this->resolver->size($value))
            ->implode('-')
            ->toString();
    }
}
