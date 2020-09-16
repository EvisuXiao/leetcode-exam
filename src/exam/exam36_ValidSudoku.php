<?php
/**
 * Determine if a 9x9 Sudoku board is valid. Only the filled cells need to be validated according to the following rules:
 * 1: Each row must contain the digits 1-9 without repetition.
 * 2: Each column must contain the digits 1-9 without repetition.
 * 3: Each of the 9 3x3 sub-boxes of the grid must contain the digits 1-9 without repetition.
 * A partially filled sudoku which is valid.
 * The Sudoku board could be partially filled, where empty cells are filled with the character '.'.
 * Input:
 * [
 *   ["8","3",".",".","7",".",".",".","."],
 *   ["6",".",".","1","9","5",".",".","."],
 *   [".","9","8",".",".",".",".","6","."],
 *   ["8",".",".",".","6",".",".",".","3"],
 *   ["4",".",".","8",".","3",".",".","1"],
 *   ["7",".",".",".","2",".",".",".","6"],
 *   [".","6",".",".",".",".","2","8","."],
 *   [".",".",".","4","1","9",".",".","5"],
 *   [".",".",".",".","8",".",".","7","9"]
 * ]
 * Output: false
 * Explanation: Same as Example 1, except with the 5 in the top left corner being
 * modified to 8. Since there are two 8's in the top left 3x3 sub-box, it is invalid.
 * Note:
 * A Sudoku board (partially filled) could be valid but is not necessarily solvable.
 * Only the filled cells need to be validated according to the mentioned rules.
 * The given board contain only digits 1-9 and the character '.'.
 * The given board size is always 9x9.
 *
 * Created by PhpStorm.
 * User: Evisu Xiao
 * Date: 2020-09-12
 * Time: 21:30
 */
require_once 'utils.php';
class Solution36_ValidSudoku {
    /**
     * @param String[][] $board
     * @return Boolean
     */
    function isValidSudoku($board) {
        $row = [];
        $col = [];
        $box = [];
        for($i = 0; $i < 9; $i++) {
            for($j = 0; $j < 9; $j++) {
                $num = $board[$i][$j];
                if($num != '.') {
                    if(!isset($row[$num])) {
                        $row[$num] = [];
                        $col[$num] = [];
                        $box[$num] = [];
                    }
                    if(isset($row[$num][$i]) || isset($col[$num][$j])) {
                        return false;
                    }
                    $box_idx = intval($i / 3) . '-' . intval($j / 3);
                    if(isset($box[$num][$box_idx])) {
                        return false;
                    }
                    $row[$num][$i] = true;
                    $col[$num][$j] = true;
                    $box[$num][$box_idx] = true;
                }
            }
        }
        return true;
    }
}

function test() {
    $solution = new Solution36_ValidSudoku();
    $board1 = [
        ["5","3",".",".","7",".",".",".","."],
        ["6",".",".","1","9","5",".",".","."],
        [".","9","8",".",".",".",".","6","."],
        ["8",".",".",".","6",".",".",".","3"],
        ["4",".",".","8",".","3",".",".","1"],
        ["7",".",".",".","2",".",".",".","6"],
        [".","6",".",".",".",".","2","8","."],
        [".",".",".","4","1","9",".",".","5"],
        [".",".",".",".","8",".",".","7","9"]
    ];
    $board2 = [
        ["8","3",".",".","7",".",".",".","."],
        ["6",".",".","1","9","5",".",".","."],
        [".","9","8",".",".",".",".","6","."],
        ["8",".",".",".","6",".",".",".","3"],
        ["4",".",".","8",".","3",".",".","1"],
        ["7",".",".",".","2",".",".",".","6"],
        [".","6",".",".",".",".","2","8","."],
        [".",".",".","4","1","9",".",".","5"],
        [".",".",".",".","8",".",".","7","9"]
    ];
    var_dump($solution->isValidSudoku($board1));
    var_dump($solution->isValidSudoku($board2));
}

test();