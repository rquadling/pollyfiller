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

class ArrayToTableTest extends TestCase
{
    /**
     * @dataProvider providerForArrayToTable
     *
     * @param array<string|int, array<mixed, mixed>> $set
     * @param string[] $column
     * @param int|array<string, int> $options
     */
    public function testArrayToTable(array $set, array $column, $options): void
    {
        /*
         * Code to generate fixtures.
         */
//        \file_put_contents(
//            \sprintf(
//                __DIR__.'/Fixtures/ArrayToTable/%s.txt',
//                \str_replace(
//                    ['with data set "', '"'],
//                    ['with data set - ', ''],
//                    $this->getDataSetAsString(false)
//                )
//            ),
//            array_to_table($set, $column, $options)
//        );

        $this->assertEquals(
            \file_get_contents(
                \sprintf(
                    __DIR__.'/Fixtures/ArrayToTable/%s.txt',
                    \str_replace(
                        ['with data set "', '"'],
                        ['with data set - ', ''],
                        $this->getDataSetAsString(false)
                    )
                )
            ),
            array_to_table($set, $column, $options)
        );
    }

    /**
     * @return array<string, array<int, array<int|string, array<string, float|int|string|true>|int>|int>>
     */
    public function providerForArrayToTable(): array
    {
        $nullData = [];
        $singleEmptyData = [[]];
        $tenEmptyData = [[], [], [], [], [], [], [], [], [], []];
        $data = [
            100 => [
                'Value' => 1,
                'Position' => 'First',
                'Float' => '1',
                'LongText' => 'First',
            ],
            200 => [
                'Value' => 2,
                'Position' => 'Second',
                'Float' => 6.9569999999999999,
                'LongText' => 'Second Second',
            ],
            300 => [
                'Value' => 3,
                'Position' => 'Third',
                'Float' => '33.299999999999997',
                'LongText' => 'Third Third Third',
            ],
            400 => [
                'Value' => 4,
                'Position' => 'Fourth',
                'Float' => 140.5316,
                'LongText' => 'Fourth Fourth Fourth Fourth',
            ],
            500 => [
                'Value' => 5,
                'Position' => 'Fifth',
                'Float' => '555.54999999999995',
                'LongText' => 'Fifth Fifth Fifth Fifth Fifth',
            ],
            600 => [
                'Value' => 6,
                'Position' => 'Sixth',
                'Float' => '2108.183',
                'LongText' => 'Sixth Sixth Sixth Sixth Sixth Sixth',
            ],
            700 => [
                'Value' => 7,
                'Position' => 'Seventh',
                'Float' => 18921.1289,
                'LongText' => 'Seventh Seventh Seventh Seventh Seventh Seventh Seventh',
            ],
            800 => [
                'Value' => 8,
                'Position' => 'Eighth',
                'Float' => 54356.209999999999,
                'LongText' => 'Eighth Eighth Eighth Eighth Eighth Eighth Eighth Eighth',
            ],
            900 => [
                'Value' => 9,
                'Position' => 'Ninth',
                'Float' => 92112.599400000006,
                'LongText' => 'Ninth Ninth Ninth Ninth Ninth Ninth Ninth Ninth Ninth',
            ],
            1000 => [
                'Value' => 10,
                'Position' => 'Tenth',
                'Float' => 100000.0001,
                'LongText' => 'Tenth Tenth Tenth Tenth Tenth Tenth Tenth Tenth Tenth Tenth',
            ],
        ];

        return [
            '10 empty rows with no columns from set with Counter' => [$tenEmptyData, [['Counter' => true]], 0],
            '10 empty rows with no columns from set with helper lines and Counter' => [$tenEmptyData, [['Counter' => true]], A2T_SHOW_HELPER_LINES],
            '10 empty rows with no columns from set with helper lines and suppress totals and Counter' => [$tenEmptyData, [['Counter' => true]], A2T_SHOW_HELPER_LINES | A2T_SUPPRESS_TOTALS],
            '10 empty rows with no columns from set with helper lines and suppress totals' => [$tenEmptyData, [], A2T_SHOW_HELPER_LINES | A2T_SUPPRESS_TOTALS],
            '10 empty rows with no columns from set with helper lines' => [$tenEmptyData, [], A2T_SHOW_HELPER_LINES],
            '10 empty rows with no columns from set with suppress totals and Counter' => [$tenEmptyData, [['Counter' => true]], A2T_SUPPRESS_TOTALS],
            '10 empty rows with no columns from set with suppress totals' => [$tenEmptyData, [], A2T_SUPPRESS_TOTALS],
            '10 empty rows with no columns from set' => [$tenEmptyData, [], 0],

            'Empty set with no columns from set with Counter' => [$nullData, [['Counter' => true]], 0],
            'Empty set with no columns from set with helper lines and Counter' => [$nullData, [['Counter' => true]], A2T_SHOW_HELPER_LINES],
            'Empty set with no columns from set with helper lines and suppress totals and Counter' => [$nullData, [['Counter' => true]], A2T_SHOW_HELPER_LINES | A2T_SUPPRESS_TOTALS],
            'Empty set with no columns from set with helper lines and suppress totals' => [$nullData, [], A2T_SHOW_HELPER_LINES | A2T_SUPPRESS_TOTALS],
            'Empty set with no columns from set with helper lines' => [$nullData, [], A2T_SHOW_HELPER_LINES],
            'Empty set with no columns from set with suppress totals and Counter' => [$nullData, [['Counter' => true]], A2T_SUPPRESS_TOTALS],
            'Empty set with no columns from set with suppress totals' => [$nullData, [], A2T_SUPPRESS_TOTALS],
            'Empty set with no columns from set' => [$nullData, [], 0],

            'Real data with no columns from set with Counter' => [$data, [['Counter' => true]], 0],
            'Real data with no columns from set with helper lines and Counter' => [$data, [['Counter' => true]], A2T_SHOW_HELPER_LINES],
            'Real data with no columns from set with helper lines and suppress totals and Counter' => [$data, [['Counter' => true]], A2T_SHOW_HELPER_LINES | A2T_SUPPRESS_TOTALS],
            'Real data with no columns from set with helper lines and suppress totals' => [$data, [], A2T_SHOW_HELPER_LINES | A2T_SUPPRESS_TOTALS],
            'Real data with no columns from set with helper lines' => [$data, [], A2T_SHOW_HELPER_LINES],
            'Real data with no columns from set with suppress totals and Counter' => [$data, [['Counter' => true]], A2T_SUPPRESS_TOTALS],
            'Real data with no columns from set with suppress totals' => [$data, [], A2T_SUPPRESS_TOTALS],
            'Real data with no columns from set' => [$data, [], 0],

            'Single empty row with no columns from set with Counter' => [$singleEmptyData, [['Counter' => true]], 0],
            'Single empty row with no columns from set with helper lines and Counter' => [$singleEmptyData, [['Counter' => true]], A2T_SHOW_HELPER_LINES],
            'Single empty row with no columns from set with helper lines and suppress totals and Counter' => [$singleEmptyData, [['Counter' => true]], A2T_SHOW_HELPER_LINES | A2T_SUPPRESS_TOTALS],
            'Single empty row with no columns from set with helper lines and suppress totals' => [$singleEmptyData, [], A2T_SHOW_HELPER_LINES | A2T_SUPPRESS_TOTALS],
            'Single empty row with no columns from set with helper lines' => [$singleEmptyData, [], A2T_SHOW_HELPER_LINES],
            'Single empty row with no columns from set with suppress totals and Counter' => [$singleEmptyData, [['Counter' => true]], A2T_SUPPRESS_TOTALS],
            'Single empty row with no columns from set with suppress totals' => [$singleEmptyData, [], A2T_SUPPRESS_TOTALS],
            'Single empty row with no columns from set' => [$singleEmptyData, [], 0],

            'Real data with Value, Position, and LongText columns with Counter' => [
                $data,
                [
                    ['Counter' => true],
                    'Value' => [],
                    'Position' => [],
                    'LongText' => [],
                ],
                0,
            ],
            'Real data with Value, Position, and LongText columns with helper lines and Counter' => [
                $data,
                [
                    ['Counter' => true],
                    'Value' => [],
                    'Position' => [],
                    'LongText' => [],
                ],
                A2T_SHOW_HELPER_LINES,
            ],
            'Real data with Value, Position, and LongText columns with helper lines and suppress totals and Counter' => [
                $data,
                [
                    ['Counter' => true],
                    'Value' => [],
                    'Position' => [],
                    'LongText' => [],
                ],
                A2T_SHOW_HELPER_LINES | A2T_SUPPRESS_TOTALS,
            ],
            'Real data with Value, Position, and LongText columns with helper lines and suppress totals' => [
                $data,
                [
                    'Value' => [],
                    'Position' => [],
                    'LongText' => [],
                ],
                A2T_SHOW_HELPER_LINES | A2T_SUPPRESS_TOTALS,
            ],
            'Real data with Value, Position, and LongText columns with helper lines' => [
                $data,
                [
                    'Value' => [],
                    'Position' => [],
                    'LongText' => [],
                ],
                A2T_SHOW_HELPER_LINES,
            ],
            'Real data with Value, Position, and LongText columns with suppress totals and Counter' => [
                $data,
                [
                    ['Counter' => true],
                    'Value' => [],
                    'Position' => [],
                    'LongText' => [],
                ],
                A2T_SUPPRESS_TOTALS,
            ],
            'Real data with Value, Position, and LongText columns with suppress totals' => [
                $data,
                [
                    'Value' => [],
                    'Position' => [],
                    'LongText' => [],
                ],
                A2T_SUPPRESS_TOTALS,
            ],
            'Real data with Value, Position, and LongText columns' => [
                $data,
                [
                    'Value' => [],
                    'Position' => [],
                    'LongText' => [],
                ],
                0,
            ],

            'Real data with Value, Position, and LongText columns with Counter and Alignment' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => [],
                ],
                0,
            ],
            'Real data with Value, Position, and LongText columns with helper lines and Counter and Alignment' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => [],
                ],
                A2T_SHOW_HELPER_LINES,
            ],
            'Real data with Value, Position, and LongText columns with helper lines and suppress totals and Counter and Alignment' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => [],
                ],
                A2T_SHOW_HELPER_LINES | A2T_SUPPRESS_TOTALS,
            ],
            'Real data with Value, Position, and LongText columns with suppress totals and Counter and Alignment' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => [],
                ],
                A2T_SUPPRESS_TOTALS,
            ],

            'Real data with Value, Position, and LongText columns with Counter and Alignment and Header position 1' => [
                $data,
                [
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => [],
                ],
                0,
            ],
            'Real data with Value, Position, and LongText columns with helper lines and Counter and Alignment and Header position 1' => [
                $data,
                [
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => [],
                ],
                A2T_SHOW_HELPER_LINES,
            ],
            'Real data with Value, Position, and LongText columns with helper lines and suppress totals and Counter and Alignment and Header position 1' => [
                $data,
                [
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => [],
                ],
                A2T_SHOW_HELPER_LINES | A2T_SUPPRESS_TOTALS,
            ],
            'Real data with Value, Position, and LongText columns with suppress totals and Counter and Alignment and Header position 1' => [
                $data,
                [
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => [],
                ],
                A2T_SUPPRESS_TOTALS,
            ],

            'Real data with Value, Position, and LongText columns with Counter and Alignment and Header position 2' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Value' => ['Align' => STR_PAD_BOTH],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => [],
                ],
                0,
            ],
            'Real data with Value, Position, and LongText columns with helper lines and Counter and Alignment and Header position 2' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Value' => ['Align' => STR_PAD_BOTH],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => [],
                ],
                A2T_SHOW_HELPER_LINES,
            ],
            'Real data with Value, Position, and LongText columns with helper lines and suppress totals and Counter and Alignment and Header position 2' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Value' => ['Align' => STR_PAD_BOTH],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => [],
                ],
                A2T_SHOW_HELPER_LINES | A2T_SUPPRESS_TOTALS,
            ],
            'Real data with Value, Position, and LongText columns with suppress totals and Counter and Alignment and Header position 2' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Value' => ['Align' => STR_PAD_BOTH],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => [],
                ],
                A2T_SUPPRESS_TOTALS,
            ],

            'Real data with Value, Position, and LongText columns with Counter and Alignment and Header position 3' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => [],
                ],
                0,
            ],
            'Real data with Value, Position, and LongText columns with helper lines and Counter and Alignment and Header position 3' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => [],
                ],
                A2T_SHOW_HELPER_LINES,
            ],
            'Real data with Value, Position, and LongText columns with helper lines and suppress totals and Counter and Alignment and Header position 3' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => [],
                ],
                A2T_SHOW_HELPER_LINES | A2T_SUPPRESS_TOTALS,
            ],
            'Real data with Value, Position, and LongText columns with suppress totals and Counter and Alignment and Header position 3' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => [],
                ],
                A2T_SUPPRESS_TOTALS,
            ],

            'Real data with Value, Position, and LongText columns with Counter and Alignment and Header position 3 and Split' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => [],
                ],
                0,
            ],
            'Real data with Value, Position, and LongText columns with helper lines and Counter and Alignment and Header position 3 and Split' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => [],
                ],
                A2T_SHOW_HELPER_LINES,
            ],
            'Real data with Value, Position, and LongText columns with helper lines and suppress totals and Counter and Alignment and Header position 3 and Split' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => [],
                ],
                A2T_SHOW_HELPER_LINES | A2T_SUPPRESS_TOTALS,
            ],
            'Real data with Value, Position, and LongText columns with suppress totals and Counter and Alignment and Header position 3 and Split' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => [],
                ],
                A2T_SUPPRESS_TOTALS,
            ],

            'Real data with Value, Position, and LongText columns with Counter and Alignment and Header position 3 and Split and Wrap' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => ['Width' => 20, 'Wrap' => true],
                ],
                0,
            ],
            'Real data with Value, Position, and LongText columns with Counter and Alignment and Header position 3 and Split and Wrap Left' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => ['Width' => 20, 'Wrap' => true, 'Align' => STR_PAD_LEFT],
                ],
                0,
            ],
            'Real data with Value, Position, and LongText columns with Counter and Alignment and Header position 3 and Split and Wrap Both' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => ['Width' => 20, 'Wrap' => true, 'Align' => STR_PAD_BOTH],
                ],
                0,
            ],
            'Real data with Value, Position, and LongText columns with Counter and Alignment and Header position 3 and Split and Wrap Right' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => ['Width' => 20, 'Wrap' => true, 'Align' => STR_PAD_RIGHT],
                ],
                0,
            ],

            'Real data with Value, Position, and LongText columns with helper lines and Counter and Alignment and Header position 3 and Split and Wrap' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => ['Width' => 20, 'Wrap' => true],
                ],
                A2T_SHOW_HELPER_LINES,
            ],
            'Real data with Value, Position, and LongText columns with helper lines and Counter and Alignment and Header position 3 and Split and Wrap Left' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => ['Width' => 20, 'Wrap' => true, 'Align' => STR_PAD_LEFT],
                ],
                A2T_SHOW_HELPER_LINES,
            ],
            'Real data with Value, Position, and LongText columns with helper lines and Counter and Alignment and Header position 3 and Split and Wrap Both' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => ['Width' => 20, 'Wrap' => true, 'Align' => STR_PAD_BOTH],
                ],
                A2T_SHOW_HELPER_LINES,
            ],
            'Real data with Value, Position, and LongText columns with helper lines and Counter and Alignment and Header position 3 and Split and Wrap Right' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => ['Width' => 20, 'Wrap' => true, 'Align' => STR_PAD_RIGHT],
                ],
                A2T_SHOW_HELPER_LINES,
            ],

            'Real data with Value, Position, and LongText columns with helper lines and suppress totals and Counter and Alignment and Header position 3 and Split and Wrap' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => ['Width' => 20, 'Wrap' => true],
                ],
                A2T_SHOW_HELPER_LINES | A2T_SUPPRESS_TOTALS,
            ],
            'Real data with Value, Position, and LongText columns with helper lines and suppress totals and Counter and Alignment and Header position 3 and Split and Wrap Left' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => ['Width' => 20, 'Wrap' => true, 'Align' => STR_PAD_LEFT],
                ],
                A2T_SHOW_HELPER_LINES | A2T_SUPPRESS_TOTALS,
            ],
            'Real data with Value, Position, and LongText columns with helper lines and suppress totals and Counter and Alignment and Header position 3 and Split and Wrap Both' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => ['Width' => 20, 'Wrap' => true, 'Align' => STR_PAD_BOTH],
                ],
                A2T_SHOW_HELPER_LINES | A2T_SUPPRESS_TOTALS,
            ],
            'Real data with Value, Position, and LongText columns with helper lines and suppress totals and Counter and Alignment and Header position 3 and Split and Wrap Right' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => ['Width' => 20, 'Wrap' => true, 'Align' => STR_PAD_RIGHT],
                ],
                A2T_SHOW_HELPER_LINES | A2T_SUPPRESS_TOTALS,
            ],

            'Real data with Value, Position, and LongText columns with suppress totals and Counter and Alignment and Header position 3 and Split and Wrap' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => ['Width' => 20, 'Wrap' => true],
                ],
                A2T_SUPPRESS_TOTALS,
            ],
            'Real data with Value, Position, and LongText columns with suppress totals and Counter and Alignment and Header position 3 and Split and Wrap Left' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => ['Width' => 20, 'Wrap' => true, 'Align' => STR_PAD_LEFT],
                ],
                A2T_SUPPRESS_TOTALS,
            ],
            'Real data with Value, Position, and LongText columns with suppress totals and Counter and Alignment and Header position 3 and Split and Wrap Both' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => ['Width' => 20, 'Wrap' => true, 'Align' => STR_PAD_BOTH],
                ],
                A2T_SUPPRESS_TOTALS,
            ],
            'Real data with Value, Position, and LongText columns with suppress totals and Counter and Alignment and Header position 3 and Split and Wrap Right' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => ['Width' => 20, 'Wrap' => true, 'Align' => STR_PAD_RIGHT],
                ],
                A2T_SUPPRESS_TOTALS,
            ],

            'Real data with Value, Position, and LongText columns with Counter and Alignment and Header position 3 and Split and Wrap and Total' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH, 'Total' => 0],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => ['Width' => 20, 'Wrap' => true],
                ],
                0,
            ],
            'Real data with Value, Position, and LongText columns with helper lines and Counter and Alignment and Header position 3 and Split and Wrap and Total' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH, 'Total' => 0],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => ['Width' => 20, 'Wrap' => true],
                ],
                A2T_SHOW_HELPER_LINES,
            ],
            'Real data with Value, Position, and LongText columns with helper lines and suppress totals and Counter and Alignment and Header position 3 and Split and Wrap and Total' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH, 'Total' => 0],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => ['Width' => 20, 'Wrap' => true],
                ],
                A2T_SHOW_HELPER_LINES | A2T_SUPPRESS_TOTALS,
            ],
            'Real data with Value, Position, and LongText columns with suppress totals and Counter and Alignment and Header position 3 and Split and Wrap and Total' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH, 'Total' => 0],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => ['Width' => 20, 'Wrap' => true],
                ],
                A2T_SUPPRESS_TOTALS,
            ],

            'Real data with Value, Position, and LongText columns with Counter and Alignment and Header position 3 and Split and Wrap and Total and Percentage' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH, 'Total' => 0, '%age' => true],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => ['Width' => 20, 'Wrap' => true],
                ],
                0,
            ],
            'Real data with Value, Position, and LongText columns with helper lines and Counter and Alignment and Header position 3 and Split and Wrap and Total and Percentage' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH, 'Total' => 0, '%age' => true],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => ['Width' => 20, 'Wrap' => true],
                ],
                A2T_SHOW_HELPER_LINES,
            ],
            'Real data with Value, Position, and LongText columns with helper lines and suppress totals and Counter and Alignment and Header position 3 and Split and Wrap and Total and Percentage' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH, 'Total' => 0, '%age' => true],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => ['Width' => 20, 'Wrap' => true],
                ],
                A2T_SHOW_HELPER_LINES | A2T_SUPPRESS_TOTALS,
            ],
            'Real data with Value, Position, and LongText columns with suppress totals and Counter and Alignment and Header position 3 and Split and Wrap and Total and Percentage' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH, 'Total' => 0, '%age' => true],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => ['Width' => 20, 'Wrap' => true],
                ],
                A2T_SUPPRESS_TOTALS,
            ],

            'Real data with Value, Position, and LongText columns with Counter and Alignment and Header position 3 and Split and Wrap and Total and Percentage and Highlight Value 3' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH, 'Total' => 0, '%age' => true, 'Highlight' => 3],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => ['Width' => 20, 'Wrap' => true],
                ],
                0,
            ],
            'Real data with Value, Position, and LongText columns with helper lines and Counter and Alignment and Header position 3 and Split and Wrap and Total and Percentage and Highlight Value 3' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH, 'Total' => 0, '%age' => true, 'Highlight' => 3],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => ['Width' => 20, 'Wrap' => true],
                ],
                A2T_SHOW_HELPER_LINES,
            ],
            'Real data with Value, Position, and LongText columns with helper lines and suppress totals and Counter and Alignment and Header position 3 and Split and Wrap and Total and Percentage and Highlight Value 3' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH, 'Total' => 0, '%age' => true, 'Highlight' => 3],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => ['Width' => 20, 'Wrap' => true],
                ],
                A2T_SHOW_HELPER_LINES | A2T_SUPPRESS_TOTALS,
            ],
            'Real data with Value, Position, and LongText columns with suppress totals and Counter and Alignment and Header position 3 and Split and Wrap and Total and Percentage and Highlight Value 3' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH, 'Total' => 0, '%age' => true, 'Highlight' => 3],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => ['Width' => 20, 'Wrap' => true],
                ],
                A2T_SUPPRESS_TOTALS,
            ],

            'Real data with Value, Position, LongText, and Float columns with Counter and Alignment and Header position 3 and Split and Wrap and Total and Percentage' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH, 'Total' => 0, '%age' => true],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => ['Width' => 20, 'Wrap' => true],
                    'Float' => ['Title' => 'Decimal', 'Align' => STR_PAD_LEFT, 'Total' => 0, 'DP' => 4, '%age' => true],
                ],
                0,
            ],
            'Real data with Value, Position, LongText, and Float columns with helper lines and Counter and Alignment and Header position 3 and Split and Wrap and Total and Percentage' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH, 'Total' => 0, '%age' => true],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => ['Width' => 20, 'Wrap' => true],
                    'Float' => ['Title' => 'Decimal', 'Align' => STR_PAD_LEFT, 'Total' => 0, 'DP' => 4, '%age' => true],
                ],
                A2T_SHOW_HELPER_LINES,
            ],
            'Real data with Value, Position, LongText, and Float columns with helper lines and suppress totals and Counter and Alignment and Header position 3 and Split and Wrap and Total and Percentage' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH, 'Total' => 0, '%age' => true],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => ['Width' => 20, 'Wrap' => true],
                    'Float' => ['Title' => 'Decimal', 'Align' => STR_PAD_LEFT, 'Total' => 0, 'DP' => 4, '%age' => true],
                ],
                A2T_SHOW_HELPER_LINES | A2T_SUPPRESS_TOTALS,
            ],
            'Real data with Value, Position, LongText, and Float columns with suppress totals and Counter and Alignment and Header position 3 and Split and Wrap and Total and Percentage' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH, 'Total' => 0, '%age' => true],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => ['Width' => 20, 'Wrap' => true],
                    'Float' => ['Title' => 'Decimal', 'Align' => STR_PAD_LEFT, 'Total' => 0, 'DP' => 4, '%age' => true],
                ],
                A2T_SUPPRESS_TOTALS,
            ],

            'Real data with Value, Position, LongText, and Float columns with Counter and Alignment and Header position 3 and Split and Wrap and Total and Percentage and Highlight Value 3' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH, 'Total' => 0, '%age' => true, 'Highlight' => 3],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => ['Width' => 20, 'Wrap' => true],
                    'Float' => ['Title' => 'Decimal', 'Align' => STR_PAD_LEFT, 'Total' => 0, 'DP' => 4, '%age' => true],
                ],
                0,
            ],
            'Real data with Value, Position, LongText, and Float columns with helper lines and Counter and Alignment and Header position 3 and Split and Wrap and Total and Percentage and Highlight Value 3' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH, 'Total' => 0, '%age' => true, 'Highlight' => 3],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => ['Width' => 20, 'Wrap' => true],
                    'Float' => ['Title' => 'Decimal', 'Align' => STR_PAD_LEFT, 'Total' => 0, 'DP' => 4, '%age' => true],
                ],
                A2T_SHOW_HELPER_LINES,
            ],
            'Real data with Value, Position, LongText, and Float columns with helper lines and suppress totals and Counter and Alignment and Header position 3 and Split and Wrap and Total and Percentage and Highlight Value 3' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH, 'Total' => 0, '%age' => true, 'Highlight' => 3],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => ['Width' => 20, 'Wrap' => true],
                    'Float' => ['Title' => 'Decimal', 'Align' => STR_PAD_LEFT, 'Total' => 0, 'DP' => 4, '%age' => true],
                ],
                A2T_SHOW_HELPER_LINES | A2T_SUPPRESS_TOTALS,
            ],
            'Real data with Value, Position, LongText, and Float columns with suppress totals and Counter and Alignment and Header position 3 and Split and Wrap and Total and Percentage and Highlight Value 3' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH, 'Total' => 0, '%age' => true, 'Highlight' => 3],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => ['Width' => 20, 'Wrap' => true],
                    'Float' => ['Title' => 'Decimal', 'Align' => STR_PAD_LEFT, 'Total' => 0, 'DP' => 4, '%age' => true],
                ],
                A2T_SUPPRESS_TOTALS,
            ],

            'Real data with Value, Position, LongText, and Float columns with helper lines and Counter and Alignment and Header position 3 and Split and Wrap and Total and Percentage and Highlight Value 3 options in array' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH, 'Total' => 0, '%age' => true, 'Highlight' => 3],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => ['Width' => 20, 'Wrap' => true],
                    'Float' => ['Title' => 'Decimal', 'Align' => STR_PAD_LEFT, 'Total' => 0, 'DP' => 4, '%age' => true],
                ],
                ['options' => A2T_SHOW_HELPER_LINES],
            ],
            'Real data with Value, Position, LongText, and Float columns with helper lines and Counter and Alignment and Header position 3 and Split and Wrap and Total and Percentage and Highlight Value 3 options in array, 1 helperline' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH, 'Total' => 0, '%age' => true, 'Highlight' => 3],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => ['Width' => 20, 'Wrap' => true],
                    'Float' => ['Title' => 'Decimal', 'Align' => STR_PAD_LEFT, 'Total' => 0, 'DP' => 4, '%age' => true],
                ],
                ['options' => A2T_SHOW_HELPER_LINES, 'helperLines' => 1],
            ],
            'Real data with Value, Position, LongText, and Float columns with helper lines and Counter and Alignment and Header position 3 and Split and Wrap and Total and Percentage and Highlight Value 3 options in array, 2 helperline' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH, 'Total' => 0, '%age' => true, 'Highlight' => 3],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => ['Width' => 20, 'Wrap' => true],
                    'Float' => ['Title' => 'Decimal', 'Align' => STR_PAD_LEFT, 'Total' => 0, 'DP' => 4, '%age' => true],
                ],
                ['options' => A2T_SHOW_HELPER_LINES, 'helperLines' => 2],
            ],
            'Real data with Value, Position, LongText, and Float columns with helper lines and Counter and Alignment and Header position 3 and Split and Wrap and Total and Percentage and Highlight Value 3 options in array, 3 helperline' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH, 'Total' => 0, '%age' => true, 'Highlight' => 3],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => ['Width' => 20, 'Wrap' => true],
                    'Float' => ['Title' => 'Decimal', 'Align' => STR_PAD_LEFT, 'Total' => 0, 'DP' => 4, '%age' => true],
                ],
                ['options' => A2T_SHOW_HELPER_LINES, 'helperLines' => 3],
            ],
            'Real data with Value, Position, LongText, and Float columns with helper lines and Counter and Alignment and Header position 3 and Split and Wrap and Total and Percentage and Highlight Value 3 options in array, 4 helperline' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH, 'Total' => 0, '%age' => true, 'Highlight' => 3],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => ['Width' => 20, 'Wrap' => true],
                    'Float' => ['Title' => 'Decimal', 'Align' => STR_PAD_LEFT, 'Total' => 0, 'DP' => 4, '%age' => true],
                ],
                ['options' => A2T_SHOW_HELPER_LINES, 'helperLines' => 4],
            ],
            'Real data with Value, Position, LongText, and Float columns with helper lines and Counter and Alignment and Header position 3 and Split and Wrap and Total and Percentage and Highlight Value 3 options in array, 5 helperline' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH, 'Total' => 0, '%age' => true, 'Highlight' => 3],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => ['Width' => 20, 'Wrap' => true],
                    'Float' => ['Title' => 'Decimal', 'Align' => STR_PAD_LEFT, 'Total' => 0, 'DP' => 4, '%age' => true],
                ],
                ['options' => A2T_SHOW_HELPER_LINES, 'helperLines' => 5],
            ],
            'Real data with Value, Position, LongText, and Float columns with helper lines and Counter and Alignment and Header position 3 and Split and Wrap and Total and Percentage and Highlight Value 3 options in array, 6 helperline' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH, 'Total' => 0, '%age' => true, 'Highlight' => 3],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => ['Width' => 20, 'Wrap' => true],
                    'Float' => ['Title' => 'Decimal', 'Align' => STR_PAD_LEFT, 'Total' => 0, 'DP' => 4, '%age' => true],
                ],
                ['options' => A2T_SHOW_HELPER_LINES, 'helperLines' => 6],
            ],
            'Real data with Value, Position, LongText, and Float columns with helper lines and Counter and Alignment and Header position 3 and Split and Wrap and Total and Percentage and Highlight Value 3 options in array, 7 helperline' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH, 'Total' => 0, '%age' => true, 'Highlight' => 3],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => ['Width' => 20, 'Wrap' => true],
                    'Float' => ['Title' => 'Decimal', 'Align' => STR_PAD_LEFT, 'Total' => 0, 'DP' => 4, '%age' => true],
                ],
                ['options' => A2T_SHOW_HELPER_LINES, 'helperLines' => 7],
            ],
            'Real data with Value, Position, LongText, and Float columns with helper lines and Counter and Alignment and Header position 3 and Split and Wrap and Total and Percentage and Highlight Value 3 options in array, 8 helperline' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH, 'Total' => 0, '%age' => true, 'Highlight' => 3],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => ['Width' => 20, 'Wrap' => true],
                    'Float' => ['Title' => 'Decimal', 'Align' => STR_PAD_LEFT, 'Total' => 0, 'DP' => 4, '%age' => true],
                ],
                ['options' => A2T_SHOW_HELPER_LINES, 'helperLines' => 8],
            ],
            'Real data with Value, Position, LongText, and Float columns with helper lines and Counter and Alignment and Header position 3 and Split and Wrap and Total and Percentage and Highlight Value 3 options in array, 9 helperline' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH, 'Total' => 0, '%age' => true, 'Highlight' => 3],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => ['Width' => 20, 'Wrap' => true],
                    'Float' => ['Title' => 'Decimal', 'Align' => STR_PAD_LEFT, 'Total' => 0, 'DP' => 4, '%age' => true],
                ],
                ['options' => A2T_SHOW_HELPER_LINES, 'helperLines' => 9],
            ],
            'Real data with Value, Position, LongText, and Float columns with helper lines and Counter and Alignment and Header position 3 and Split and Wrap and Total and Percentage and Highlight Value 8 options in array, 10 helperline' => [
                $data,
                [
                    ['Counter' => true, 'Align' => STR_PAD_LEFT],
                    'Value' => ['Align' => STR_PAD_BOTH, 'Total' => 0, '%age' => true, 'Highlight' => 3],
                    ['Split' => '| '],
                    ['Header' => 'An Extra Heading', 'Columns' => 2],
                    'Position' => ['Align' => STR_PAD_RIGHT],
                    'LongText' => ['Width' => 20, 'Wrap' => true],
                    'Float' => ['Title' => 'Decimal', 'Align' => STR_PAD_LEFT, 'Total' => 0, 'DP' => 4, '%age' => true],
                ],
                ['options' => A2T_SHOW_HELPER_LINES, 'helperLines' => 10],
            ],
        ];
    }
}
