<?php

declare(strict_types=1);

namespace Tests\Unit\Detectors;

use DragonCode\SizeSorter\Groups\Group as SizeDetector;
use DragonCode\SizeSorter\Normalizers\KeyNormalizer;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

abstract class Detector extends TestCase
{
    protected SizeDetector|string $detector;

    #[DataProvider('valuesData')]
    public function testValues(int|string $value, bool $expected = false): void
    {
        $actual = $this->detector::detect(
            $this->normalize($value)
        );

        $this->assertSame($expected, $actual);
    }

    abstract public static function valuesData(): array;

    protected function normalize(int|string $value): string
    {
        return KeyNormalizer::normalize($value);
    }
}
