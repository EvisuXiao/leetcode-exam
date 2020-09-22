<?php
/**
 * Write a program to solve a Sudoku puzzle by filling the empty cells.
 * A sudoku solution must satisfy all of the following rules:
 * 1: Each of the digits 1-9 must occur exactly once in each row.
 * 2: Each of the digits 1-9 must occur exactly once in each column.
 * 3: Each of the the digits 1-9 must occur exactly once in each of the 9 3x3 sub-boxes of the grid.
 * Empty cells are indicated by the character '.'.
 * Note:
 * 1: The given board contain only digits 1-9 and the character '.'.
 * 2: You may assume that the given Sudoku puzzle will have a single unique solution.
 * 3: The given board size is always 9x9.
 *
 * Created by PhpStorm.
 * User: Evisu Xiao
 * Date: 2020-09-12
 * Time: 21:30
 */
require_once 'utils.php';
class Solution37_SudokuSolver {
    /**
     * @param String[][] $board
     * @return NULL
     */
    function solveSudoku(&$board) {
        $row = $col = $box = $empty = [];
        for($i = 0;$i < 9; $i++) {
            for($j = 0; $j < 9; $j++) {
                $num = $board[$i][$j];
                if($num == '.') {
                    $empty[] = [$i, $j];
                    continue;
                }
                if(!isset($row[$num])) {
                    $row[$num] = [];
                    $col[$num] = [];
                    $box[$num] = [];
                }
                if(!$this->_isValid($num, $i, $j, $row, $col, $box)) {
                    return null;
                }
                $row[$num][$i] = true;
                $col[$num][$j] = true;
                $box[$num][$this->locationIdx(intval($i / 3), intval($j / 3))] = true;
            }
        }
        $this->_resolver($board, $empty, 0, $row, $col, $box);
        return null;
    }

    function _resolver(&$board, $empty, $k, $row, $col, $box) {
        if($k == count($empty)) {
            return true;
        }
        $dot = $empty[$k];
        for($num = 1; $num <= 9; $num++) {
            if($this->_isValid($num, $dot[0], $dot[1], $row, $col, $box)) {
                $board[$dot[0]][$dot[1]] = strval($num);
                $newRow = $row;
                $newCol = $col;
                $newBox = $box;
                $newRow[$num][$dot[0]] = true;
                $newCol[$num][$dot[1]] = true;
                $newBox[$num][$this->locationIdx(intval($dot[0] / 3), intval($dot[1] / 3))] = true;
                if($this->_resolver($board, $empty, $k + 1, $newRow, $newCol, $newBox)) {
                    return true;
                }
            }
        }
        return false;
    }

    function _isValid($num, $i, $j, $row, $col, $box) {
        if(isset($row[$num][$i]) || isset($col[$num][$j])) {
            return false;
        }
        $box_idx = $this->locationIdx(intval($i / 3), intval($j / 3));
        return !isset($box[$num][$box_idx]);
    }

    function locationIdx($i, $j) {
        return $i * 10 + $j;
    }

    function string($board) {
        foreach($board as $row) {
            echo implode('', $row) . PHP_EOL;
        }
    }
}

function test() {
    $solution = new Solution37_SudokuSolver();
    $board = [
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
    $solution->solveSudoku($board);
    $solution->string($board);
    $board1 = [
        ['.','.','.','.','3','1','.','.','2'],
        ['.','.','3','4','.','.','.','8','9'],
        ['7','2','.','.','.','8','4','.','1'],
        ['.','.','.','.','.','5','.','2','.'],
        ['.','.','.','9','7','.','1','.','.'],
        ['.','.','.','.','1','4','.','9','.'],
        ['.','.','.','.','.','.','.','.','8'],
        ['1','.','.','.','4','.','5','.','.'],
        ['.','.','.','7','.','2','.','.','.']
    ];
    $solution->solveSudoku($board1);
    $solution->string($board1);
}

test();