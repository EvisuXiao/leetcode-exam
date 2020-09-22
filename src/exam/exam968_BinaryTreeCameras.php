<?php
/**
 * Given a binary tree, we install cameras on the nodes of the tree. 
 * Each camera at a node can monitor its parent, itself, and its immediate children.
 * Calculate the minimum number of cameras needed to monitor all nodes of the tree.
 * Example:
 *                  0
 *                /
 *              1
 *            /
 *          0
 *        /
 *      1
 *       \
 *        0
 * Output: 2
 * Explanation: At least two cameras are needed to monitor all nodes of the tree. The above image shows one of the valid configurations of camera placement.
 * Note:
 * The number of nodes in the given tree will be in the range [1, 1000].
 * Every node has value 0.
 *
 * Created by PhpStorm.
 * User: Evisu Xiao
 * Date: 2020-09-12
 * Time: 21:30
 */

require_once 'tree_node.php';

class Solution968_BinaryTreeCameras {
    const NONE = 0;
    const COVERED = 1;
    const CAMERA = 2;
    /**
     * @param TreeNode $root
     * @return Integer
     */
    function minCameraCover($root) {
        $count = 0;
        if($this->cover($root, $count) == self::NONE) {
            $count++;
        }
        return $count;
    }

    /**
     * @param TreeNode $root
     * @param int      $count
     * @return int
     */
    function cover($root, &$count) {
        if(is_null($root)) {
            return self::COVERED;
        }
        $left = $this->cover($root->left, $count);
        $right = $this->cover($root->right, $count);
        if($left == self::NONE || $right == self::NONE) {
            $count++;
            return self::CAMERA;
        }
        if($left == self::CAMERA || $right == self::CAMERA) {
            return self::COVERED;
        }
        return self::NONE;
    }
}

function test() {
    $root1 = new TreeNode(0);
    $root1->left = new TreeNode(0);
    $root1->left->left = new TreeNode(0);
    $root1->left->right = new TreeNode(0);
    $root2 = new TreeNode(0);
    $root2->left = new TreeNode(0);
    $root2->left->left = new TreeNode(0);
    $root2->left->left->left = new TreeNode(0);
    $root2->left->left->left->right = new TreeNode(0);
    $solution = new Solution968_BinaryTreeCameras();
    var_dump($solution->minCameraCover($root1));
    var_dump($solution->minCameraCover($root2));
}

test();