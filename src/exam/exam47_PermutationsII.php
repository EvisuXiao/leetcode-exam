<?php
/**
 * Given a collection of numbers that might contain duplicates, return all possible unique permutations.
 * Input: [1,1,2]
 * Output:
 * [
 *  [1,1,2],
 *  [1,2,1],
 *  [2,1,1]
 * ]
 *
 * Created by PhpStorm.
 * User: Evisu Xiao
 * Date: 2020-09-12
 * Time: 21:30
 */

require_once 'utils.php';
class Solution47_PermutationsII {
    protected $nums = [];
    protected $len = 0;
    protected $exist = [];
    protected $bit = [];
    /**
     * @param Integer[] $nums
     * @return Integer[][]
     */
    function permuteUnique($nums) {
        $this->nums = $nums;
        $this->len = count($this->nums);
        if($this->len < 2) {
            return [$nums];
        }
        $this->combo(0);
        $combo = [];
        foreach($this->exist as $num => $_) {
            $combo[] = explode('#', $num);
        }
        return $combo;
    }

    function combo($k) {
        if($k >= $this->len) {
            return;
        }
        for($i = 0; $i < $this->len; $i++) {
            if(!isset($this->bit[$i])) {
                $this->bit[$i] = true;
                if($k == $this->len - 1) {
                    $num = '';
                    foreach($this->bit as $b => $_) {
                        $num .= "#{$this->nums[$b]}";
                    }
                    $num = substr($num, 1);
                    $this->exist[$num] = true;
                } else {
                    $this->combo($k + 1);
                }
                array_pop($this->bit);
            }
        }
    }
}

function test() {
    $nums = [1,2,3,4,5];
    $solution = new Solution47_PermutationsII();
    print_r($solution->permuteUnique($nums));
}

test();