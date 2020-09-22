<?php
/**
 * Find the sum of all left leaves in a given binary tree.
 * Example:
 *      3
 *     / \
 *    9  20
 *      /  \
 *     15   7
 * There are two left leaves in the binary tree, with values 9 and 15 respectively. Return 24.
 *
 * Created by PhpStorm.
 * User: Evisu Xiao
 * Date: 2020-09-12
 * Time: 21:30
 */

require_once 'tree_node.php';

class Solution404_SumOfLeftLeaves {
    /**
     * @param TreeNode $root
     * @return Integer
     */
    function sumOfLeftLeaves($root) {
        $sum = 0;
        if(is_null($root)) {
            return $sum;
        }
        if(!is_null($root->left)) {
            if(is_null($root->left->left) && is_null($root->left->right)) {
                $sum += $root->left->val;
            } else {
                $sum += $this->sumOfLeftLeaves($root->left);
            }
        }
        if(!is_null($root->right)) {
            $sum += $this->sumOfLeftLeaves($root->right);
        }
        return $sum;
    }
}

function test() {
    $root1 = new TreeNode(3);
    $root1->left = new TreeNode(9);
    $root1->right = new TreeNode(20);
    $root1->right->left = new TreeNode(15);
    $root1->right->right = new TreeNode(7);
    $solution = new Solution404_SumOfLeftLeaves();
    $root2 = new TreeNode(1);
    $root2->left = new TreeNode(2);
    $root2->right = new TreeNode(3);
    $root2->left->left = new TreeNode(4);
    $root2->left->right = new TreeNode(5);
    var_dump($solution->sumOfLeftLeaves($root1));
    var_dump($solution->sumOfLeftLeaves($root2));
}

test();