<?php
/**
 * Given a binary tree, return the inorder traversal of its nodes' values.
 * Input: [1,null,2,3]
 *      1
 *       \
 *        2
 *       /
 *      3
 * Output: [1,3,2]
 * Follow up: Recursive solution is trivial, could you do it iteratively?
 *
 * Created by PhpStorm.
 * User: Evisu Xiao
 * Date: 2020-09-12
 * Time: 21:30
 */

require_once 'tree_node.php';

class Solution94_BinaryTreeInorderTraversal {
    /**
     * @param TreeNode $root
     * @return Integer[]
     */
    function inorderTraversal($root) {
        $order = [];
        if(is_null($root)) {
            return $order;
        }
        if(!is_null($root->left)) {
            $order = array_merge($order, $this->inorderTraversal($root->left));
        }
        $order[] = $root->val;
        if(!is_null($root->right)) {
            $order = array_merge($order, $this->inorderTraversal($root->right));
        }
        return $order;
    }
}

function test() {
    $root = new TreeNode(1);
    $root->right = new TreeNode(2);
    $root->right->left = new TreeNode(3);
    $solution = new Solution94_BinaryTreeInorderTraversal();
    print_r($solution->inorderTraversal($root));
}

test();