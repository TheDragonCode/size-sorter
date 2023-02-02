<?php

declare(strict_types=1);

namespace DragonCode\SizeSorter\Services;

use DragonCode\SizeSorter\Contracts\GroupMatcher;
use DragonCode\SizeSorter\Detectors\Group1;
use DragonCode\SizeSorter\Detectors\Group2;
use DragonCode\SizeSorter\Detectors\Group3;
use DragonCode\SizeSorter\Detectors\Group4;
use DragonCode\SizeSorter\Enum\Groups;

class GroupsDetector
{
    /** @var array<class-string, Groups> */
    protected array $detectors = [
        Group1::class => Groups::GROUP_1,
        Group2::class => Groups::GROUP_2,
        Group3::class => Groups::GROUP_3,
        Group4::class => Groups::GROUP_4,
    ];

    protected Groups $default = Groups::GROUP_5;

    public function __construct(
        protected Str $str = new Str()
    ) {
    }

    public function detect(string $value): int
    {
        foreach ($this->detectors as $detector => $group) {
            if ($this->resolve($detector)->detect($value)) {
                return $group->value;
            }
        }

        return $this->default->value;
    }

    protected function resolve(string $matcher): GroupMatcher
    {
        return new $matcher($this->str);
    }
}
