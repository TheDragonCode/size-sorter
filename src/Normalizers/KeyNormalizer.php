<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Normalizers;

use DragonCode\SizeSorter\Support\Cache;
use Illuminate\Support\Str;

use function is_bool;
use function is_numeric;

class KeyNormalizer extends Normalizer
{
    public static function normalize(mixed $value): string
    {
        if ($value === null) {
            return 'null';
        }

        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }

        if (is_numeric($value)) {
            return (string) $value;
        }

        return Cache::remember(
            $value,
            static fn () => Str::of($value)
                ->replaceMatches('/[\W_\s]+/u', ' ')
                ->trim()
                ->slug('_')
                ->toString()
        );
    }
}
