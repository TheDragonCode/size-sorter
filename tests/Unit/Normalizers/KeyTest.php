<?php

declare(strict_types=1);

test('normalizer', function (mixed $input, string $output) {
    expect(
        normalizeSize($input)
    )->toBe($output);
})->with('key normalizer');
