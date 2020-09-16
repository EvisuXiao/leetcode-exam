<?php
/**
 * Roman numerals are represented by seven different symbols: I, V, X, L, C, D and M.
 * Symbol  Value
 * I        1
 * V        5
 * X        10
 * L        50
 * C        100
 * D        500
 * M        1000
 * For example, two is written as II in Roman numeral, just two one's added together. Twelve is written as, XII, which is simply X + II. The number twenty seven is written as XXVII, which is XX + V + II.
 * Roman numerals are usually written largest to smallest from left to right. However, the numeral for four is not IIII. Instead, the number four is written as IV. Because the one is before the five we subtract it making four. The same principle applies to the number nine, which is written as IX. There are six instances where subtraction is used:
 * I can be placed before V (5) and X (10) to make 4 and 9. 
 * X can be placed before L (50) and C (100) to make 40 and 90. 
 * C can be placed before D (500) and M (1000) to make 400 and 900.
 * Given a roman numeral, convert it to an integer. Input is guaranteed to be within the range from 1 to 3999.
 * Example:
 * Input: "MCMXCIV"
 * Output: 1994
 * Explanation: M = 1000, CM = 900, XC = 90 and IV = 4.
 *
 * Created by PhpStorm.
 * User: Evisu Xiao
 * Date: 2020-09-12
 * Time: 21:30
 */

class Solution13_RomanToInteger {
    /**
     * @param String $s
     * @return Integer
     */
    function romanToInt($s) {
        $num = 0;
        $symbol = [
            'I' => 1,
            'V' => 5,
            'X' => 10,
            'L' => 50,
            'C' => 100,
            'D' => 500,
            'M' => 1000
        ];
        $s = str_split($s);
        $len = count($s);
        for($i = 0; $i < $len; $i++) {
            if(!isset($symbol[$s[$i]])) {
                return 0;
            }
            if($i < $len - 1) {
                if(!isset($symbol[$s[$i + 1]])) {
                    return 0;
                }
                if($symbol[$s[$i]] < $symbol[$s[$i + 1]]) {
                    $num -= $symbol[$s[$i]];
                } else {
                    $num += $symbol[$s[$i]];
                }
            } else {
                $num += $symbol[$s[$i]];
            }
        }
        return $num;
    }
}

function test() {
    $solution = new Solution13_RomanToInteger();
    echo $solution->romanToInt('III') . PHP_EOL;
    echo $solution->romanToInt('IV') . PHP_EOL;
    echo $solution->romanToInt('IX') . PHP_EOL;
    echo $solution->romanToInt('LVIII') . PHP_EOL;
    echo $solution->romanToInt('MCMXCIV') . PHP_EOL;
}

test();