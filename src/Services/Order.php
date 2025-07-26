<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Services;

use DragonCode\SizeSorter\Enum\Group;

class Order
{
    public function resolve(?array $groups = null): array
    {
        return ! empty($groups)
            ? $this->fill($groups)
            : $this->groups();
    }

    protected function fill(array $groups): array
    {
        return $this->fillDefault(
            $this->fillCustom($groups)
        );
    }

    protected function fillCustom(array $groups): array
    {
        $result = [];

        foreach ($groups as $group) {
            $value = $this->resolveValue($group);

            if ($this->existGroup($value)) {
                $result[] = $value;
            }
        }

        return $result;
    }

    protected function fillDefault(array $groups): array
    {
        foreach ($this->groups() as $group) {
            if (! in_array($group, $groups, true)) {
                $groups[] = $group;
            }
        }

        return $groups;
    }

    protected function existGroup(int $value): bool
    {
        return Group::exists($value);
    }

    /**
     * @return Group[]
     */
    protected function groups(): array
    {
        return Group::values();
    }

    protected function resolveValue(Group|int $group): int
    {
        return $group->value ?? $group;
    }
}
