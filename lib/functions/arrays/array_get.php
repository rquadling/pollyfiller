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

if (!function_exists('array_get')) {
    /**
     * Returns the requested value from an array based upon the key or the default value if the key does not exist.
     *
     * @param array $data the data to examine
     * @param int|string|int[]|string[] $key the key or array of nested keys to find in the array
     * @param mixed $default the value to return if the key cannot be found
     *
     * @return mixed contains the value from the array or the default value if it cannot be found
     */
    function array_get(array $data, $key, $default = null)
    {
        if (is_array($key)) {
            $result = $data;

            foreach ($key as $singleKey) {
                if (!is_array($result)) {
                    $result = $default;
                }
                if ($result === $default) {
                    break;
                }
                $result = array_get($result, $singleKey, $default);
            }

            return $result;
        } else {
            return !empty($data) && array_key_exists($key, $data)
                ? $data[$key]
                : $default;
        }
    }
}
