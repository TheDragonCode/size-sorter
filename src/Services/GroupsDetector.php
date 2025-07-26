<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Services;

use DragonCode\SizeSorter\Detectors\Base as BaseDetector;
use DragonCode\SizeSorter\Detectors\Group1;
use DragonCode\SizeSorter\Detectors\Group2;
use DragonCode\SizeSorter\Detectors\Group3;
use DragonCode\SizeSorter\Detectors\Group4;
use DragonCode\SizeSorter\Enum\Group;

class GroupsDetector
{
    /** @var array<class-string|BaseDetector, Group> */
    protected static array $detectors = [
        Group1::class => Group::LetterClothingSize,
        Group2::class => Group::ClothesAndShoes,
        Group3::class => Group::BraSize,
        Group4::class => Group::OverallDimensions,
    ];

    protected static Group $default = Group::OtherSizes;

    public static function detect(string $value): int
    {
        foreach (static::$detectors as $detector => $group) {
            if ($detector::detect($value)) {
                return $group->value;
            }
        }

        return static::$default->value;
    }
}
