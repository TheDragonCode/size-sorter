# Size Sorter

![the dragon code size sorter](https://preview.dragon-code.pro/the-dragon-code/size-sorter.svg?brand=php&invert=1)

[![Stable Version][badge_stable]][link_packagist]
[![Unstable Version][badge_unstable]][link_packagist]
[![Total Downloads][badge_downloads]][link_packagist]
[![Github Workflow Status][badge_build]][link_build]
[![License][badge_license]][link_license]

> Easily sort clothing size, height, bra size, furniture size and more

## Installation

To get the latest version of `Size Sorter`, simply require the project using [Composer](https://getcomposer.org):

```bash
composer require dragon-code/size-sorter
```

Or manually update `require-dev` block of `composer.json` and run composer update.

```json
{
    "require-dev": {
        "dragon-code/size-sorter": "^1.0"
    }
}
```

## Compatibility

> Note: This package can work outside the frameworks systems.

| Service | Versions                |
|:--------|:------------------------|
| PHP     | ^8.0                    |
| Laravel | ^7.0, ^8.0, ^9.0, ^10.0 |
| Symfony | ^5.3, ^6.0              |

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
