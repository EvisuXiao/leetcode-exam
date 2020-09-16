<?php
/**
 * Given a non-empty binary tree, return the average value of the nodes on each level in the form of an array.
 * Input:
 *   3
 *  / \
 * 9  20
 *   /  \
 *  15   7
 * Output: [3, 14.5, 11]
 * Explanation:
 * The average value of nodes on level 0 is 3,  on level 1 is 14.5, and on level 2 is 11. Hence return [3, 14.5, 11].
 * Note:
 * The range of node's value is in the range of 32-bit signed integer.
 *
 * Created by PhpStorm.
 * User: Evisu Xiao
 * Date: 2020-09-12
 * Time: 21:30
 */

require_once 'tree_node.php';

class Solution637_AverageOfLevelsInBinaryTree {
    /**
     * @param TreeNode $root
     * @return array
     */
    function averageOfLevels($root) {
        $avgArr = [];
        $this->collectNode($root, 0, $avgArr);
        $result = [];
        foreach($avgArr as $avg) {
            $result[] = array_sum($avg) / count($avg);
        }
        return $result;
    }

    /**
     * @param TreeNode $root
     * @param int      $level
     * @param array    $result
     */
    function collectNode($root, $level, &$result) {
        if(is_null($root)) {
            return;
        }
        if(!isset($result[$level])) {
            $result[$level] = [];
        }
        $result[$level][] = $root->val;
        $this->collectNode($root->left, $level + 1, $result);
        $this->collectNode($root->right, $level + 1, $result);
    }
}

function test() {
    $root = new TreeNode(3);
    $root->left = new TreeNode(9);
    $root->right = new TreeNode(20);
    $root->right->left = new TreeNode(15);
    $root->right->right = new TreeNode(7);
    $solution = new Solution637_AverageOfLevelsInBinaryTree();
    print_r($solution->averageOfLevels($root));
}

test();