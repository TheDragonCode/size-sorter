<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Detectors;

class Group1 extends Base
{
    protected static array|string $pattern = '/^(x*[sml])$/';
}
