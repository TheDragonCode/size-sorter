<?php

declare(strict_types=1);

dataset('key normalizer', [
    [
        'input'  => 'foo',
        'output' => 'foo',
    ],
    [
        'input'  => 'FOO',
        'output' => 'foo',
    ],
    [
        'input'  => 'FoO',
        'output' => 'foo',
    ],
    [
        'input'  => 123,
        'output' => '123',
    ],
    [
        'input'  => 123.45,
        'output' => '123.45',
    ],
    [
        'input'  => true,
        'output' => 'true',
    ],
    [
        'input'  => false,
        'output' => 'false',
    ],
    [
        'input'  => null,
        'output' => 'null',
    ],
    [
        'input'  => 'foo bar',
        'output' => 'foo_bar',
    ],
    [
        'input'  => 'foo-bar',
        'output' => 'foo_bar',
    ],
    [
        'input'  => 'foo_bar',
        'output' => 'foo_bar',
    ],
    [
        'input'  => 'foo/bar',
        'output' => 'foo_bar',
    ],
    [
        'input'  => 'foo\\bar',
        'output' => 'foo_bar',
    ],
    [
        'input'  => 'foo+bar',
        'output' => 'foo_bar',
    ],
    [
        'input'  => 'foo=bar',
        'output' => 'foo_bar',
    ],
    [
        'input'  => 'foo(bar',
        'output' => 'foo_bar',
    ],
    [
        'input'  => 'foo)bar',
        'output' => 'foo_bar',
    ],
    [
        'input'  => 'foo*bar',
        'output' => 'foo_bar',
    ],
    [
        'input'  => 'foo bar 123',
        'output' => 'foo_bar_123',
    ],
    [
        'input'  => '40х38х19 sm',
        'output' => '40x38x19_sm',
    ],
    [
        'input'  => '40х38х15 см',
        'output' => '40x38x15_sm',
    ],
]);
