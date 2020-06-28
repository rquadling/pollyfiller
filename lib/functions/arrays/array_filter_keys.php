<?php

/**
 * Polyfiller
 *
 * LICENSE
 *
 * This is free and unencumbered software released into the public domain.
 *
 * Anyone is free to copy, modify, publish, use, compile, sell, or distribute this software, either in source code form or
 * as a compiled binary, for any purpose, commercial or non-commercial, and by any means.
 *
 * In jurisdictions that recognize copyright laws, the author or authors of this software dedicate any and all copyright
 * interest in the software to the public domain. We make this dedication for the benefit of the public at large and to the
 * detriment of our heirs and successors. We intend this dedication to be an overt act of relinquishment in perpetuity of
 * all present and future rights to this software under copyright law.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE
 * WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS BE
 * LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT
 * OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 * For more information, please refer to <https://unlicense.org>
 *
 */

if (!function_exists('array_filter_keys')) {
    /**
     * Filters elements of an array using a callback function, based upon the key.
     *
     * This function operates in the same way as PHP's array_filter() function, but uses the key rather than the value.
     *
     * @param array<mixed, mixed> $data The array to iterate over
     * @param callable|null $callback The callback function to use. If no callback is supplied, all entries of input
     *                                equal to FALSE will be removed.
     *                                The callback parameters are $key and must return a boolean.
     *
     * @return array<mixed, mixed> Returns filtered elements
     *
     * @author acid24@gmail.com via http://www.php.net/manual/en/function.array-filter.php#99073
     */
    function array_filter_keys(array $data, callable $callback = null): array
    {
        if (empty($data)) {
            return $data;
        }

        if ($callback) {
            $filteredKeys = array_filter(array_keys($data), $callback);
        } else {
            $filteredKeys = array_filter(array_keys($data));
        }

        if (empty($filteredKeys)) {
            return [];
        }

        return array_intersect_key($data, array_flip($filteredKeys));
    }
}
