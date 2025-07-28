<?php

declare(strict_types=1);

use DragonCode\SizeSorter\Enums\GroupEnum;
use DragonCode\SizeSorter\Groups\BraGroup;
use DragonCode\SizeSorter\Groups\ClothesAndShoesGroup;
use DragonCode\SizeSorter\Groups\Group;
use DragonCode\SizeSorter\Groups\LetterClothingGroup;
use DragonCode\SizeSorter\Groups\OtherGroup;
use DragonCode\SizeSorter\Groups\OverallDimensionsGroup;
use DragonCode\SizeSorter\Groups\VolumeGroup;

function groupDetect(Group|string $group, int|string $input, bool $toBe): void
{
    $actual = $group::detect(
        normalizeSize($input)
    );

    expect($actual)->toBe($toBe);
}

function groupNormalizer(Group|string $group, int|string $input, string $output): void
{
    $actual = $group::normalize(
        value: normalizeSize($input),
        key  : 111
    );

    expect($actual)->toBe(
        implode(Group::Delimiter, [findGroup($group), 111, $output])
    );
}

function findGroup(string $groupClass): int
{
    return match ($groupClass) {
        BraGroup::class               => GroupEnum::BraSize->value,
        ClothesAndShoesGroup::class   => GroupEnum::ClothesAndShoes->value,
        LetterClothingGroup::class    => GroupEnum::LetterClothingSize->value,
        OtherGroup::class             => GroupEnum::OtherSizes->value,
        VolumeGroup::class            => GroupEnum::VolumeGroup->value,
        OverallDimensionsGroup::class => GroupEnum::OverallDimensions->value,
    };
}
