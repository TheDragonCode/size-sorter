<?php

declare(strict_types=1);

use DragonCode\SizeSorter\Support\GroupOrder;

test('fill', function (?array $input, array $output) {
    expect(
        GroupOrder::get($input)
    )->toBe($output);
})->with('groups');
