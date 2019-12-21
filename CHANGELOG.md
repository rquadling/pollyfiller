# Change Log
All notable changes to this project will be documented in this file.

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
