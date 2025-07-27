<?php

declare(strict_types=1);

namespace Tests\Fixtures\Objects;

use Stringable as Contract;

class Stringable implements Contract
{
    public function __construct(
        protected mixed $value
    ) {}

    public function __toString(): string
    {
        return (string) $this->value;
    }
}
