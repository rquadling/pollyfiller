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

namespace RQuadlingTests\arrays;

use PHPUnit\Framework\TestCase;

class ArrayGetTest extends TestCase
{
    /**
     * @dataProvider providerForArrayGetNonMatching
     *
     * @param array<int, array<string|int, int>> $data
     */
    public function testNull(array $data): void
    {
        foreach ([0, [200, 'Unknown']] as $key) {
            $this->assertNull(array_get($data, $key));
        }
    }

    /**
     * @dataProvider providerForArrayGetNonMatching
     *
     * @param array<int, array<string|int, int>> $data
     */
    public function testTrue(array $data): void
    {
        foreach ([0, [200, 'Unknown']] as $key) {
            $this->assertTrue(array_get($data, $key, true));
        }
    }

    /**
     * @dataProvider providerForArrayGetNonMatching
     *
     * @param array<int, array<string|int, int>> $data
     */
    public function testFalse(array $data): void
    {
        foreach ([0, [200, 'Unknown']] as $key) {
            $this->assertFalse(array_get($data, $key, false));
        }
    }

    /**
     * @return array<string, array<int, array<string|int, int>>>
     */
    public function providerForArrayGetNonMatching(): array
    {
        return [
            'Empty set' => [[]],
            'Data set' => [['first' => 1, 'second' => 2]],
        ];
    }

    /**
     * @param array<string, array<string, array<string, array<string, string>>>> $data
     * @param array<int, string> $keys
     * @param array<string, array<string, array<string, string>|string>|string>|string $expected
     *
     * @dataProvider providerForArrayGetMatching
     */
    public function testResults(array $data, array $keys, $expected): void
    {
        $this->assertEquals($expected, array_get($data, $keys, 'default'));
    }

    /**
     * @return array<int, array<int, array<int|string, array<string, array<string, array<string, string>|string>|string>|string>|string>>
     */
    public function providerForArrayGetMatching(): array
    {
        $data = ['nest' => ['nest' => ['nest' => ['nest' => 'end']]]];

        return [
            [$data, ['nest'], ['nest' => ['nest' => ['nest' => 'end']]]],
            [$data, ['nest', 'nest'], ['nest' => ['nest' => 'end']]],
            [$data, ['nest', 'nest', 'nest'], ['nest' => 'end']],
            [$data, ['nest', 'nest', 'nest', 'nest'], 'end'],
            [$data, ['nest', 'nest', 'nest', 'nest', 'nest'], 'default'],
        ];
    }
}
