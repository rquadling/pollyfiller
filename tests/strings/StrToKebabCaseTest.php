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

class StrToKebabCaseTest extends TestCase
{
    /**
     * @dataProvider providerForKebabCase
     */
    public function testToKebabCase(string $test, string $result)
    {
        $this->assertEquals($result, str_to_kebab_case($test));
    }

    public function providerForKebabCase()
    {
        return [
            ['i', 'i'],
            ['I', 'i'],
            ['iI', 'i-i'],
            ['II', 'i-i'],
            ['ii', 'ii'],
            ['Ii', 'ii'],
            ['iII', 'i-i-i'],
            ['III', 'i-i-i'],
            ['iIi', 'i-ii'],
            ['IIi', 'i-ii'],
            ['iiI', 'ii-i'],
            ['IiI', 'ii-i'],
            ['iii', 'iii'],
            ['Iii', 'iii'],
            ['SomethingWith44Number', 'something-with44-number'],
            ['SomethingWith44number', 'something-with44number'],
            ['SomethingWith4Number', 'something-with4-number'],
            ['SomethingWith4number', 'something-with4number'],
            ['test', 'test'],
            ['Test', 'test'],
            ['testToSnakeCase', 'test-to-snake-case'],
            ['TestToSnakeCase', 'test-to-snake-case'],
            ['testtosnakecasealllowercase', 'testtosnakecasealllowercase'],
            ['TESTTOSNAKECASEALLUPPERCASE', 't-e-s-t-t-o-s-n-a-k-e-c-a-s-e-a-l-l-u-p-p-e-r-c-a-s-e'],
        ];
    }
}
