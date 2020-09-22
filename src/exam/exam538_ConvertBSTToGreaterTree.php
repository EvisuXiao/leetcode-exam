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

class Solution538_ConvertBSTToGreaterTree {
    /**
     * @param TreeNode $root
     * @return TreeNode
     */
    function convertBST($root) {
        $sum = 0;
        $this->doSum($root, $sum);
        return $root;
    }

    /**
     * @param TreeNode $root
     * @param int      $sum
     */
    function doSum(&$root, &$sum) {
        if(is_null($root)) {
            return;
        }
        if(!is_null($root->right)) {
            $this->doSum($root->right, $sum);
        }
        $root->val += $sum;
        $sum = $root->val;
        if(!is_null($root->left)) {
            $this->doSum($root->left, $sum);
        }
    }
}

function test() {
    $root1 = new TreeNode(4);
    $root1->left = new TreeNode(2);
    $root1->left->left = new TreeNode(-3);
    $root1->left->left = new TreeNode(-3);
    $root1->left->left->right = new TreeNode(-1);
    $root1->left->left->right->right = new TreeNode(-0);
    $solution = new Solution538_ConvertBSTToGreaterTree();
    $root3 = new TreeNode(5);
    $root3->left = new TreeNode(2);
    $root3->left->left = new TreeNode(1);
    $root3->left->right = new TreeNode(4);
    $root3->right = new TreeNode(13);
    $root3->right->left = new TreeNode(8);
    $root3->right->right = new TreeNode(17);
    var_dump($solution->convertBST($root1));
    var_dump($solution->convertBST($root3));
}

test();