<?php
/**
 * Given a set of distinct integers, nums, return all possible subsets (the power set).
 * Note: The solution set must not contain duplicate subsets.
 * Example:
 * Input: nums = [1,2,3]
 * Output:
 * [
 *   [3],
 *   [1],
 *   [2],
 *   [1,2,3],
 *   [1,3],
 *   [2,3],
 *   [1,2],
 *   []
 * ]
 *
 * Created by PhpStorm.
 * User: Evisu Xiao
 * Date: 2020-09-12
 * Time: 21:30
 */

require_once 'utils.php';
class Solution78_Subsets {
    /**
     * @param Integer[] $nums
     * @return Integer[][]
     */
    function subsets($nums) {
        $sets = [[]];
        for($i = 0; $i < count($nums); $i++) {
            foreach($sets as $set) {
                $set[] = $nums[$i];
                $sets[] = $set;
            }
        }
        return $sets;
    }
}

function test() {
    $nums = [1,2,3,4,5];
    $solution = new Solution78_Subsets();
    print_r($solution->subsets($nums));
}

test();