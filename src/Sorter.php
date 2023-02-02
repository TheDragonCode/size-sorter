<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter;

use Closure;
use DragonCode\SizeSorter\Enum\Groups;
use DragonCode\Support\Facades\Helpers\Str;
use DragonCode\Support\Helpers\Ables\Stringable;
use Illuminate\Support\Collection;

class Sorter
{
    public static function sort(Collection $items, string $column = 'value'): Collection
    {
        return self::flatten(
            self::sorting($items, $column)
        );
    }

    protected static function sorting(Collection $items, string $column = 'value'): Collection
    {
        return $items
            ->groupBy(fn (mixed $size) => self::detectGroup(
                self::resolveValue($size, $column)->toString()
            ), true)
            ->sortKeys()
            ->map(fn (Collection $items, int $group) => self::sortGroup($items, $group, $column));
    }

    protected static function sortGroup(Collection $items, int $group, string $column): Collection
    {
        return match ($group) {
            Groups::GROUP_1() => self::sortChars($items, $column),
            Groups::GROUP_2() => self::sortNumbers($items, $column),
            default           => self::sortDefault($items, $column)
        };
    }

    protected static function sortChars(Collection $values, string $column): Collection
    {
        return $values->groupBy(
            fn (mixed $size) => self::resolveValue($size, $column)
                ->match('/(s|m|l)/')
                ->toString(),
            true
        )
            ->sortKeysDesc()
            ->map(function (Collection $values, string $group) use ($column) {
                return $group === 's'
                    ? self::sortSmallSizes($values, $column)
                    : self::sortDefault($values, $column);
            });
    }

    protected static function sortSmallSizes(Collection $values, string $column): Collection
    {
        return $values->sort(self::sortCallback(-1, $column))
            ->groupBy(fn (mixed $size) => self::resolveValue($size, $column)->toString(), true)
            ->map(fn (Collection $values) => self::sortSpecialChars($values, $column));
    }

    protected static function sortSpecialChars(Collection $values, string $column): Collection
    {
        return $values->sort(function (mixed $a, mixed $b) use ($column) {
            $a = self::resolveKey($a, $column);
            $b = self::resolveKey($b, $column);

            $arrow = self::contains($a, '/') && self::contains($b, '-') ? -1 : 1;

            return value(self::sortCallback($arrow, $column), $a, $b);
        });
    }

    protected static function sortDefault(Collection $values, string $column): Collection
    {
        return $values->sort(self::sortCallback(1, $column));
    }

    protected static function sortNumbers(Collection $items, string $column): Collection
    {
        return $items->sort(self::sortNumberCallback($column));
    }

    protected static function sortNumberCallback(string $column): Closure
    {
        return function (mixed $a, mixed $b) use ($column) {
            $a = self::resolveNumbers($a, $column);
            $b = self::resolveNumbers($b, $column);

            if ($a[0] === $b[0]) {
                if (isset($a[1], $b[1])) {
                    if ($a[1] === $b[1]) {
                        return 0;
                    }

                    return $a[1] > $b[1] ? 1 : -1;
                }

                return 0;
            }

            return $a[0] > $b[0] ? 1 : -1;
        };
    }

    protected static function sortCallback(int $arrow, string $column): Closure
    {
        return function (mixed $a, mixed $b) use ($arrow, $column) {
            $a = self::resolveKey($a, $column);
            $b = self::resolveKey($b, $column);

            if ($a === $b) {
                return 0;
            }

            return $a < $b ? -1 * $arrow : $arrow;
        };
    }

    protected static function detectGroup(string $value): int
    {
        return match (true) {
            self::match($value, '/^(x*[sml])$/')                                          => Groups::GROUP_1(),
            self::match(self::slug($value), '/^(\d+-?\d*)$/')                             => Groups::GROUP_2(),
            self::match(self::slug($value), '/^(\d+[a-f]{1,2})$/')                        => Groups::GROUP_3(),
            self::match(self::clean($value), ['/^([\d\-hx\*]*0s0m)$/', '/^(\d+[a-f])$/']) => Groups::GROUP_4(),
            default                                                                       => Groups::GROUP_5()
        };
    }

    protected static function clean(string $value): string
    {
        return Str::of($value)
            ->trim()
            ->squish()
            ->replace('\\', '/')
            ->explode('/')
            ->map(fn (string $value) => self::compact($value))
            ->implode('/')
            ->toString();
    }

    protected static function compact(string $value): string
    {
        return Str::of($value)
            ->slug()
            ->explode('-')
            ->map(fn (string $value) => self::resolveSize($value))
            ->implode('-')
            ->toString();
    }

    protected static function flatten(Collection|array $collection): Collection
    {
        $results = [];

        foreach ($collection as $key => $value) {
            if (! $value instanceof Collection) {
                $results[$key] = $value;

                continue;
            }

            $flatten = self::flatten($value);

            $results = self::merge($results, $flatten);
        }

        return collect($results);
    }

    protected static function merge(array $first, Collection|array $second): array
    {
        foreach ($second as $key => $value) {
            $first[$key] = $value;
        }

        return $first;
    }

    protected static function resolveSize(string $value): string
    {
        if (self::match($value, '/(\d+x)/')) {
            return self::replace('x', '', $value);
        }

        if ($count = Str::count($value, 'x')) {
            return self::replace($value, self::pad($count), $count);
        }

        return self::replace($value, ['s', 'm', 'l'], ['0s', '0m', '0l']);
    }

    protected static function resolveKey(object|array|string $value, string $column)
    {
        return $value->{$column} ?? $value[$column] ?? $value;
    }

    protected static function resolveValue(mixed $value, string $column): Stringable
    {
        return Str::of(self::resolveKey($value, $column))
            ->replace(['\\', '-'], '/')
            ->before('/')
            ->lower();
    }

    protected static function resolveNumbers(mixed $value, string $column): array
    {
        return Str::of(self::resolveKey($value, $column))
            ->replace(['\\', '-'], '/')
            ->explode('/')
            ->map(fn (mixed $val) => (int) $val)
            ->toArray();
    }

    protected static function match(string $value, array|string $pattern): bool
    {
        return Str::matchContains($value, $pattern);
    }

    protected static function slug(string $value): string
    {
        return Str::slug($value);
    }

    protected static function contains(string $value, string $needle): bool
    {
        return Str::contains($value, $needle);
    }

    protected static function replace(string $value, array|string $search, array|string|int $replace): string
    {
        return Str::replace($value, $search, $replace);
    }

    protected static function pad(int $length): string
    {
        return str_pad('', $length, 'x');
    }
}
