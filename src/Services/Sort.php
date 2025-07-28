<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Services;

use DragonCode\SizeSorter\Sorters\CharSorter;
use DragonCode\SizeSorter\Sorters\NumberSorter;
use Illuminate\Support\Collection;

class Sort
{
    public function byNumber(Collection $items): Collection
    {
        return $items->sortKeysUsing(
            NumberSorter::callback()
        );
    }

    public function byAlphabet(Collection $items): Collection
    {
        return $items->sortKeysUsing(
            CharSorter::callback()
        );
    }
}
