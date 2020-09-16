<?php
/**
 * Given a 2D board and a word, find if the word exists in the grid.
 * The word can be constructed from letters of sequentially adjacent cell, where "adjacent" cells are those horizontally or vertically neighboring. The same letter cell may not be used more than once.
 * board =
 * [
 *  ['A','B','C','E'],
 *  ['S','F','C','S'],
 *  ['A','D','E','E']
 * ]
 * Given word = "ABCCED", return true.
 * Given word = "SEE", return true.
 * Given word = "ABCB", return false.
 *
 * Created by PhpStorm.
 * User: Evisu Xiao
 * Date: 2020-09-12
 * Time: 21:30
 */
class Solution79_WordSearch {
    /**
     * @param String[][] $board
     * @param String $word
     * @return Boolean
     */
    function exist($board, $word) {
        $exist = false;
        if(empty($board) || empty($word)) {
            return $exist;
        }
        $word = str_split($word);
        $pos = [];
        for($i = 0;$i < count($board); $i++) {
            if($exist) {
                break;
            }
            for($j = 0;$j < count($board[$i]); $j++) {
                if($word[0] == $board[$i][$j]) {
                    $pos["{$i}#{$j}"] = true;
                    if($this->search($word, 1, $board, $i, $j, $pos)) {
                        $exist = true;
                        break;
                    }
                }
            }
        }
        return $exist;
    }

    function search($word, $c, $board, $i, $j, &$pos) {
        if($c == 0) {
            return false;
        }
        if($c == count($word)) {
            return true;
        }
        if($this->_search($word, $c, $board, $i, $j + 1, $pos) ||
            $this->_search($word, $c, $board, $i + 1, $j, $pos) ||
            $this->_search($word, $c, $board, $i, $j - 1, $pos) ||
            $this->_search($word, $c, $board, $i - 1, $j, $pos)
        ) {
            return true;
        }
        array_pop($pos);
        return false;
    }

    function _search($word, $c, $board, $i, $j, &$pos) {
        if(!isset($board[$i][$j]) || isset($pos["{$i}#{$j}"]) || $word[$c] != $board[$i][$j]) {
            return false;
        }
        $pos["{$i}#{$j}"] = true;
        return $this->search($word, $c + 1, $board, $i, $j, $pos);
    }
}

function test() {
    $board = [
        ['A','B','C','E'],
        ['S','F','C','S'],
        ['A','D','E','E']
    ];
    $solution = new Solution79_WordSearch();
    var_dump($solution->exist($board, 'ABCCED'));
    var_dump($solution->exist($board, 'SEE'));
    var_dump($solution->exist($board, 'ABCB'));
    var_dump($solution->exist($board, 'BCCFB'));
    $board2 = [
        ["C","A","A"],
        ["A","A","A"],
        ["B","C","D"]
    ];
    var_dump($solution->exist($board2, 'AAB'));
    $board3 = [
        ["F","Y","C","E","N","R","D"],
        ["K","L","N","F","I","N","U"],
        ["A","A","A","R","A","H","R"],
        ["N","D","K","L","P","N","E"],
        ["A","L","A","N","S","A","P"],
        ["O","O","G","O","T","P","N"],
        ["H","P","O","L","A","N","O"]
    ];
    var_dump($solution->exist($board3, 'POLAND'));
}

test();