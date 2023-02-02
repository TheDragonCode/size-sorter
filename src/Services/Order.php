<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Services;

use DragonCode\SizeSorter\Enum\Group;

class Order
{
    public static function resolve(?array $groups): array
    {
        return ! empty($groups)
            ? static::fill($groups)
            : static::groups();
    }

    protected static function fill(array $groups): array
    {
        return static::fillDefault(
            static::fillCustom($groups)
        );
    }

    protected static function fillCustom(array $groups): array
    {
        $result = [];

        foreach ($groups as $group) {
            $value = static::resolveValue($group);

            if (static::existGroup($value)) {
                $result[] = $value;
            }
        }

        return $result;
    }

    protected static function fillDefault(array $groups): array
    {
        foreach (static::groups() as $group) {
            if (! in_array($group, $groups)) {
                $groups[] = $group;
            }
        }

        return $groups;
    }

    protected static function existGroup(int $value): bool
    {
        return Group::exists($value);
    }

    /**
     * @return array<Group>
     */
    protected static function groups(): array
    {
        return Group::values();
    }

    protected static function resolveValue(Group|int $group): int
    {
        return $group->value ?? $group;
    }
}
