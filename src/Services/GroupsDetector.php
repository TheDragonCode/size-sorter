<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Services;

use DragonCode\SizeSorter\Detectors\BaseDetector;
use DragonCode\SizeSorter\Detectors\BraSizeDetector;
use DragonCode\SizeSorter\Detectors\ClothesAndShoesDetector;
use DragonCode\SizeSorter\Detectors\LetterClothingSizeDetector;
use DragonCode\SizeSorter\Detectors\OverallDimensionsDetector;
use DragonCode\SizeSorter\Enum\Group;

class GroupsDetector
{
    /** @var array<class-string|BaseDetector, Group> */
    protected static array $detectors = [
        LetterClothingSizeDetector::class => Group::LetterClothingSize,
        ClothesAndShoesDetector::class    => Group::ClothesAndShoes,
        BraSizeDetector::class            => Group::BraSize,
        OverallDimensionsDetector::class  => Group::OverallDimensions,
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
