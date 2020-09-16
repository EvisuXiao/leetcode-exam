<?php
/**
 * Invert a binary tree.
 * Input:
 *      4
 *    /   \
 *   2     7
 *  / \   / \
 * 1   3 6   9
 * Output:
 *      4
 *    /   \
 *   7     2
 *  / \   / \
 * 9   6 3   1
 *
 * Created by PhpStorm.
 * User: Evisu Xiao
 * Date: 2020-09-12
 * Time: 21:30
 */

require_once 'tree_node.php';

class Solution226_InvertBinaryTree {
    /**
     * @param TreeNode $root
     * @return TreeNode
     */
    function invertTree($root) {
        $stack = [];
        $tree = $root;
        $tmpRoot = null;
        while(true) {
            if(!is_null($tree) || !is_null($tree)) {
                $tmpRoot = $tree->left;
                $tree->left = $tree->right;
                $tree->right = $tmpRoot;
                $stack[] = $tree;
                $tree = $tree->left;
            } else if(is_null($tree) && !empty($stack)) {
                $tree = array_pop($stack);
                $tree = $tree->right;
            } else {
                break;
            }
        }
        return $root;
    }
}

function test() {
    $root = new TreeNode(4);
    $root->left = new TreeNode(2);
    $root->right = new TreeNode(7);
    $root->left->left = new TreeNode(1);
    $root->left->right = new TreeNode(3);
    $root->right->left = new TreeNode(6);
    $root->right->right = new TreeNode(9);
    $solution = new Solution226_InvertBinaryTree();
    var_dump($solution->invertTree($root));
}

test();