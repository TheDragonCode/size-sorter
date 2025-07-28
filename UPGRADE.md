# Upgrade Guide

## To 2.x from 1.0

### PHP 8.2.0 Required

`Size Sorter` now requires PHP 8.2.0 or greater.

### Updating Dependencies

You should update the following dependencies in your application's `composer.json` file:

- `dragon-code/size-sorter` to `^2.0`

### Frameworks Compatibility

When using the Laravel framework, make sure that its version is 11.0 or greater.

### Changing Namespace

Namespace should be changed:

You should update the namespace and method name to call:

```diff
-DragonCode\SizeSorter\Sorter::sort()
+DragonCode\SizeSorter\SizeSorter::items()

-use DragonCode\SizeSorter\Enum\Group;
+use DragonCode\SizeSorter\Enums\GroupEnum;
```

### Changing parameters and call methods

```diff
-use DragonCode\SizeSorter\Sorter;
-use DragonCode\SizeSorter\Enum\Group;
+use DragonCode\SizeSorter\SizeSorter;
+use DragonCode\SizeSorter\Enums\GroupEnum;

-$sort1 = Sorter::sort($items, 'column.name', [1, 2]);
-$sort2 = Sorter::sort($items, 'column.name', [Group::GROUP_1, Group::GROUP_2]);
+
+$sort = SizeSorter::items($items)
+    ->column('column.name')
+    ->orderBy([
+        GroupEnum::LetterClothingSize,
+        GroupEnum::ClothesAndShoes,
+    ])
+    ->sort();
```

### Groups

> [!WARNING]
>
> The array to sort must now consist of GroupEnum objects.
> Integers are no longer accepted.

- `Group::GROUP_1` replaced by `GroupEnum::LetterClothingSize`
- `Group::GROUP_2` replaced by `GroupEnum::ClothesAndShoes`
- `Group::GROUP_3` replaced by `GroupEnum::BraSize`
- `Group::GROUP_4` replaced by `GroupEnum::OverallDimensions`
- `Group::GROUP_5` replaced by `GroupEnum::OtherSizes`

```php
enum GroupEnum: int
{
    case LetterClothingSize = 1;
    case ClothesAndShoes    = 2;
    case BraSize            = 3;
    case OverallDimensions  = 4;
    case VolumeGroup        = 5; // New group
    case OtherSizes         = 100;
}
```
