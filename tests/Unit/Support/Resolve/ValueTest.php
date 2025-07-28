<?php

declare(strict_types=1);

use DragonCode\SizeSorter\Support\Resolve;

test('resolve', function (mixed $input, mixed $output) {
    expect(
        Resolve::value($input, 'value')
    )->toBe($output);
})->with('resolves');
