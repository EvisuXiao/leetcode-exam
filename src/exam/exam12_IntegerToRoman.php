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
 * Given an integer, convert it to a roman numeral. Input is guaranteed to be within the range from 1 to 3999.
 * Example:
 * Input: 1994
 * Output: "MCMXCIV"
 * Explanation: M = 1000, CM = 900, XC = 90 and IV = 4.
 *
 * Created by PhpStorm.
 * User: Evisu Xiao
 * Date: 2020-09-12
 * Time: 21:30
 */

class Solution12_IntegerToRoman {

    /**
     * @param Integer $num
     * @return String
     */
    function intToRoman($num) {
        $symbol = [
            [1000, 'M', 'D'],
            [100, 'C', 'L'],
            [10, 'X', 'V'],
            [1, 'I', '']
        ];
        $roman = '';
        if($num < 1 || $num > 3999) {
            return $roman;
        }
        foreach($symbol as $k => $v) {
            if($num < $v[0]) {
                continue;
            }
            $quotient = intval($num / $v[0]);
            $num %= $v[0];
            if($quotient < 4) {
                $roman .= str_repeat($v[1], $quotient);
            } else {
                if($k == 0) {
                    return '';
                }
                if($quotient == 4) {
                    $roman .= "{$v[1]}{$symbol[$k - 1][2]}";
                } else if($quotient == 5) {
                    $roman .= $symbol[$k - 1][2];
                } else if($quotient == 9) {
                    $roman .= "{$v[1]}{$symbol[$k - 1][1]}";
                } else {
                    $roman .= ($symbol[$k - 1][2] . str_repeat($v[1], $quotient - 5));
                }
            }
        }
        return $roman;
    }
}

function test() {
    $solution = new Solution12_IntegerToRoman();
    echo $solution->intToRoman(3) . PHP_EOL;
    echo $solution->intToRoman(4) . PHP_EOL;
    echo $solution->intToRoman(8) . PHP_EOL;
    echo $solution->intToRoman(9) . PHP_EOL;
    echo $solution->intToRoman(58) . PHP_EOL;
    echo $solution->intToRoman(1994) . PHP_EOL;
}

test();