<?php
/**
 * Given an array of integers nums and an integer target, return indices of the two numbers such that they add up to target.
 * You may assume that each input would have exactly one solution, and you may not use the same element twice.
 * You can return the answer in any order.
 * Input: nums = [2,7,11,15], target = 9
 * Output: [0,1]
 * Output: Because nums[0] + nums[1] == 9, we return [0, 1].
 *
 * Created by PhpStorm.
 * User: Evisu Xiao
 * Date: 2020-09-12
 * Time: 21:30
 */
class Solution1_TwoSum {
    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer[]
     */
    function twoSum($nums, $target) {
        $map1 = $map2 = [];
        $len = count($nums);
        for($i = 0; $i < $len; $i++) {
            $v = $nums[$i];
            if(isset($map1[$v])) {
                $map2[$v] = $i;
            } else {
                $map1[$v] = $i;
            }
        }
        for($i = 0; $i < $len; $i++) {
            $v = $nums[$i];
            $rest = $target - $v;
            if(isset($map1[$rest])) {
                if($v != $rest) {
                    return [$i, $map1[$rest]];
                }
                if(isset($map2[$rest])) {
                    return [$i, $map2[$rest]];
                }
            }
        }
        return [];
    }
}

function test() {
    $solution = new Solution1_TwoSum();
    print_r($solution->twoSum([2, 7, 11, 15], 9));
    print_r($solution->twoSum([3, 2, 4], 6));
    print_r($solution->twoSum([3, 3], 6));
}

test();