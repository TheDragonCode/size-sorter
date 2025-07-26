# Product Size Sorter

![The Dragon Code Product size sorting](https://preview.dragon-code.pro/TheDragonCode/Product%20size%20sorting.svg?brand=php)

[![Stable Version][badge_stable]][link_packagist]
[![Total Downloads][badge_downloads]][link_packagist]
[![Github Workflow Status][badge_build]][link_build]
[![License][badge_license]][link_license]

> Easily sort clothing size, height, bra size, furniture size and more

## Installation

To get the latest version of `Product Size Sorter`, simply require the project
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

## Usage

When calling a sort with common values, each element will be assigned to one of five groups:

1. Letter clothing size (XXS, XS, M, L, 2XL, etc.)
2. Numerical size of clothes and shoes (9, 10, 44-46, 48, etc.)
3. Bra size (70B, 75A, 80C, etc...)
4. Overall dimensions of items (40x38x19 sm, etc.)
5. Other values

```php
use DragonCode\SizeSorter\Sorter;

return new Sorter([
    'XXL',
    '26',
    '28',
    'XL',
    'ONE SIZE',
    'XXS',
    '2',
    '54',
])->sort1();

/*
 * Returns:
 * 
 * array: [
 *   'XXS',
 *   'XL',
 *   'XXL',
 *   '2',
 *   '26',
 *   '28',
 *   '54',
 *   'ONE SIZE',
 * ]
 */
```

```php
use DragonCode\SizeSorter\Sorter;

// Laravel models collection
$items = Size::query()->get();

return new Sorter($items)
    ->column('title')
    ->sort1();
```

```php
use DragonCode\SizeSorter\Sorter;

// Laravel collection
$items = collect([...]);

return new Sorter($items)
    ->sort1();

/*
 * Returns:
 * 
 * Collection: [
 *   // ...
 * ]
 */
```

### Groups Order

By default, sizes are sorted by the following logical blocks:

1. Letter clothing size (XXS, XS, M, L, etc.)
2. Numerical size of clothes and shoes (9, 10, 44-46, 48, etc.)
3. Bra size (70B, 75A, 80C, etc...)
4. Overall dimensions of items (40x38x19 sm, etc.)
5. Other values

But you can change the order by specifying identifiers as the third parameter:

```php
use DragonCode\SizeSorter\Enum\Group;
use DragonCode\SizeSorter\Sorter;

return new Sorter($items)
    ->groupsOrder([3, 5, 4, 2, 1])
    ->sort1();

// or

return new Sorter($items)
    ->groupsOrder([
        Group::BraSize,
        Group::OtherSizes,
        Group::OverallDimensions,
        Group::ClothesAndShoes,
        Group::LetterClothingSize,
    ])
    ->sort1();
```

The final array will be formed in the specified order:

```
3 - 5 - 4 - 2 - 1
```

You can also specify some groups. For example:

```php
use DragonCode\SizeSorter\Enum\Group;
use DragonCode\SizeSorter\Sorter;

return new Sorter($items)
    ->groupsOrder([3, 5])
    ->sort1();

// or

return new Sorter($items)
    ->groupsOrder([Group::BraSize, Group::OtherSizes])
    ->sort1();
```

In this case, the first two logical groups will be sorted in the specified order, and the subsequent ones will be in
ascending order:

```
3 - 5 - 1 - 2 - 4
```

## License

This package is licensed under the [MIT License](LICENSE).


[badge_build]:          https://img.shields.io/github/actions/workflow/status/TheDragonCode/size-sorter/phpunit.yml?style=flat-square

[badge_downloads]:      https://img.shields.io/packagist/dt/dragon-code/size-sorter.svg?style=flat-square

[badge_license]:        https://img.shields.io/packagist/l/dragon-code/size-sorter.svg?style=flat-square

[badge_stable]:         https://img.shields.io/github/v/release/TheDragonCode/size-sorter?label=stable&style=flat-square

[link_build]:           https://github.com/TheDragonCode/size-sorter/actions

[link_license]:         LICENSE

[link_packagist]:       https://packagist.org/packages/dragon-code/size-sorter
