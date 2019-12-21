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

if (!function_exists('mb_str_pad')) {
    /**
     * Multibyte String Pad.
     *
     * Functionally, the equivalent of the standard str_pad function, but is capable of successfully padding multibyte strings.
     */
    function mb_str_pad(string $input, int $length, string $padding = ' ', int $padType = STR_PAD_RIGHT, string $encoding = 'UTF-8'): string
    {
        $result = $input;
        if (($paddingRequired = $length - mb_strlen($input, $encoding)) > 0) {
            switch ($padType) {
                case STR_PAD_LEFT:
                    $result =
                        mb_substr(str_repeat($padding, $paddingRequired), 0, $paddingRequired, $encoding).
                        $input;
                    break;
                case STR_PAD_RIGHT:
                    $result =
                        $input.
                        mb_substr(str_repeat($padding, $paddingRequired), 0, $paddingRequired, $encoding);
                    break;
                case STR_PAD_BOTH:
                    $leftPaddingLength = floor($paddingRequired / 2);
                    $rightPaddingLength = $paddingRequired - $leftPaddingLength;
                    $result =
                        mb_substr(str_repeat($padding, $leftPaddingLength), 0, $leftPaddingLength, $encoding).
                        $input.
                        mb_substr(str_repeat($padding, $rightPaddingLength), 0, $rightPaddingLength, $encoding);
                    break;
            }
        }

        return $result;
    }
}
