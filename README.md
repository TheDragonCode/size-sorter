# Product Size Sorter

![The Dragon Code Product size sorting](https://preview.dragon-code.pro/TheDragonCode/Product%20size%20sorting.svg?brand=php)

[![Stable Version][badge_stable]][link_packagist]
[![Unstable Version][badge_unstable]][link_packagist]
[![Total Downloads][badge_downloads]][link_packagist]
[![Github Workflow Status][badge_build]][link_build]
[![License][badge_license]][link_license]

> Easily sort clothing size, height, bra size, furniture size and more

## Installation

To get the latest version of `Product Size Sorter`, simply require the project using [Composer](https://getcomposer.org):

```bash
composer require dragon-code/size-sorter
```

Or manually update `require` block of `composer.json` and run composer update.

```json
{
    "require": {
        "dragon-code/size-sorter": "^1.0"
    }
}
```

## Compatibility

> Note
> 
> This package can work outside the frameworks systems.

| Compatibility | Versions          |
|:--------------|:------------------|
| PHP           | ^8.1              |
| Laravel       | ^8.0, ^9.0, ^10.0 |
| Symfony       | ^5.3, ^6.0        |

## Usage

When calling a sort with common values, each element will be assigned to one of five groups:

1. Letter clothing size (XXS, XS, M, L, etc.)
2. Numerical size of clothes and shoes (9, 10, 44-46, 48, etc.)
3. Bra size (70B, 75A, 80C, etc...)
4. Overall dimensions of items (40x38x19 sm, etc.)
5. Other values

```php
use DragonCode\SizeSorter\Sorter;

return Sorter::sort(collect([
    'XXL',
    '26',
    '28',
    'XL',
    'ONE SIZE',
    'XXS',
    '2',
    '54',
]));

/*
 * Returns:
 * 
 * Collection([
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
use DragonCode\SizeSorter\Sorter;

$items = Size::query()->get();

return Sorter::sort($items, 'title');
```

> You can see more examples in the [test file](tests/Sorters/SorterTest.php).

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

return Sorter::sort($items, groupsOrder: [3, 5, 4, 2, 1]);
// or
return Sorter::sort($items, groupsOrder: [Group::GROUP_3, Group::GROUP_5, Group::GROUP_4, Group::GROUP_2, Group::GROUP_1]);
```

The final array will be formed in the specified order:

```
3 - 5 - 4 - 2 - 1
```

You can also specify some groups. For example:

```php
use DragonCode\SizeSorter\Enum\Group;
use DragonCode\SizeSorter\Sorter;

return Sorter::sort($items, groupsOrder: [3, 5]);
// or
return Sorter::sort($items, groupsOrder: [Group::GROUP_3, Group::GROUP_5]);
```

In this case, the first two logical groups will be sorted in the specified order, and the subsequent ones will be in ascending order:

```
3 - 5 - 1 - 2 - 4
```

## License

This package is licensed under the [MIT License](LICENSE).


[badge_build]:          https://img.shields.io/github/actions/workflow/status/TheDragonCode/size-sorter/phpunit.yml?style=flat-square

[badge_downloads]:      https://img.shields.io/packagist/dt/dragon-code/size-sorter.svg?style=flat-square

[badge_license]:        https://img.shields.io/packagist/l/dragon-code/size-sorter.svg?style=flat-square

[badge_stable]:         https://img.shields.io/github/v/release/TheDragonCode/size-sorter?label=stable&style=flat-square

[badge_unstable]:       https://img.shields.io/badge/unstable-dev--main-orange?style=flat-square

[link_build]:           https://github.com/TheDragonCode/size-sorter/actions

[link_license]:         LICENSE

[link_packagist]:       https://packagist.org/packages/dragon-code/size-sorter
