<?php

declare(strict_types=1);

namespace Tests\Unit\Support\Resolve;

use DragonCode\SizeSorter\Support\Resolve;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Fixtures\Enums\IntegerEnum;
use Tests\Fixtures\Enums\StringEnum;
use Tests\Fixtures\Enums\UnitEnum;
use Tests\Fixtures\Objects\Stringable;
use Tests\TestCase;

class ValueTest extends TestCase
{
    #[DataProvider('valuesData')]
    public function testValue(mixed $expected, mixed $input): void
    {
        $this->assertSame($expected, Resolve::value($input, 'value'));
    }

    public static function valuesData(): array
    {
        return [
            'string' => [
                'expected' => 'foo',
                'input'    => 'foo',
            ],

            'integer' => [
                'expected' => 123,
                'input'    => 123,
            ],

            'float' => [
                'expected' => 123.45,
                'input'    => 123.45,
            ],

            'bool true' => [
                'expected' => true,
                'input'    => true,
            ],

            'bool false' => [
                'expected' => false,
                'input'    => false,
            ],

            'integer enum' => [
                'expected' => 30,
                'input'    => IntegerEnum::Value30,
            ],

            'string enum' => [
                'expected' => '39х38х15 см',
                'input'    => StringEnum::Value39_38_15,
            ],

            'unit enum' => [
                'expected' => 'Xxxl',
                'input'    => UnitEnum::Xxxl,
            ],

            'array' => [
                'expected' => 'some',
                'input'    => ['value' => 'some'],
            ],

            'object' => [
                'expected' => 'some',
                'input'    => (object) ['value' => 'some'],
            ],

            'stringable' => [
                'expected' => 'some',
                'input'    => new Stringable('some'),
            ],
        ];
    }
}
