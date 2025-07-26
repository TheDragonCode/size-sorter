<?php

declare(strict_types=1);

namespace Tests\Unit\Support\Validator;

use DragonCode\SizeSorter\Support\Validator;
use LengthException;
use Tests\TestCase;

class MapCountTest extends TestCase
{
    public function testSuccess(): void
    {
        $items = collect([1, 2, 3]);

        Validator::mapCount($items, $items);

        $this->assertTrue(true);
    }

    public function testWrong(): void
    {
        $this->expectException(LengthException::class);

        $this->expectExceptionMessage(
            'The count of items in the map (2) and collection (3) should be the same.'
        );

        Validator::mapCount(
            collect([1, 2, 3]),
            collect([1, 2]),
        );
    }
}
