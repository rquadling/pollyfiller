# RQuadling/Polyfiller

[![Build Status](https://img.shields.io/travis/rquadling/polyfiller.svg?style=for-the-badge&logo=travis)](https://travis-ci.org/rquadling/polyfiller)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/rquadling/polyfiller.svg?style=for-the-badge&logo=scrutinizer)](https://scrutinizer-ci.com/g/rquadling/polyfiller/)
[![GitHub issues](https://img.shields.io/github/issues/rquadling/polyfiller.svg?style=for-the-badge&logo=github)](https://github.com/rquadling/polyfiller/issues)

[![PHP Version](https://img.shields.io/packagist/php-v/rquadling/polyfiller.svg?style=for-the-badge)](https://github.com/rquadling/polyfiller)
[![Stable Version](https://img.shields.io/packagist/v/rquadling/polyfiller.svg?style=for-the-badge&label=Latest)](https://packagist.org/packages/rquadling/polyfiller)

[![Total Downloads](https://img.shields.io/packagist/dt/rquadling/polyfiller.svg?style=for-the-badge&label=Total+downloads)](https://packagist.org/packages/rquadling/polyfiller)
[![Monthly Downloads](https://img.shields.io/packagist/dm/rquadling/polyfiller.svg?style=for-the-badge&label=Monthly+downloads)](https://packagist.org/packages/rquadling/polyfiller)
[![Daily Downloads](https://img.shields.io/packagist/dd/rquadling/polyfiller.svg?style=for-the-badge&label=Daily+downloads)](https://packagist.org/packages/rquadling/polyfiller)

A set of polyfillers for strings, arrays, etc. used by RQuadling's various projects

## Installation

Using Composer:

```sh
composer require rquadling/polyfiller
```

# Polyfillers
1. Arrays
    1. `array_filter_keys` - Filters elements of an array using a callback function, based upon the key.
    2. `array_get` - Returns the requested value from an array based upon the key or the default value if the key does not exist.
    3. `array_to_table` - Convert an array that fits a database result set into a plain text table.
2. Classes
    1. `class_uses_recursive` - Returns all traits used by a class, its parent classes and trait of their traits.
    2. `trait_uses_recursive` - Returns all traits used by a trait and its traits.
2. Strings
    1. `mb_str_pad` - Multibyte String Pad.
    2. `str_to_kebab_case` - Convert a string to kebab case.
