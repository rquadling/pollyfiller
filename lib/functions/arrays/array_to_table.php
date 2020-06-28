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

if (!function_exists('array_to_table')) {
    // This bitmask option will show helper lines after every 5 lines in the output of the arrayToTable function.
    define('A2T_SHOW_HELPER_LINES', 1);

    // This bitmask option will suppress the totals element of the arrayToTable output.
    define('A2T_SUPPRESS_TOTALS', 2);

    // This bitmask option will suppress the zeros from the arrayToTable output.
    define('A2T_SUPPRESS_ZEROS', 4);

    /**
     * Convert an array that fits a database result set into a plain text table.
     *
     * @param array<string|int, array<mixed, mixed>> $data the data with the keys being used as the first column
     * @param array<string|int, string|int> $columnInfo the column information
     * @param int|array<string, int> $options if an int, then this becomes the 'options' value. {options:int,helperLines:int}
     *
     * @return string the plain text table
     */
    function array_to_table(array $data, array $columnInfo, $options = null): string
    {
        $options = array_merge(
            ['options' => 0, 'helperLines' => 5],
            is_array($options) ? $options
                : (is_int($options) ? ['options' => $options] : [])
        );
        $requireGroupHeaders = false;

        //  Determine the width for the title for each column, taking into account any presupplied widths.
        foreach ($columnInfo as $columnInfoColumn => $columnInfoData) {
            if (!is_numeric($columnInfoColumn)) {
                $columnInfo[$columnInfoColumn]['Width'] = max(
                    array_get($columnInfo[$columnInfoColumn], 'Width', 0),
                    mb_strlen(array_get($columnInfo[$columnInfoColumn], 'Title', $columnInfoColumn))
                );
            } elseif (isset($columnInfoData['Counter'])) {
                $columnInfo[$columnInfoColumn]['Width'] = mb_strlen(number_format(count($data)));
            } elseif (isset($columnInfoData['Header'])) {
                $requireGroupHeaders = true;
                $columnInfo[$columnInfoColumn]['Width'] = $columnInfo[$columnInfoColumn]['Columns'] - 1;
                $columnInfo[$columnInfoColumn]['WorkingColumns'] = $columnInfo[$columnInfoColumn]['Columns'];
            }
        }

        //  Determine the maximum width of each column, taking into account the column heading, the data and any formatting for the column.
        foreach ($data as $key => $row) {
            $row['Title'] = $key;
            $data[$key]['Title'] = $row['Title'];
            foreach ($row as $columnInfoColumn => $value) {
                //  Only process the width of real columns.
                if (!is_numeric($columnInfoColumn) && (bool)array_get($columnInfo, $columnInfoColumn, false)) {
                    //  Calculate the current total if needed.
                    if (false !== array_get($columnInfo[$columnInfoColumn], 'Total', false)) {
                        $columnInfo[$columnInfoColumn]['Total'] = array_get(
                                $columnInfo[$columnInfoColumn],
                                'Total',
                                0
                            ) + $value;
                    }

                    //  Determine the width, based up the length of the title, the formatted value, if we are wrapping, the total (if to be used) and if it is a %age.
                    $columnInfo[$columnInfoColumn]['Width'] = max(
                        $columnInfo[$columnInfoColumn]['Width'],
                        array_get($columnInfo[$columnInfoColumn], 'Wrap', false)
                            ? 0
                            : mb_strlen(
                                !is_numeric(trim($value)) ? $value : number_format(
                                    array_get($columnInfo[$columnInfoColumn], 'Total', $value),
                                    array_get($columnInfo[$columnInfoColumn], 'DP', 0)
                                )
                            ) + ((bool)array_get($columnInfo[$columnInfoColumn], '%age', false) ? 10 : 0)
                    );
                }
            }
        }

        //  If we are using additional column group headings, then determine their widths.
        if ($requireGroupHeaders) {
            $counting = false;
            $countingForColumn = 0;
            foreach ($columnInfo as $columnInfoColumn => $columnInfoData) {
                if ($counting && (0 !== $columnInfo[$countingForColumn]['WorkingColumns'])) {
                    $columnInfo[$countingForColumn]['Width'] += $columnInfoData['Width'];
                    --$columnInfo[$countingForColumn]['WorkingColumns'];
                } elseif (isset($columnInfoData['Header'])) {
                    $counting = true;
                    $countingForColumn = $columnInfoColumn;
                }
            }
        }

        //  The table in lines.
        $tableBody = '';
        $tableFooter = '';
        $tableHeaderDetail = '';
        $tableHeaderGroup = '';
        $tableUnderline = '';

        $counting = false;
        $countingForColumn = 0;
        foreach ($columnInfo as $columnInfoColumn => $columnInfoData) {
            if (!is_numeric($columnInfoColumn)) {
                $tableUnderline .= mb_str_pad('=', $columnInfoData['Width'], '=').' ';

                if (isset($columnInfoData['Total'])) {
                    $tableHeaderDetail .= mb_str_pad(
                        $columnInfoData['Title'] ?? $columnInfoColumn,
                        $columnInfoData['Width'],
                        ' ',
                        STR_PAD_LEFT
                    );

                    $tableFooter .=
                        mb_str_pad(
                            number_format($columnInfoData['Total'], array_get($columnInfoData, 'DP', 0)),
                            $columnInfoData['Width'] - ((bool)array_get($columnInfoData, '%age', false) ? 10 : 0),
                            ' ',
                            STR_PAD_LEFT
                        ).((bool)array_get($columnInfoData, '%age', false) ? ' (100.00%)' : '');
                } else {
                    $tableHeaderDetail .= mb_str_pad(
                        $columnInfoData['Title'] ?? $columnInfoColumn,
                        $columnInfoData['Width'],
                        ' ',
                        array_get($columnInfoData, 'Align', STR_PAD_RIGHT)
                    );
                    $tableFooter .= mb_str_pad(' ', $columnInfoData['Width']);
                }
                if (!($counting && (0 !== $columnInfo[$countingForColumn]['Columns']--))) {
                    $tableHeaderGroup .= mb_str_pad(' ', $columnInfoData['Width']).' ';
                    $counting = false;
                }
                $tableHeaderDetail .= ' ';
                $tableFooter .= ' ';
            } elseif (isset($columnInfoData['Counter'])) {
                $tableHeaderGroup .= mb_str_pad(' ', $columnInfoData['Width']).' ';
                $tableHeaderDetail .= mb_str_pad('#', $columnInfoData['Width'], ' ', STR_PAD_LEFT).' ';
                $tableUnderline .= mb_str_pad('=', $columnInfoData['Width'], '=').' ';
                $tableFooter .= mb_str_pad(' ', $columnInfoData['Width']).' ';
            } else {
                if (isset($columnInfoData['Header'])) {
                    $tableHeaderGroup .= mb_str_pad(
                            " {$columnInfoData['Header']} ",
                            $columnInfoData['Width'],
                            '-',
                            STR_PAD_BOTH
                        ).' ';
                    $counting = true;
                    $countingForColumn = $columnInfoColumn;
                }
                $tableHeaderGroup .= array_get($columnInfoData, 'Split', '');
                $tableHeaderDetail .= array_get($columnInfoData, 'Split', '');
                $tableUnderline .= array_get($columnInfoData, 'Split', '');
                $tableFooter .= array_get($columnInfoData, 'Split', '');
            }
        }

        $tableFooter = rtrim($tableFooter).PHP_EOL;
        $tableHeaderDetail = rtrim($tableHeaderDetail).PHP_EOL;
        $tableHeaderGroup = rtrim($tableHeaderGroup).PHP_EOL;
        $tableUnderline = rtrim($tableUnderline).PHP_EOL;

        $bodyCount = 0;
        $lineCount = 0;
        foreach ($data as $key => &$row) {
            if (($options['options'] & A2T_SHOW_HELPER_LINES)) {
                if (($bodyCount > 0) && (0 == $bodyCount % $options['helperLines'])) {
                    $tableBody .= str_replace('=', '-', $tableUnderline);
                }
            }
            ++$bodyCount;
            ++$lineCount;
            $wrappedColumns = [];
            foreach ($columnInfo as $columnInfoColumn => $columnInfoData) {
                if (!is_numeric($columnInfoColumn)) {
                    if (isset($columnInfoData['Total'])) {
                        $tableBody .=
                            (((bool)array_get(
                                    $columnInfoData,
                                    'Highlight',
                                    false
                                ) && $row[$columnInfoColumn] === $columnInfoData['Highlight']) ? chr(27).'[1;32m' : '').
                            mb_str_pad(
                                !is_numeric(trim($row[$columnInfoColumn])) ? $row[$columnInfoColumn] : ((is_null(
                                    $row[$columnInfoColumn]
                                ) || (0 == $row[$columnInfoColumn] && $options['options'] & A2T_SUPPRESS_ZEROS)
                                    ? ' ' : number_format(
                                        $row[$columnInfoColumn],
                                        array_get($columnInfoData, 'DP', 0)
                                    ))),
                                $columnInfoData['Width'] -
                                ((bool)array_get($columnInfoData, '%age', false) ? 10 : 0),
                                ' ',
                                array_get($columnInfoData, 'Align', STR_PAD_LEFT)
                            ).
                            (
                            (bool)array_get($columnInfoData, '%age', false)
                                ? ' ('.mb_str_pad(
                                    number_format((100 * $row[$columnInfoColumn]) / $columnInfoData['Total'], 2),
                                    6,
                                    ' ',
                                    STR_PAD_LEFT
                                ).'%)'
                                : ''
                            ).
                            (((bool)array_get($columnInfoData, 'Highlight', false)
                                && $row[$columnInfoColumn] === $columnInfoData['Highlight'])
                                ? chr(27).'[0;37m'
                                : ''
                            );
                    } else {
                        if (array_get($columnInfoData, 'Wrap', false)) {
                            $wrappedColumns[$columnInfoColumn] = explode(PHP_EOL, wordwrap($row[$columnInfoColumn], $columnInfoData['Width'], PHP_EOL));
                            $row[$columnInfoColumn] = array_shift($wrappedColumns[$columnInfoColumn]);
                            if (empty($wrappedColumns[$columnInfoColumn])) {
                                unset($wrappedColumns[$columnInfoColumn]);
                            }
                        }
                        $tableBody .= mb_str_pad(
                            $row[$columnInfoColumn],
                            $columnInfoData['Width'],
                            array_get($columnInfoData, 'Pad', ' '),
                            array_get($columnInfoData, 'Align', STR_PAD_RIGHT)
                        );
                    }
                    $tableBody .= ' ';
                } elseif (isset($columnInfoData['Counter'])) {
                    $tableBody .= mb_str_pad(
                            number_format($lineCount),
                            $columnInfoData['Width'],
                            ' ',
                            STR_PAD_LEFT
                        ).' ';
                } else {
                    $tableBody .= array_get($columnInfoData, 'Split', '');
                }
            }
            $tableBody = rtrim($tableBody).PHP_EOL;
            while (!empty($wrappedColumns)) {
                if (($options['options'] & A2T_SHOW_HELPER_LINES)) {
                    if (($bodyCount > 0) && (0 == $bodyCount % $options['helperLines'])) {
                        $tableBody .= str_replace('=', '-', $tableUnderline);
                    }
                }
                ++$bodyCount;
                foreach ($columnInfo as $columnInfoColumn => $columnInfoData) {
                    if (!is_numeric($columnInfoColumn)) {
                        $tableBody .= mb_str_pad(
                                (isset($wrappedColumns[$columnInfoColumn]) ? array_shift($wrappedColumns[$columnInfoColumn]) : ''),
                                $columnInfoData['Width'],
                                ' ',
                                array_get($columnInfoData, 'Align', STR_PAD_RIGHT)
                            ).' ';
                        if (empty($wrappedColumns[$columnInfoColumn])) {
                            unset($wrappedColumns[$columnInfoColumn]);
                        }
                    } elseif (isset($columnInfoData['Counter'])) {
                        $tableBody .= mb_str_pad(
                                ' ',
                                $columnInfoData['Width'],
                                ' ',
                                STR_PAD_LEFT
                            ).' ';
                    } else {
                        $tableBody .= array_get($columnInfoData, 'Split', '');
                    }
                }
                $tableBody = rtrim($tableBody).PHP_EOL;
            }
        }

        return $tableHeaderGroup.$tableHeaderDetail.$tableUnderline.$tableBody.($options['options'] & A2T_SUPPRESS_TOTALS ? '' : $tableUnderline.$tableFooter);
    }
}
