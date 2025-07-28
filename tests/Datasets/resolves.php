<?php

declare(strict_types=1);

use Tests\Fixtures\Enums\IntegerEnum;
use Tests\Fixtures\Enums\StringEnum;
use Tests\Fixtures\Enums\UnitEnum;
use Tests\Fixtures\Objects\Stringable;

dataset('resolves', [
    'string' => [
        'input'  => 'foo',
        'output' => 'foo',
    ],

    'integer' => [
        'input'  => 123,
        'output' => 123,
    ],

    'float' => [
        'input'  => 123.45,
        'output' => 123.45,
    ],

    'bool true' => [
        'input'  => true,
        'output' => true,
    ],

    'bool false' => [
        'input'  => false,
        'output' => false,
    ],

    'integer enum' => [
        'input'  => IntegerEnum::Value30,
        'output' => 30,
    ],

    'string enum' => [
        'input'  => StringEnum::Value39_38_15,
        'output' => '39х38х15 см',
    ],

    'unit enum' => [
        'input'  => UnitEnum::Xxxl,
        'output' => 'Xxxl',
    ],

    'array' => [
        'input'  => ['value' => 'some'],
        'output' => 'some',
    ],

    'object' => [
        'input'  => (object) ['value' => 'some'],
        'output' => 'some',
    ],

    'stringable' => [
        'input'  => new Stringable('some'),
        'output' => 'some',
    ],
]);
