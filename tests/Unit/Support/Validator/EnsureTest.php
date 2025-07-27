<?php

declare(strict_types=1);

namespace Tests\Unit\Support\Validator;

use DragonCode\SizeSorter\Support\Validator;
use stdClass;
use Tests\TestCase;
use UnexpectedValueException;

class EnsureTest extends TestCase
{
    public function testSuccess(): void
    {
        Validator::ensure([
            (object) ['value' => 'foo'],
            (object) ['value' => 'bar'],
        ], stdClass::class);

        $this->assertTrue(true);
    }

    public function testWrong(): void
    {
        $this->expectException(UnexpectedValueException::class);

        $this->expectExceptionMessage(
            "Collection should only include [stdClass] items, but 'string' found at position 1."
        );

        Validator::ensure([
            (object) ['value' => 'foo'],
            'bar',
        ], stdClass::class);
    }
}
