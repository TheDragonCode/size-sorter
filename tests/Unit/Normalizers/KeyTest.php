<?php

declare(strict_types=1);

namespace Tests\Unit\Normalizers;

use DragonCode\SizeSorter\Normalizers\KeyNormalizer;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class KeyTest extends TestCase
{
    #[DataProvider('valuesData')]
    public function testValue(string $expected, mixed $input): void
    {
        $this->assertSame($expected, KeyNormalizer::normalize($input));
    }

    public static function valuesData(): array
    {
        return [
            [
                'expected' => 'foo',
                'input'    => 'foo',
            ],
            [
                'expected' => 'foo',
                'input'    => 'FOO',
            ],
            [
                'expected' => 'foo',
                'input'    => 'FoO',
            ],
            [
                'expected' => '123',
                'input'    => 123,
            ],
            [
                'expected' => '123.45',
                'input'    => 123.45,
            ],
            [
                'expected' => 'true',
                'input'    => true,
            ],
            [
                'expected' => 'false',
                'input'    => false,
            ],
            [
                'expected' => 'null',
                'input'    => null,
            ],
            [
                'expected' => 'foo_bar',
                'input'    => 'foo bar',
            ],
            [
                'expected' => 'foo_bar',
                'input'    => 'foo-bar',
            ],
            [
                'expected' => 'foo_bar',
                'input'    => 'foo_bar',
            ],
            [
                'expected' => 'foo_bar',
                'input'    => 'foo/bar',
            ],
            [
                'expected' => 'foo_bar',
                'input'    => 'foo\\bar',
            ],
            [
                'expected' => 'foo_bar',
                'input'    => 'foo+bar',
            ],
            [
                'expected' => 'foo_bar',
                'input'    => 'foo=bar',
            ],
            [
                'expected' => 'foo_bar',
                'input'    => 'foo(bar',
            ],
            [
                'expected' => 'foo_bar',
                'input'    => 'foo)bar',
            ],
            [
                'expected' => 'foo_bar',
                'input'    => 'foo*bar',
            ],
            [
                'expected' => 'foo_bar_123',
                'input'    => 'foo bar 123',
            ],
            [
                'expected' => '40x38x19_sm',
                'input'    => '40х38х19 sm',
            ],
            [
                'expected' => '40x38x15_sm',
                'input'    => '40х38х15 см',
            ],
        ];
    }
}
