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

namespace RQuadlingTests\strings;

use PHPUnit\Framework\TestCase;

class MbStrPadTest extends TestCase
{
    /**
     * @dataProvider provideDataForMbStrPad
     */
    public function testMbStrPad(string $input, int $length, string $padding, int $padType, string $result)
    {
        $this->assertEquals($result, mb_str_pad($input, $length, $padding, $padType));
    }

    public function provideDataForMbStrPad()
    {
        return [
            ['Nhiều byte string đệm', 0, ' ', STR_PAD_BOTH, 'Nhiều byte string đệm'],
            ['Nhiều byte string đệm', 0, ' ', STR_PAD_LEFT, 'Nhiều byte string đệm'],
            ['Nhiều byte string đệm', 0, ' ', STR_PAD_RIGHT, 'Nhiều byte string đệm'],
            ['Nhiều byte string đệm', 0, '充', STR_PAD_BOTH, 'Nhiều byte string đệm'],
            ['Nhiều byte string đệm', 0, '充', STR_PAD_LEFT, 'Nhiều byte string đệm'],
            ['Nhiều byte string đệm', 0, '充', STR_PAD_RIGHT, 'Nhiều byte string đệm'],
            ['Nhiều byte string đệm', 0, '煻充', STR_PAD_BOTH, 'Nhiều byte string đệm'],
            ['Nhiều byte string đệm', 20, ' ', STR_PAD_BOTH, 'Nhiều byte string đệm'],
            ['Nhiều byte string đệm', 20, ' ', STR_PAD_LEFT, 'Nhiều byte string đệm'],
            ['Nhiều byte string đệm', 20, ' ', STR_PAD_RIGHT, 'Nhiều byte string đệm'],
            ['Nhiều byte string đệm', 20, '充', STR_PAD_BOTH, 'Nhiều byte string đệm'],
            ['Nhiều byte string đệm', 20, '充', STR_PAD_LEFT, 'Nhiều byte string đệm'],
            ['Nhiều byte string đệm', 20, '充', STR_PAD_RIGHT, 'Nhiều byte string đệm'],
            ['Nhiều byte string đệm', 20, '煻充', STR_PAD_BOTH, 'Nhiều byte string đệm'],
            ['Nhiều byte string đệm', 21, ' ', STR_PAD_BOTH, 'Nhiều byte string đệm'],
            ['Nhiều byte string đệm', 21, ' ', STR_PAD_LEFT, 'Nhiều byte string đệm'],
            ['Nhiều byte string đệm', 21, ' ', STR_PAD_RIGHT, 'Nhiều byte string đệm'],
            ['Nhiều byte string đệm', 21, '充', STR_PAD_BOTH, 'Nhiều byte string đệm'],
            ['Nhiều byte string đệm', 21, '充', STR_PAD_LEFT, 'Nhiều byte string đệm'],
            ['Nhiều byte string đệm', 21, '充', STR_PAD_RIGHT, 'Nhiều byte string đệm'],
            ['Nhiều byte string đệm', 21, '煻充', STR_PAD_BOTH, 'Nhiều byte string đệm'],
            ['Nhiều byte string đệm', 22, ' ', STR_PAD_BOTH, 'Nhiều byte string đệm '],
            ['Nhiều byte string đệm', 22, ' ', STR_PAD_LEFT, ' Nhiều byte string đệm'],
            ['Nhiều byte string đệm', 22, ' ', STR_PAD_RIGHT, 'Nhiều byte string đệm '],
            ['Nhiều byte string đệm', 22, '充', STR_PAD_BOTH, 'Nhiều byte string đệm充'],
            ['Nhiều byte string đệm', 22, '充', STR_PAD_LEFT, '充Nhiều byte string đệm'],
            ['Nhiều byte string đệm', 22, '充', STR_PAD_RIGHT, 'Nhiều byte string đệm充'],
            ['Nhiều byte string đệm', 22, '煻充', STR_PAD_BOTH, 'Nhiều byte string đệm煻'],
            ['Nhiều byte string đệm', 23, ' ', STR_PAD_BOTH, ' Nhiều byte string đệm '],
            ['Nhiều byte string đệm', 23, ' ', STR_PAD_LEFT, '  Nhiều byte string đệm'],
            ['Nhiều byte string đệm', 23, ' ', STR_PAD_RIGHT, 'Nhiều byte string đệm  '],
            ['Nhiều byte string đệm', 23, '充', STR_PAD_BOTH, '充Nhiều byte string đệm充'],
            ['Nhiều byte string đệm', 23, '充', STR_PAD_LEFT, '充充Nhiều byte string đệm'],
            ['Nhiều byte string đệm', 23, '充', STR_PAD_RIGHT, 'Nhiều byte string đệm充充'],
            ['Nhiều byte string đệm', 23, '煻充', STR_PAD_BOTH, '煻Nhiều byte string đệm煻'],
            ['Nhiều byte string đệm', 24, ' ', STR_PAD_BOTH, ' Nhiều byte string đệm  '],
            ['Nhiều byte string đệm', 24, ' ', STR_PAD_LEFT, '   Nhiều byte string đệm'],
            ['Nhiều byte string đệm', 24, ' ', STR_PAD_RIGHT, 'Nhiều byte string đệm   '],
            ['Nhiều byte string đệm', 24, '充', STR_PAD_BOTH, '充Nhiều byte string đệm充充'],
            ['Nhiều byte string đệm', 24, '充', STR_PAD_LEFT, '充充充Nhiều byte string đệm'],
            ['Nhiều byte string đệm', 24, '充', STR_PAD_RIGHT, 'Nhiều byte string đệm充充充'],
            ['Nhiều byte string đệm', 24, '煻充', STR_PAD_BOTH, '煻Nhiều byte string đệm煻充'],
            ['Nhiều byte string đệm', 25, '煻充', STR_PAD_BOTH, '煻充Nhiều byte string đệm煻充'],
            ['Nhiều byte string đệm', 26, '煻充', STR_PAD_BOTH, '煻充Nhiều byte string đệm煻充煻'],
        ];
    }
}
