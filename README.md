# Size Sorter

<picture>
    <source media="(prefers-color-scheme: dark)" srcset="https://banners.beyondco.de/Size%20Sorter.png?pattern=topography&style=style_2&fontSize=100px&md=1&showWatermark=1&theme=dark&packageManager=composer+require&packageName=dragon-code%2Fsize-sorter&description=Easily+sort+clothing+size%2C+height%2C+bra+size%2C+furniture+size+and+more&images=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg">
    <img src="https://banners.beyondco.de/Size%20Sorter.png?pattern=topography&style=style_2&fontSize=100px&md=1&showWatermark=1&theme=light&packageManager=composer+require&packageName=dragon-code%2Fsize-sorter&description=Easily+sort+clothing+size%2C+height%2C+bra+size%2C+furniture+size+and+more&images=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg" alt="Size Sorter">
</picture>

[![Stable Version][badge_stable]][link_packagist]
[![Total Downloads][badge_downloads]][link_packagist]
[![Github Workflow Status][badge_build]][link_build]
[![License][badge_license]][link_license]

> Easily sort clothing size, height, bra size, furniture size and more

## Installation

To get the latest version of `Size Sorter`, simply require the project
using [Composer](https://getcomposer.org):

```bash
composer require dragon-code/size-sorter
```

Or manually update `require` block of `composer.json` and run composer update.

```json
{
    "require": {
        "dragon-code/size-sorter": "^2.0"
    }
}
```

> [!TIP]
> 
> When using the Laravel framework, make sure that its version is 11.0 or greater.

## Usage

When calling a sort with common values, each element will be assigned to one of five groups:

1. Letter clothing size (XXS, XS, M, L, 2XL, etc.)
2. Numerical size of clothes and shoes (9, 10, 44-46, 48, etc.)
3. Bra size (70B, 75A, 80C, etc...)
4. Overall dimensions of items (40x38x19 sm, etc.)
5. Volumes (450 ml, 30 l, 450ml, 30l, etc.)
6. Other values

```php
use DragonCode\SizeSorter\SizeSorter;

return new SizeSorter([
    'XXL',
    '26',
    '28',
    'XL',
    'ONE SIZE',
    'XXS',
    '2',
    '54',
])->sort();

/*
 * Returns:
 * 
 * Illuminate\Support\Collection([
 *   'XXS',
 *   'XL',
 *   'XXL',
 *   '2',
 *   '26',
 *   '28',
 *   '54',
 *   'ONE SIZE',
 * ])
 */
```

```php
use DragonCode\SizeSorter\SizeSorter;

// Laravel models collection
$items = Size::get();

return new SizeSorter($items)
    ->column('title')
    ->sort();
```

The static `items` method is also available:

```php
use DragonCode\SizeSorter\SizeSorter;

return SizeSorter::items([
    // ...
])->sort();
```

### Groups Order

By default, sizes are sorted by the following logical blocks:

1. Letter clothing size (XXS, XS, M, L, 2XL, etc.)
2. Numerical size of clothes and shoes (9, 10, 44-46, 48, etc.)
3. Bra size (70B, 75A, 80C, etc...)
4. Overall dimensions of items (40x38x19 sm, etc.)
5. Volumes (450 ml, 30 l, 450ml, 30l, etc.)
6. Other values

But you can change the order by specifying identifiers as the third parameter:

```php
use DragonCode\SizeSorter\Enum\Group;
use DragonCode\SizeSorter\SizeSorter;

return new SizeSorter($items)
    ->orderBy([
        Group::BraSize,
        Group::OtherSizes,
        Group::OverallDimensions,
        Group::ClothesAndShoes,
        Group::VolumeGroup,
        Group::LetterClothingSize,
    ])
    ->sort();
```

The final array will be formed in the specified order:

```
3 - 5 - 4 - 2 - 1
```

You can also specify some groups. For example:

```php
use DragonCode\SizeSorter\Enum\Group;
use DragonCode\SizeSorter\SizeSorter;

return new SizeSorter($items)
    ->orderBy([
        Group::BraSize,
        Group::OtherSizes,
    ])
    ->sort();
```

In this case, the first two logical groups will be sorted in the specified order, and the subsequent ones will be in
ascending order:

```
3 - 5 - 1 - 2 - 4
```

### Custom Column

When working with an array of objects, you can specify which value can be used for sorting.

```php
use DragonCode\SizeSorter\SizeSorter;

return new SizeSorter($items)
    ->column('foo')
    ->sort();
```

You can also use "dotted" notation:

```php
use DragonCode\SizeSorter\SizeSorter;

$items = [
    [
        'foo' => [
            'bar' => [
                'baz' => 'Some value',
            ]
        ]
    ]
];

return new SizeSorter($items)
    ->column('foo.bar.baz')
    ->sort();
```

And you can use the callback function in the same way:

```php
use DragonCode\SizeSorter\SizeSorter;

class Foo
{
    public function __construct(
        public int $number,
        public string $value1,
        public string $value2,
    ) {}
}

$items = [
    new Foo(1, 'first 1', 'first 2'),
    new Foo(2, 'second 1', 'second 2'),
];

return new SizeSorter($items)
    ->column(function (Foo $item) {
        return $item->number % 2 === 0
            ? $item->value1
            : $item->value2;
    })
    ->sort();
```

And this is also possible:

```php
use DragonCode\SizeSorter\SizeSorter;

$items = [
    ['foo' => 'XS'],
    ['foo' => '2XS'],
    ['foo' => '3XL'],
];

return new SizeSorter($items)
    ->column(function (array $item) {
        return match ($item['foo']) {
            '2XS' => 'XXS',
            '3XL' => 'XXXL',
            default => $item['foo']
        };
    })
    ->sort();
```

## Upgrade Guide

You can find the upgrade documentation [here](UPGRADE.md).

## License

This package is licensed under the [MIT License](LICENSE).


[badge_build]:          https://img.shields.io/github/actions/workflow/status/TheDragonCode/size-sorter/tests.yml?style=flat-square

[badge_downloads]:      https://img.shields.io/packagist/dt/dragon-code/size-sorter.svg?style=flat-square

[badge_license]:        https://img.shields.io/packagist/l/dragon-code/size-sorter.svg?style=flat-square

[badge_stable]:         https://img.shields.io/github/v/release/TheDragonCode/size-sorter?label=stable&style=flat-square

[link_build]:           https://github.com/TheDragonCode/size-sorter/actions

[link_license]:         LICENSE

[link_packagist]:       https://packagist.org/packages/dragon-code/size-sorter
