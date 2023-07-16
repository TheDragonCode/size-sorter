<?php

declare(strict_types=1);

namespace Tests\Fixtures\Helpers;

use Stringable;

class Str implements Stringable
{
    public function __construct(
        protected mixed $value
    ) {}

    public function __toString(): string
    {
        return (string) $this->value;
    }
}
