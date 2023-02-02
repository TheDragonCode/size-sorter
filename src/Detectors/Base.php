<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Detectors;

use DragonCode\SizeSorter\Contracts\GroupMatcher;
use DragonCode\SizeSorter\Services\Resolver;
use DragonCode\SizeSorter\Services\Str;

abstract class Base implements GroupMatcher
{
    protected array|string $pattern;

    public function __construct(
        protected Str      $str = new Str(),
        protected Resolver $resolver = new Resolver()
    ) {
    }

    public function detect(string $value): bool
    {
        return $this->str->match($this->prepare($value), $this->pattern);
    }

    protected function prepare(string $value): string
    {
        return $value;
    }
}
