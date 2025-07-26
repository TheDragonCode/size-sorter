<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Services;

use DragonCode\SizeSorter\Enum\Group;

use function array_column;

class Order
{
    /**
     * @param  Group[]|null  $groups
     * @return int[]
     */
    public function resolve(?array $groups = null): array
    {
        return array_column($this->fill($groups ?? []), 'value');
    }

    protected function fill(array $groups): array
    {
        foreach ($this->fallback() as $group) {
            if (! in_array($group, $groups, true)) {
                $groups[] = $group;
            }
        }

        return $groups;
    }

    /**
     * @return Group[]
     */
    protected function fallback(): array
    {
        return Group::cases();
    }
}
