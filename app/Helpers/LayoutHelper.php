<?php

/**
 * Define nXm two dimension array
 *
 * @param int $row
 * @param int $column
 * @return array
 */
function defineArray(int $row, int $column): array
{
    $matrix = [];
    for ($rowIndex = 0; $rowIndex < $row; $rowIndex++) {
        $matrix[$rowIndex] = [];
        for ($columnIndex = 0; $columnIndex < $column; $columnIndex++) {
            $matrix[$rowIndex][$columnIndex] = 0;
        }
    }

    return $matrix;
}

/**
 * Fill spiral nXm two dimension empty array
 *
 * @param array $matrix
 * @return array
 */
function fillArray(array $matrix): array
{
    $rows = count($matrix);
    $cols = count($matrix[0]);

    $top = 0;
    $bottom = $rows - 1;
    $left = 0;
    $right = $cols - 1;

    $dir = 1;
    $cursor = 0;
    while ($top <= $bottom && $left <= $right) {
        if ($dir === 1) { // left -> right
            for ($i = $left; $i <= $right; ++$i) {
                $matrix[$top][$i] = $cursor;
                $cursor++;
            }
            ++$top;
            $dir = 2;
        } elseif ($dir === 2) { // top -> bottom
            for ($i = $top; $i <= $bottom; ++$i) {
                $matrix[$i][$right] = $cursor;
                $cursor++;
            }
            --$right;
            $dir = 3;
        } elseif ($dir === 3) { // right -> left
            for ($i = $right; $i >= $left; --$i) {
                $matrix[$bottom][$i] = $cursor;
                $cursor++;
            }
            --$bottom;
            $dir = 4;
        } elseif ($dir === 4) { // bottom -> top
            for ($i = $bottom; $i >= $top; --$i) {
                $matrix[$i][$left] = $cursor;
                $cursor++;
            }
            ++$left;
            $dir = 1;
        }
    }

    return $matrix;
}
