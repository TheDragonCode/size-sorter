<?php

declare(strict_types=1);

namespace Tests\Unit;

use DragonCode\SizeSorter\SizeSorter;
use Tests\TestCase;

class SorterTest extends TestCase
{
    public function testDefault(): void
    {
        $sorted = SizeSorter::items($this->values)->sort();
    }
}
