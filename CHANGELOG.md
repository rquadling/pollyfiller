# Change Log
All notable changes to this project will be documented in this file.

## 2.0.0 - 2020-06-28
- Upgrade minimum PHP 7.4+

## 1.1.0 - 2019-12-31
### Arrays
- Expanded the signature for `array_to_table` to allow the `$options` to be an array of `options` and `helperLines` or
  just an integer.
  e.g.
  ```php
  public function testArrayToTable(array $set, array $column, int $options = 0): string {}
  ```
  or
  ```php
  public function testArrayToTable(array $set, array $column, array $options = ['options'=>0,'helperLines'=>5]): string {}
  ```

## 1.0.1 - 2019-12-21
### Fixes
- Add PHP 7.0.0 as minimum version
- Removed unnecessary composer's autoloader access.

## 1.0.0 - 2019-12-21 - Initial release
### Arrays
- `array_filter_keys` - Filters elements of an array using a callback function, based upon the key.
- `array_get` - Returns the requested value from an array based upon the key or the default value if the key does not exist.
- `array_to_table` - Convert an array that fits a database result set into a plain text table.
### Classes
- `class_uses_recursive` - Returns all traits used by a class, its parent classes and trait of their traits.
- `trait_uses_recursive` - Returns all traits used by a trait and its traits.
### Strings
- `mb_str_pad` - Multibyte String Pad.
- `str_to_kebab_case` - Convert a string to kebab case.
